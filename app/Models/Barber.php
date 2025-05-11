<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Schedule;

class Barber extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'bio',
        'photo',
        'experience_years',
        'speciality',
        'available'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedules(){
        return $this->hasMany(Shcedule::class);
    }
}
