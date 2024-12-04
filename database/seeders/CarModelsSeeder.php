<?php

namespace Database\Seeders;

use App\Models\CarModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Add some dummy car models
         CarModel::create([
            'brand' => 'Tesla',
            'model' => 'Model 3',
            'price_per_unit' => 50.00, // Price per unit (e.g., per km or hour)
        ]);

        CarModel::create([
            'brand' => 'Hyundai',
            'model' => 'Kona',
            'price_per_unit' => 40.00,
        ]);

        CarModel::create([
            'brand' => 'Nissan',
            'model' => 'Leaf',
            'price_per_unit' => 30.00,
        ]);
    }
}
