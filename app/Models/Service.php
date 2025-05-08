<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $fillable = ['name', 'price', 'description', 'duration'];

    public function bookings()
    {
        return $this->belongsToMany(Bookings::class)
        ->using(BookingService::class)
        ->withTimestamps()
        ->withPivot('price_at_booking');
    }
}
