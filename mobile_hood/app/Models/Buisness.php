<?php

namespace App\Models;

use DateTime;
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

    public function location()
    {
        return $this->hasOne(Location::class, 'fk_locations_buisnesses', 'id');
    }

    public function hours()
    {
        return $this->hasMany(Hours::class, 'fk_buisness_hours_buisness', 'id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'fk_categories_buisnesses', 'id');
    }

    public function getImageURL()
    {
        if ($this->logo) {
            return url('storage/' . $this->logo);
        }
        return "/img/noImageFound.jpg";
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
