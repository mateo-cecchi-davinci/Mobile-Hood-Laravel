<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'payment',
        'state',
        'fk_orders_users',
        'created_at',
        'updated_at',
        'is_active',
        'business_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_orders_users', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'orders_products', 'fk_orders_products_orders', 'fk_orders_products_products')
            ->withPivot('amount');
    }

    function convertTo12HourFormatWithoutMeridian($time)
    {
        return date('h:i', strtotime($time));
    }
}
