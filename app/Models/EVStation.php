<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EVStation extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'latitude', 'longitude'];
    protected $table = 'ev_stations';

    public function slots()
    {
        return $this->hasMany(Slot::class,'ev_station_id');
    }
}
