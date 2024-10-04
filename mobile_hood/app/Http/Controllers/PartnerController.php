<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = $this->getMenu(auth()->user()->id);

        return view('dashboard.menu.menu', [
            'data' => $data
        ]);
    }

    public function category(Request $request)
    {
        $request->validate([
            'category' => 'required|integer'
        ]);

        $category = $this->getCategory($request->category);

        if (!$category->products->isEmpty()) {
            $data = view('dashboard.menu.products', compact('category'))->render();

            return response()->json([
                'data' => $data
            ]);
        }

        return response()->json('');
    }

    public function categoryState(Request $request)
    {
        $request->validate([
            'category' => 'required|integer'
        ]);

        $category = $this->getCategoryWithoutProducts($request->category);
        $category->is_active = !$category->is_active;
        $category->save();

        return response()->json(['success' => 'estado actualizado']);
    }

    public function productState(Request $request)
    {
        $request->validate([
            'product' => 'required|integer'
        ]);

        $product = $this->getProduct($request->product);
        $product->is_active = !$product->is_active;
        $product->save();

        return response()->json(['success' => 'estado actualizado']);
    }

    private function getMenu($user)
    {
        $business = Business::firstWhere(['is_active' => true, 'fk_businesses_users' => $user]);

        return Category::where(['fk_categories_businesses' => $business->id])->whereNull('parent_id')->with(['children', 'products'])->get();
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
}
