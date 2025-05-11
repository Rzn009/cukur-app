<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shcedule extends Model
{
    protected $fillable = [
        'barber_id',
        'day',
        'start_time',
        'end_time',
    ];

    public function barber(){
        return $this->belongsTo(Barber::class);
    }
    
}
