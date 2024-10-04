<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    public $timestamps = false;

    protected $fillable = [
        'lat',
        'lng',
        'fk_locations_businesses',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'fk_locations_businesses', 'id');
    }
}
