<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['slot_id', 'car_brand', 'car_model', 'car_number', 'status'];
    // Relationship with Slot
    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }
}
