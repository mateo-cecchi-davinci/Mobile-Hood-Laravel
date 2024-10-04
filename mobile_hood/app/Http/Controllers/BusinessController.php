<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Hours;
use App\Models\Business;
use App\Models\Location;
use App\Http\Requests\BusinessRequest;
use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    protected $businesses;
    protected $users;
    protected $maps;

    public function __construct()
    {
        $this->middleware('auth');
        $this->businesses = Business::where('is_active', true)->get();
        $this->users = User::where('is_active', true)->get();
        $this->maps = config('googlemaps.maps');
    }

    public function index()
    {
        return view('businesses.businesses', [
            'businesses' => $this->businesses
        ]);
    }

    public function create()
    {
        $time = ['01:00', '01:30', '02:00', '02:30', '03:00', '03:30', '04:00', '04:30', '05:00', '05:30', '06:00', '06:30', '07:00', '07:30', '08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30'];
        $timePeriod = ['AM', 'PM'];
        $day = [
            'sunday' => 'Domingo',
            'monday' => 'Lunes',
            'tuesday' => 'Martes',
            'wednesday' => 'Miércoles',
            'thursday' => 'Jueves',
            'friday' => 'Viernes',
            'saturday' => 'Sábado'
        ];

        return view('businesses.create', [
            'users' => $this->users,
            'time' => $time,
            'timePeriod' => $timePeriod,
            'day' => $day,
            'maps' => $this->maps
        ]);
    }

    public function store(BusinessRequest $request)
    {
        $data = $request->validated();

        $business = new Business();
        $location = new Location();

        $business->name = $data['name'];
        $imagePath = $request->file('logo')->store('logos', 'public');
        $business->logo = $imagePath;
        $business->street = $data['street'];
        $business->number = $data['number'];
        $business->fk_businesses_users = $data['user'][0];
        $business->category = $data['category'][0];
        $business->save();

        $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

        foreach ($days as $index => $day) {
            if ($data["{$day}_switch"]) {
                $openTime = $this->convertTo24HourFormat($data["{$day}_open_time"][0], $data["{$day}_time_period_open"][0]);
                $closeTime = $this->convertTo24HourFormat($data["{$day}_close_time"][0], $data["{$day}_time_period_close"][0]);

                $hours = new Hours();
                $hours->day_of_week = $index;
                $hours->opening_time = $openTime;
                $hours->closing_time = $closeTime;
                $hours->fk_business_hours_business = $business->id;

                $hours->save();
            }
        }

        $location->lat = $data['lat'];
        $location->lng = $data['lng'];
        $location->fk_locations_businesses = $business->id;
        $location->save();

        return redirect(route('businesses.index'))->with('success', __('messages.add_business_message'));
    }

    public function show(Business $business)
    {
        $days = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

        return view('businesses.show', [
            'business' => $business,
            'days' => $days,
            'maps' => $this->maps
        ]);
    }

    public function edit(Business $business)
    {
        $categories = ['butcher_shop', 'grocery_store', 'winery'];
        $time = ['01:00', '01:30', '02:00', '02:30', '03:00', '03:30', '04:00', '04:30', '05:00', '05:30', '06:00', '06:30', '07:00', '07:30', '08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30'];
        $timePeriod = ['AM', 'PM'];
        $dayIndex = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        $day = [
            'sunday' => 'Domingo',
            'monday' => 'Lunes',
            'tuesday' => 'Martes',
            'wednesday' => 'Miércoles',
            'thursday' => 'Jueves',
            'friday' => 'Viernes',
            'saturday' => 'Sábado'
        ];

        $hours = $this->getHours($business);

        return view('businesses.edit', [
            'users' => $this->users,
            'business' => $business,
            'categories' => $categories,
            'time' => $time,
            'timePeriod' => $timePeriod,
            'day' => $day,
            'dayIndex' => $dayIndex,
            'hours' => $hours,
            'maps' => $this->maps
        ]);
    }

    public function update(BusinessRequest $request, Business $business)
    {
        $data = $request->validated();

        $business->name = $data['name'];

        if ($request->has('logo')) {
            $imagePath = $request->file('logo')->store('logos', 'public');

            if ($business->logo) {
                Storage::disk('public')->delete($business->logo);
            }

            $business->logo = $imagePath;
        }

        $business->street = $data['street'];
        $business->number = $data['number'];
        $business->fk_businesses_users = $data['user'][0];
        $business->category = $data['category'][0];

        $business->save();

        $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

        foreach ($days as $index => $day) {
            $hours = Hours::where(['day_of_week' => $index, 'fk_business_hours_business' => $business->id])->get();

            if ($data["{$day}_switch"] && $hours->isEmpty()) {
                $openTime = $this->convertTo24HourFormat($data["{$day}_open_time"][0], $data["{$day}_time_period_open"][0]);
                $closeTime = $this->convertTo24HourFormat($data["{$day}_close_time"][0], $data["{$day}_time_period_close"][0]);

                $hours = new Hours();
                $hours->day_of_week = $index;
                $hours->opening_time = $openTime;
                $hours->closing_time = $closeTime;
                $hours->fk_business_hours_business = $business->id;

                $hours->save();
            } else if ($data["{$day}_switch"] && !$hours->isEmpty()) {
                $openTime = $this->convertTo24HourFormat($data["{$day}_open_time"][0], $data["{$day}_time_period_open"][0]);
                $closeTime = $this->convertTo24HourFormat($data["{$day}_close_time"][0], $data["{$day}_time_period_close"][0]);

                $hours[0]->day_of_week = $index;
                $hours[0]->opening_time = $openTime;
                $hours[0]->closing_time = $closeTime;
                $hours[0]->save();
            } else if (!$hours->isEmpty()) {
                $hours[0]->delete();
            }
        }

        $business->location->lat = $data['lat'];
        $business->location->lng = $data['lng'];
        $business->location->fk_locations_businesses = $business->id;
        $business->location->save();

        return redirect(route('businesses.index'))->with('success', __('messages.update_business_message'));
    }

    public function destroy(Business $business)
    {
        $business->update([
            'is_active' => false,
        ]);

        return redirect(route('businesses.index'))->with('success', __('messages.delete_business_message'));
    }

    private function convertTo24HourFormat($time, $period)
    {
        $dateTime = DateTime::createFromFormat('h:i A', $time . ' ' . $period);
        return $dateTime->format('H:i');
    }

    private function getHours(Business $business)
    {
        return $business->hours;
    }
}
