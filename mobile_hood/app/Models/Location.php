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
        'fk_locations_buisnesses',
    ];

    public function buisness()
    {
        return $this->belongsTo(Buisness::class, 'fk_locations_buisnesses', 'id');
    }
}
