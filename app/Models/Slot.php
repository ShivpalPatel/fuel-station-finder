<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Slot extends Model
{
    use HasFactory;

    protected $fillable = ['ev_station_id', 'date', 'start_time', 'end_time', 'status'];
    // prsotected $table = 'slots';

    public function evStation()
    {
         return $this->belongsTo(EVStation::class, 'ev_station_id'); // Correct foreign key name    }
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
