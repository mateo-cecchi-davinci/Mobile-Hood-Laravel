<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'carts';

    protected $fillable = [
        'fk_carts_users',
        'fk_carts_products',
        'quantity'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_carts_users', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'fk_carts_products', 'id');
    }
}
