<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categories;

    public function __construct()
    {
        $this->middleware('auth');
        $this->categories = Category::where('is_active', true)->get();
    }

    public function index()
    {
        return view('categories.categories', [
            'categories' => $this->categories
        ]);
    }

    public function create()
    {
        return view('categories.create', [
            'categories' => $this->categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'array|min:0|max:1',
        ]);

        $category = new Category();

        $category->name = $request->name;

        if ($request->has('category')) {
            $category->parent_id = $request->category[0];
        }

        $category->save();

        return redirect(route('categories.index'))->with('success', __('messages.add_category_message'));
    }

    public function show(Category $category)
    {
        return view('categories.show', [
            'category' => $category,
        ]);
    }

    public function edit(Category $category)
    {
        return view('categories.edit', [
            'categories' => $this->categories,
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'array|min:0|max:1',
        ]);

        $category->name = $request->name;

        if ($request->has('category')) {
            $category->parent_id = $request->category[0];
        }

        $category->save();

        return redirect(route('categories.index'))->with('success', __('messages.update_category_message'));
    }

    public function destroy(Category $category)
    {
        $category->logicalDelete();

        return redirect(route('categories.index'))->with('success', __('messages.delete_category_message'));
    }
}
