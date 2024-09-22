<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hours extends Model
{
    public $timestamps = false;
    protected $table = 'buisness_hours';

    protected $fillable = [
        'day_of_week',
        'opening_time',
        'closing_time',
        'fk_buisness_hours_buisness',
    ];

    public function business()
    {
        return $this->belongsTo(Buisness::class, 'fk_buisness_hours_buisness', 'id');
    }
}
