<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riview extends Model
{
    protected $fillable = ['user_id', 'booking_id', 'barber_id', 'rating', 'review'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barber()
    {
        return $this->belongsTo(Barber::class);
    }

    public function booking()
    {
        return $this->belongsTo(Bookings::class);
    }
}
