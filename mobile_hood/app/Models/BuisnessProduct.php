<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuisnessProduct extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'buisnesses_products';
    protected $fillable = ['fk_buisnesses_products_buisnesses', 'fk_buisnesses_products_products', 'stock'];
}
