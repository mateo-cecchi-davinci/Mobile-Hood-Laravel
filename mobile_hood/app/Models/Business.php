<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'businesses';

    protected $fillable = [
        'name',
        'logo',
        'frontPage',
        'street',
        'number',
        'category',
        'fk_businesses_users',
        'created_at',
        'updated_at',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_businesses_users', 'id');
    }

    public function location()
    {
        return $this->hasOne(Location::class, 'fk_locations_businesses', 'id');
    }

    public function hours()
    {
        return $this->hasMany(Hours::class, 'fk_business_hours_business', 'id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'fk_categories_businesses', 'id');
    }

    public function getImageURL()
    {
        if ($this->logo) {
            return url('storage/' . $this->logo);
        }
        return "/img/noImageFound.jpg";
    }

    public function getFrontPageURL()
    {
        if ($this->frontPage) {
            return url('storage/' . $this->frontPage);
        }
        return "/img/business_front_pages/hola.png";
    }

    public function convertTo12HourFormat($time)
    {
        $dateTime = DateTime::createFromFormat('H:i:s', $time);

        if ($dateTime) {
            return $dateTime->format('h:iA');
        }

        return null;
    }

    function convertTo12HourFormatWithoutMeridian($time)
    {
        return date('h:i', strtotime($time));
    }

    function getMeridian($time)
    {
        return date('A', strtotime($time));
    }
}
