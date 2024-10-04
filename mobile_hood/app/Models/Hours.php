<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hours extends Model
{
    public $timestamps = false;
    protected $table = 'business_hours';

    protected $fillable = [
        'day_of_week',
        'opening_time',
        'closing_time',
        'fk_business_hours_business',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class, 'fk_business_hours_business', 'id');
    }
}
