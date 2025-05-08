<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BookingService extends Pivot
{
    protected $table = 'booking_service';

    protected $fillable = ['booking_id', 'service_id', 'price_at_booking'];
}
