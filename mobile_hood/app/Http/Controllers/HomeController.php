<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Buisness;
use App\Models\Category;
use Illuminate\Http\Request;

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
        return view('home', [
            'buisnesses' => $this->buisnesses,
        ]);
    }

    public function buisness(Request $request)
    {
        $request->validate([
            'buisness' => 'required|integer',
        ]);

        $buisness = $this->buisnesses->firstWhere('id', $request->buisness);

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
            $products = $this->getProducts($category);
            $productsByCategory[$category->name] = $products;
        }

        return view('buisness', [
            'buisness' => $buisness,
            'maps' => $this->maps,
            'dayIndex' => $dayIndex,
            'days' => $days,
            'categories' => $categories,
            'productsByCategory' => $productsByCategory
        ]);
    }

    private function getChildCategories(Buisness $buisness)
    {
        return Category::where(['is_active' => true, 'fk_categories_buisnesses' => $buisness->id])->whereHas('products')->get();
    }

    // $categoriesWithProducts = Category::where('is_active', true)
    // ->whereNull('parent_id')  // Si quieres solo las categorías principales, puedes usar esto
    // ->whereHas('products')    // Trae solo categorías con productos directos
    // ->orWhereHas('children.products')  // O categorías cuyas subcategorías tienen productos
    // ->get();

    private function getProducts(Category $category)
    {
        return Product::where(['is_active' => true, 'fk_products_categories' => $category->id])->get();
    }

    public function filterProducts(Request $request)
    {
        $query = $request->input('query');
        $buisnessId = $request->input('buisness');

        $buisness = $this->getBuisness($buisnessId);

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
        }


        return view('partials.filtered-products', [
            'query' => $query,
            'productsByCategory' => $productsByCategory
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
}
