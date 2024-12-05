<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'slot_id',
        'car_brand',
        'car_model',
        'car_number',
        'units',    // Make sure 'units' is included
        'status',
        'fare'      // Make sure 'fare' is included
    ];
    // Relationship with Slot
    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }
}
