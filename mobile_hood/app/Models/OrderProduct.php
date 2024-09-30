<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'orders_products';
    protected $fillable = ['fk_orders_products_orders', 'fk_orders_products_products', 'amount'];
}
