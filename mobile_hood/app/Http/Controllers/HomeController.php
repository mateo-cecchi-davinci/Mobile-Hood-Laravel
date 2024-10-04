<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Business;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $businesses;
    protected $maps;

    public function __construct()
    {
        $this->businesses = Business::where('is_active', true)->with(['location', 'hours'])->get();
        $this->maps = config('googlemaps.maps');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()) {
            $orders = $this->getUserOrders(auth()->user()->id);
        } else {
            $orders = [];
        }

        return view('home', [
            'businesses' => $this->businesses,
            'orders' => $orders
        ]);
    }

    public function business(Request $request)
    {
        $request->validate([
            'business' => 'required|integer',
        ]);

        $businessModel = $this->businesses->firstWhere('id', $request->business);
        $business = $this->businesses->firstWhere('id', $request->business)->toArray();

        $dayIndex = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        $days = [
            'sunday' => 'Domingo',
            'monday' => 'Lunes',
            'tuesday' => 'Martes',
            'wednesday' => 'Miércoles',
            'thursday' => 'Jueves',
            'friday' => 'Viernes',
            'saturday' => 'Sábado'
        ];

        $categories = $this->getCategoriesWithProducts($business);
        $productsByCategory = [];

        foreach ($categories as $category) {
            $products = $this->getProducts($category)->toArray();
            $productsByCategory[$category['name']] = $products;
        }

        $cartProducts = [];

        if (auth()->check()) {
            foreach ($productsByCategory as $products) {
                foreach ($products as $product) {
                    $cartProductsArray = $this->getCartProducts(auth()->user(), $business['id']);

                    $cartProduct = collect($cartProductsArray)
                        ->firstWhere('fk_carts_products', $product['id']);

                    if ($cartProduct) {
                        array_push($cartProducts, $cartProduct);
                    }
                }
            }
        }

        return view('business', [
            'businessModel' => $businessModel,
            'business' => $business,
            'maps' => $this->maps,
            'dayIndex' => $dayIndex,
            'days' => $days,
            'categories' => $categories,
            'productsByCategory' => $productsByCategory,
            'cartProducts' => $cartProducts,
        ]);
    }

    private function getCategoriesWithProducts($business)
    {
        return Category::where(['is_active' => true, 'fk_categories_businesses' => $business['id']])->whereHas('products')->get();
    }

    private function getProducts(Category $category)
    {
        return Product::where(['is_active' => true, 'fk_products_categories' => $category->id])->where('stock', '>', 0)->get();
    }

    public function filterProducts(Request $request)
    {
        $query = $request->input('query');
        $businessId = $request->input('business');

        $business = $this->getBusiness($businessId)->toArray();

        $categories = $this->getCategoriesWithProducts($business);
        $productsByCategory = [];

        if (empty($query)) {
            foreach ($categories as $category) {
                $products = $this->getProducts($category);
                $productsByCategory[$category->name] = $products;
            }
        } else {
            foreach ($categories as $category) {
                $products = $this->getFilteredProducts($category, $query);
                if ($products->isNotEmpty()) {
                    $productsByCategory[$category->name] = $products;
                }
            }

            if (empty($productsByCategory)) {
                session()->flash('toast');
            }
        }

        return view('components.products', [
            'business' => $business,
            'query' => $query,
            'productsByCategory' => $productsByCategory
        ]);
    }

    public function filterBusinesses(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)) {
            $businesses = $this->businesses;
        } else {
            $businesses = $this->getFilteredBusinesses($query);
        }

        return view('components.businesses', [
            'businesses' => $businesses,
            'query' => $query
        ]);
    }

    private function getBusiness($businessId)
    {
        return Business::firstwhere(['is_active' => true, 'id' => $businessId]);
    }

    private function getFilteredProducts(Category $category, $query)
    {
        return Product::where(['is_active' => true, 'fk_products_categories' => $category->id])->where('model', 'like', "%{$query}%")->get();
    }

    private function getFilteredBusinesses($query)
    {
        return Business::where('is_active', true)->where('name', 'like', "%{$query}%")->get();
    }

    private function getCartProducts(User $user, $businessId)
    {
        return Cart::select('fk_carts_users', 'fk_carts_products', DB::raw('SUM(quantity) as quantity'))
            ->join('products', 'carts.fk_carts_products', '=', 'products.id')
            ->join('categories', 'products.fk_products_categories', '=', 'categories.id')
            ->where('fk_carts_users', $user->id)
            ->where('categories.fk_categories_businesses', $businessId)
            ->groupBy('fk_carts_users', 'fk_carts_products')
            ->with(['product'])
            ->get()->toArray();
    }

    private function getUserOrders($user)
    {
        return Order::select('id')->where(['fk_orders_users' => $user, 'state' => 'Pendiente'])->get()->toArray();
    }
}
