<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buisness extends Model
{
    protected $table = 'buisnesses';

    protected $fillable = [
        'name',
        'logo',
        'street',
        'number',
        'category',
        'fk_buisnesses_users',
        'created_at',
        'updated_at',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_buisnesses_users', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'buisnesses_products', 'fk_buisnesses_products_buisnesses', 'fk_buisnesses_products_products')
            ->withPivot('amount');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'fk_categories_buisnesses', 'id');
    }

    public function getImageURL()
    {
        if ($this->logo) {
            return url('storage/' . $this->logo);
        }
        return "/img/noImageFound.jpg";
    }
}
