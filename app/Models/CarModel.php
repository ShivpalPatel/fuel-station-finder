<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand',
        'model',
        'price_per_unit'
    ];
}
