<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    protected $fillable = [
        'user_id',
        'barber_id',
        'booking_date',
        'booking_time',
        'status',
        'note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }


    public function services()
    {
        return $this->belongsToMany(Service::class)
            ->using(BookingService::class) // refer ke model pivot
            ->withTimestamps()
            ->withPivot('price_at_booking');
    }
}
