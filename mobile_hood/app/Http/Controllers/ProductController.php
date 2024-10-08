<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $products;
    protected $categories;

    public function __construct()
    {
        $this->middleware('auth');
        $this->products = Product::where('is_active', true)->where('stock', '>', 0)->get();
        $this->categories = Category::where('is_active', true)->get();
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('products.products', [
            'products' => $this->products
        ]);
    }

    public function create()
    {
        return view('products.create', [
            'categories' => $this->categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'model' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'description' => 'required|string|max:525',
            'price' => 'required|numeric',
            'category' => 'required|array|min:1|max:1',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp',
        ]);

        $product = new Product();

        $product->model = $request->model;
        $imagePath = $request->file('image')->store('products', 'public');
        $product->image = $imagePath;
        $product->brand = $request->brand;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->fk_products_categories = $request->category[0];

        $product->save();

        return redirect(route('products.index'))->with('success', __('messages.add_product_message'));
    }

    public function show(Product $product)
    {
        return view('products.show', [
            'product' => $product
        ]);
    }

    public function edit(Product $product)
    {
        return view('products.edit', [
            'categories' => $this->categories,
            'product' => $product,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'model' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'description' => 'required|string|max:525',
            'price' => 'required|numeric',
            'category' => 'required|array|min:1|max:1',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp',
        ]);

        $product->model = $request->model;
        if ($request->has('image')) {
            $imagePath = $request->file('image')->store('products', 'public');

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->image = $imagePath;
        }
        $product->brand = $request->brand;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->fk_products_categories = $request->category[0];

        $product->save();

        return redirect(route('products.index'))->with('success', __('messages.update_product_message'));
    }

    public function destroy(Product $product)
    {
        $product->update([
            'is_active' => false,
        ]);

        return redirect(route('products.index'))->with('success', __('messages.delete_product_message'));
    }
}
