<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Business;
use App\Models\Category;
use App\Rules\AspectRatio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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

    public function editFrontPage(Request $request)
    {
        $request->validate([
            'frontPage' => [
                'required',
                'image',
                'mimes:jpg,png,jpeg,webp',
                'dimensions:min_width=1080,max_width=1440,min_height=412,max_height=720'
            ],
        ]);

        $business = $this->getBusiness(auth()->user()->id);

        if ($business->frontPage) {
            Storage::disk('public')->delete($business->frontPage);
        }

        $imagePath = $request->file('frontPage')->store('frontPages', 'public');
        $business->frontPage = $imagePath;

        $business->save();

        return redirect(route('partner-profile'));
    }

    public function editLogo(Request $request)
    {
        $request->validate([
            'logo' => [
                'required',
                'image',
                'mimes:jpg,png,jpeg,webp',
                new AspectRatio(1),
            ],
        ]);

        $business = $this->getBusiness(auth()->user()->id);

        Storage::disk('public')->delete($business->logo);

        $imagePath = $request->file('logo')->store('businesses_logos', 'public');
        $business->logo = $imagePath;

        $business->save();

        return redirect(route('partner-profile'));
    }

    public function editName(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[\p{L}\s]+$/u|max:255',
        ]);

        $business = $this->getBusiness(auth()->user()->id);

        $business->name = $request->name;
        $business->save();

        return redirect(route('partner-profile'));
    }

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
        return Business::where(['is_active' => true, 'fk_businesses_users' => $user])->first();
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
}
