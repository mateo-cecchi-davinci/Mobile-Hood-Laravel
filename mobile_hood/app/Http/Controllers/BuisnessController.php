<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Hours;
use App\Models\Buisness;
use App\Models\Location;
use App\Http\Requests\BuisnessRequest;
use Illuminate\Support\Facades\Storage;

class BuisnessController extends Controller
{
    protected $buisnesses;
    protected $users;
    protected $maps;

    public function __construct()
    {
        $this->middleware('auth');
        $this->buisnesses = Buisness::where('is_active', true)->get();
        $this->users = User::where('is_active', true)->get();
        $this->maps = config('googlemaps.maps');
    }

    public function index()
    {
        return view('buisnesses.buisnesses', [
            'buisnesses' => $this->buisnesses
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

        return view('buisnesses.create', [
            'users' => $this->users,
            'time' => $time,
            'timePeriod' => $timePeriod,
            'day' => $day,
            'maps' => $this->maps
        ]);
    }

    public function store(BuisnessRequest $request)
    {
        $data = $request->validated();

        $buisness = new Buisness();
        $location = new Location();

        $buisness->name = $data['name'];
        $imagePath = $request->file('logo')->store('logos', 'public');
        $buisness->logo = $imagePath;
        $buisness->street = $data['street'];
        $buisness->number = $data['number'];
        $buisness->fk_buisnesses_users = $data['user'][0];
        $buisness->category = $data['category'][0];
        $buisness->save();

        $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

        foreach ($days as $index => $day) {
            if ($data["{$day}_switch"]) {
                $openTime = $this->convertTo24HourFormat($data["{$day}_open_time"][0], $data["{$day}_time_period_open"][0]);
                $closeTime = $this->convertTo24HourFormat($data["{$day}_close_time"][0], $data["{$day}_time_period_close"][0]);

                $hours = new Hours();
                $hours->day_of_week = $index;
                $hours->opening_time = $openTime;
                $hours->closing_time = $closeTime;
                $hours->fk_buisness_hours_buisness = $buisness->id;

                $hours->save();
            }
        }

        $location->lat = $data['lat'];
        $location->lng = $data['lng'];
        $location->fk_locations_buisnesses = $buisness->id;
        $location->save();

        return redirect(route('buisnesses.index'))->with('success', __('messages.add_buisness_message'));
    }

    public function show(Buisness $buisness)
    {
        $days = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

        return view('buisnesses.show', [
            'buisness' => $buisness,
            'days' => $days,
            'maps' => $this->maps
        ]);
    }

    public function edit(Buisness $buisness)
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

        $hours = $this->getHours($buisness);

        return view('buisnesses.edit', [
            'users' => $this->users,
            'buisness' => $buisness,
            'categories' => $categories,
            'time' => $time,
            'timePeriod' => $timePeriod,
            'day' => $day,
            'dayIndex' => $dayIndex,
            'hours' => $hours,
            'maps' => $this->maps
        ]);
    }

    public function update(BuisnessRequest $request, Buisness $buisness)
    {
        $data = $request->validated();

        $buisness->name = $data['name'];

        if ($request->has('logo')) {
            $imagePath = $request->file('logo')->store('logos', 'public');

            if ($buisness->logo) {
                Storage::disk('public')->delete($buisness->logo);
            }

            $buisness->logo = $imagePath;
        }

        $buisness->street = $data['street'];
        $buisness->number = $data['number'];
        $buisness->fk_buisnesses_users = $data['user'][0];
        $buisness->category = $data['category'][0];

        $buisness->save();

        $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

        foreach ($days as $index => $day) {
            $hours = Hours::where(['day_of_week' => $index, 'fk_buisness_hours_buisness' => $buisness->id])->get();

            if ($data["{$day}_switch"] && $hours->isEmpty()) {
                $openTime = $this->convertTo24HourFormat($data["{$day}_open_time"][0], $data["{$day}_time_period_open"][0]);
                $closeTime = $this->convertTo24HourFormat($data["{$day}_close_time"][0], $data["{$day}_time_period_close"][0]);

                $hours = new Hours();
                $hours->day_of_week = $index;
                $hours->opening_time = $openTime;
                $hours->closing_time = $closeTime;
                $hours->fk_buisness_hours_buisness = $buisness->id;

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

        $buisness->location->lat = $data['lat'];
        $buisness->location->lng = $data['lng'];
        $buisness->location->fk_locations_buisnesses = $buisness->id;
        $buisness->location->save();

        return redirect(route('buisnesses.index'))->with('success', __('messages.update_buisness_message'));
    }

    public function destroy(Buisness $buisness)
    {
        $buisness->update([
            'is_active' => false,
        ]);

        return redirect(route('buisnesses.index'))->with('success', __('messages.delete_buisness_message'));
    }

    private function convertTo24HourFormat($time, $period)
    {
        $dateTime = DateTime::createFromFormat('h:i A', $time . ' ' . $period);
        return $dateTime->format('H:i');
    }

    private function getHours(Buisness $buisness)
    {
        return $buisness->hours;
    }
}
