<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Buisness;
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

    protected $buisnesses;
    protected $maps;

    public function __construct()
    {
        $this->buisnesses = Buisness::where('is_active', true)->with(['location', 'hours'])->get();
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
            'buisnesses' => $this->buisnesses,
            'orders' => $orders
        ]);
    }

    public function buisness(Request $request)
    {
        $request->validate([
            'buisness' => 'required|integer',
        ]);

        $buisnessModel = $this->buisnesses->firstWhere('id', $request->buisness);
        $buisness = $this->buisnesses->firstWhere('id', $request->buisness)->toArray();

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

        $categories = $this->getChildCategories($buisness);
        $productsByCategory = [];

        foreach ($categories as $category) {
            $products = $this->getProducts($category)->toArray();
            $productsByCategory[$category['name']] = $products;
        }

        $cartProducts = [];

        if (auth()->check()) {
            foreach ($productsByCategory as $categoryName => $products) {
                foreach ($products as $product) {
                    $cartProductsArray = $this->getCartProducts(auth()->user(), $buisness['id']);

                    $cartProduct = collect($cartProductsArray)
                        ->firstWhere('fk_carts_products', $product['id']);

                    if ($cartProduct) {
                        array_push($cartProducts, $cartProduct);
                    }
                }
            }
        }

        return view('buisness', [
            'buisnessModel' => $buisnessModel,
            'buisness' => $buisness,
            'maps' => $this->maps,
            'dayIndex' => $dayIndex,
            'days' => $days,
            'categories' => $categories,
            'productsByCategory' => $productsByCategory,
            'cartProducts' => $cartProducts,
        ]);
    }

    private function getChildCategories($buisness)
    {
        return Category::where(['is_active' => true, 'fk_categories_buisnesses' => $buisness['id']])->whereHas('products')->get();
    }

    private function getProducts(Category $category)
    {
        return Product::where(['is_active' => true, 'fk_products_categories' => $category->id])->where('stock', '>', 0)->get();
    }

    public function filterProducts(Request $request)
    {
        $query = $request->input('query');
        $buisnessId = $request->input('buisness');

        $buisness = $this->getBuisness($buisnessId)->toArray();

        $categories = $this->getChildCategories($buisness);
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
            'buisness' => $buisness,
            'query' => $query,
            'productsByCategory' => $productsByCategory
        ]);
    }

    public function filterBuisnesses(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)) {
            $buisnesses = $this->buisnesses;
            //mostrar toast
        } else {
            $buisnesses = $this->getFilteredBuisnesses($query);
        }

        return view('components.buisnesses', [
            'buisnesses' => $buisnesses,
            'query' => $query
        ]);
    }

    private function getBuisness($buisnessId)
    {
        return Buisness::firstwhere(['is_active' => true, 'id' => $buisnessId]);
    }

    private function getFilteredProducts(Category $category, $query)
    {
        return Product::where(['is_active' => true, 'fk_products_categories' => $category->id])->where('model', 'like', "%{$query}%")->get();
    }

    private function getFilteredBuisnesses($query)
    {
        return Buisness::where('is_active', true)->where('name', 'like', "%{$query}%")->get();
    }

    private function getCartProducts(User $user, $buisnessId)
    {
        return Cart::select('fk_carts_users', 'fk_carts_products', DB::raw('SUM(quantity) as quantity'))
            ->join('products', 'carts.fk_carts_products', '=', 'products.id')
            ->join('categories', 'products.fk_products_categories', '=', 'categories.id')
            ->where('fk_carts_users', $user->id)
            ->where('categories.fk_categories_buisnesses', $buisnessId)
            ->groupBy('fk_carts_users', 'fk_carts_products')
            ->with(['product'])
            ->get()->toArray();
    }

    private function getUserOrders($user)
    {
        return Order::select('id')->where(['fk_orders_users' => $user, 'state' => 'Pendiente'])->get()->toArray();
    }
}
