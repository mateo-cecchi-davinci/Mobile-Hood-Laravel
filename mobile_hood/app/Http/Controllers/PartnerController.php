<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Hours;
use App\Models\Product;
use App\Models\Business;
use App\Models\Category;
use App\Rules\AspectRatio;
use Illuminate\Http\Request;
use App\Http\Requests\HoursRequest;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    protected $maps;

    public function __construct()
    {
        $this->middleware('auth');
        $this->maps = config('googlemaps.maps');
    }

    public function index()
    {
        $business = $this->getBusiness(auth()->user()->id);
        $data = $this->getMenu($business);

        return view('dashboard.menu.menu', [
            'data' => $data
        ]);
    }

    public function profile()
    {
        $business = $this->getBusiness(auth()->user()->id);

        return view('dashboard.profile.profile', [
            'business' => $business
        ]);
    }

    public function personalInfo()
    {
        return view('dashboard.profile.personalInfo');
    }

    public function businessInfo()
    {
        $business = $this->getBusiness(auth()->user()->id);

        return view('dashboard.profile.businessInfo', [
            'business' => $business
        ]);
    }

    public function editPersonalInfo()
    {
        return view('dashboard.profile.editPersonalInfo');
    }

    public function editUsername(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[\p{L}\s]+$/u|max:255',
            'lastname' => 'required|regex:/^[\p{L}\s]+$/u|max:255',
        ]);

        $user = $this->getUser(auth()->user()->id);

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->save();

        return redirect(route('personal-info'));
    }

    public function editBusiness(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[\p{L}\s]+$/u|max:255',
            'street' => 'required|regex:/^[\p{L}\s]+$/u|max:255',
            'number' => 'required|integer',
            'logo' => [
                'image',
                'mimes:jpg,png,jpeg,webp',
                new AspectRatio(1),
            ],
            'frontPage' => [
                'image',
                'mimes:jpg,png,jpeg,webp',
            ],
        ]);

        $business = $this->getBusiness(auth()->user()->id);

        if ($request->has('logo')) {
            Storage::disk('public')->delete($business->logo);

            $logoImagePath = $request->file('logo')->store('businesses_logos', 'public');
            $business->logo = $logoImagePath;
        }

        if ($request->has('frontPage')) {
            Storage::disk('public')->delete($business->frontPage);

            $frontPageImagePath = $request->file('frontPage')->store('frontPages', 'public');
            $business->frontPage = $frontPageImagePath;
        }

        $business->name = $request->name;
        $business->street = $request->street;
        $business->number = $request->number;
        $business->save();

        return redirect(route('partner-profile'));
    }

    public function hours()
    {
        $business = $this->getBusiness(auth()->user()->id);
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

        return view('dashboard.hours.hours', [
            'business' => $business,
            'time' => $time,
            'timePeriod' => $timePeriod,
            'day' => $day,
            'dayIndex' => $dayIndex
        ]);
    }

    public function saveHours(HoursRequest $request)
    {
        $data = $request->validated();

        $days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
        $business = $this->getBusiness(auth()->user()->id);

        foreach ($days as $index => $day) {
            $hours = $this->getHours($index, $business->id);

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

        return redirect(route('hours'))->with('success', 'Se guardaron tus horarios!');
    }

    public function orders()
    {
        $business = $this->getBusiness(auth()->user()->id);

        return view('dashboard.orders.incoming.orders', [
            'business' => $business,
            'maps' => $this->maps
        ]);
    }

    public function recentOrders()
    {
        $business = $this->getBusiness(auth()->user()->id);

        return view('dashboard.orders.recent.recent', [
            'business' => $business
        ]);
    }

    public function location() {}

    public function category(Request $request)
    {
        $request->validate([
            'category' => 'required|integer'
        ]);

        $category = $this->getCategory($request->category);
        $business = $this->getBusiness(auth()->user()->id);
        $data = $this->getMenu($business);

        $data = view('dashboard.menu.products', compact('category', 'data'))->render();

        return response()->json([
            'data' => $data
        ]);
    }

    public function categoryState(Request $request)
    {
        $request->validate([
            'category' => 'required|integer'
        ]);

        $category = $this->getCategoryWithoutProducts($request->category);
        $category->is_active = !$category->is_active;
        $category->save();

        return response()->json(['Estado actualizado']);
    }

    public function productState(Request $request)
    {
        $request->validate([
            'product' => 'required|integer'
        ]);

        $product = $this->getProduct($request->product);
        $product->is_active = !$product->is_active;
        $product->save();

        return response()->json(['Estado actualizado']);
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[\p{L}\s]+$/u|max:255',
            'category' => 'nullable|integer'
        ]);

        $business = $this->getBusiness(auth()->user()->id);

        $category = new Category();

        $category->name = $request->name;

        if ($request->has('category')) {
            $category->parent_id = $request->category;
        }

        $category->fk_categories_businesses = $business->id;

        $category->save();

        $data = $this->getMenu($business);

        $data = view('dashboard.menu.category-section', compact('data'))->render();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function editCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[\p{L}\s]+$/u|max:255',
            'id' => 'required|integer'
        ]);

        $category = $this->getCategoryWithoutProducts($request->id);

        $category->name = $request->name;
        $category->save();

        return response()->json([
            'id' => $category->id,
            'name' => $category->name
        ]);
    }

    public function deleteCategory(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        $category = $this->getCategory($request->id);

        foreach ($category->products as $product) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->delete();
        }

        $category->delete();

        return response()->json('Categoría eliminada');
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'model' => 'required|regex:/^[\p{L}\s]+$/u|max:255',
            'brand' => 'string|regex:/^[\p{L}\s]+$/u|max:255',
            'description' => 'required|string|regex:/^[0-9\p{L}\s]+$/u',
            'price' => 'required|numeric',
            'category' => 'required|regex:/^[0-9]+$/',
            'stock' => 'required|integer|min:0',
            'image' => [
                'required',
                'image',
                'mimes:jpg,png,jpeg,webp',
                new AspectRatio(1),
            ],
        ]);

        $product = new Product();

        $product->model = $request->model;
        $imagePath = $request->file('image')->store('products', 'public');
        $product->image = $imagePath;

        if ($request->has($request->brand)) {
            $product->brand = $request->brand;
        } else {
            $product->brand = "N/A";
        }

        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->fk_products_categories = $request->category;

        $product->save();

        return redirect(route('dashboard'));
    }

    public function editProduct(Request $request)
    {
        $request->validate([
            'model' => 'required|regex:/^[\p{L}\s]+$/u|max:255',
            'brand' => 'string|regex:/^[\p{L}\s\/]+$/u|max:255',
            'description' => 'required|string|regex:/^[0-9\p{L}\s]+$/u',
            'price' => 'required|numeric',
            'category' => 'required|regex:/^[0-9]+$/',
            'stock' => 'required|integer|min:0',
            'product' => 'required|regex:/^[0-9]+$/',
            'image' => [
                'image',
                'mimes:jpg,png,jpeg,webp',
                new AspectRatio(1),
            ],
        ]);

        $product = $this->getProduct($request->product);

        $product->model = $request->model;

        if ($request->has('image')) {
            $imagePath = $request->file('image')->store('products', 'public');

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->image = $imagePath;
        }

        if ($request->brand != '') {
            $product->brand = $request->brand;
        } else {
            $product->brand = "N/A";
        }

        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->fk_products_categories = $request->category;

        $product->save();

        return redirect(route('dashboard'));
    }

    public function deleteProduct(Request $request)
    {
        $product = $this->getProduct($request->product);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect(route('dashboard'))->with('success', 'Producto eliminado');
    }

    private function getBusiness($user)
    {
        return Business::where(['is_active' => true, 'fk_businesses_users' => $user])
            ->with(['hours', 'location', 'categories.products'])
            ->first();
    }

    private function getUser($user)
    {
        return User::where(['is_active' => true, 'id' => $user])->first();
    }

    private function getMenu($business)
    {
        return Category::where(['fk_categories_businesses' => $business->id])->with(['products'])->get();
    }

    private function getCategory($category)
    {
        return Category::where(['id' => $category])->with(['products'])->first();
    }

    private function getCategoryWithoutProducts($category)
    {
        return Category::where(['id' => $category])->first();
    }

    private function getProduct($product)
    {
        return Product::where(['id' => $product])->first();
    }

    private function getHours($day, $business)
    {
        return Hours::where(['day_of_week' => $day, 'fk_business_hours_business' => $business])->get();
    }

    private function convertTo24HourFormat($time, $period)
    {
        $dateTime = DateTime::createFromFormat('h:i A', $time . ' ' . $period);
        return $dateTime->format('H:i');
    }
}
