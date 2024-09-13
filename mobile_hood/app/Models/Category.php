<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'parent_id',
        'fk_categories_buisnesses',
        'is_active',
    ];

    protected $descendants = [];

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'fk_products_categories');
    }

    public function buisnesses()
    {
        return $this->hasMany(Buisness::class, 'id', 'fk_categories_buisnesses');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->subcategories()->with('children');
    }

    public function hasChildren()
    {
        return $this->children->count() > 0;
    }

    public function findDescendants(Category $category)
    {
        $this->descendants[] = $category->id;

        if ($category->hasChildren()) {
            foreach ($category->children as $child) {
                $this->findDescendants($child);
            }
        }
    }

    public function getDescendants(Category $category)
    {
        $this->descendants = [];
        $this->findDescendants($category);
        return $this->descendants;
    }

    public function logicalDelete()
    {
        // Recursively find all descendants
        $descendants = $this->getDescendants($this);

        // Start a database transaction
        DB::transaction(function () use ($descendants) {
            // Update the current category
            $this->is_active = false;
            $this->save();

            // Logically delete all products of the current category
            foreach ($this->products as $product) {
                $product->is_active = false;
                $product->save();
            }

            // Update all descendant categories and their products
            foreach ($descendants as $categoryId) {
                $category = Category::find($categoryId);
                $category->is_active = false;
                $category->save();

                // Logically delete all products of each descendant category
                foreach ($category->products as $product) {
                    $product->is_active = false;
                    $product->save();
                }
            }
        });
    }
}
