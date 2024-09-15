<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'products';

    protected $fillable = [
        'model',
        'image',
        'description',
        'price',
        'brand',
        'fk_products_categories',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'fk_products_categories', 'id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'orders_products', 'fk_orders_products_products', 'fk_orders_products_orders')
            ->withPivot('amount');
    }

    public function buisnesses()
    {
        return $this->belongsToMany(Buisness::class, 'orders_products', 'fk_buisnesses_products_products', 'fk_buisnesses_products_buisnesses');
    }

    public function getImageURL()
    {
        if ($this->image) {
            return url('storage/' . $this->image);
        }

        return "/img/noImageFound.jpg";
    }
}
