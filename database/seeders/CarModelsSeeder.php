<?php

namespace Database\Seeders;

use App\Models\CarModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $evCars = [
            ['brand' => 'Tata', 'model' => 'Nexon EV', 'price_per_unit' => 7.50],
            ['brand' => 'Tata', 'model' => 'Tigor EV', 'price_per_unit' => 6.50],
            ['brand' => 'MG', 'model' => 'ZS EV', 'price_per_unit' => 8.00],
            ['brand' => 'Hyundai', 'model' => 'Kona Electric', 'price_per_unit' => 9.50],
            ['brand' => 'Mahindra', 'model' => 'eVerito', 'price_per_unit' => 6.00],
            ['brand' => 'BYD', 'model' => 'e6', 'price_per_unit' => 10.00],
            ['brand' => 'Audi', 'model' => 'e-tron', 'price_per_unit' => 15.00],
            ['brand' => 'Jaguar', 'model' => 'I-Pace', 'price_per_unit' => 16.50],
            ['brand' => 'Mercedes-Benz', 'model' => 'EQC', 'price_per_unit' => 17.50],
            ['brand' => 'BMW', 'model' => 'iX', 'price_per_unit' => 18.00],
            ['brand' => 'Kia', 'model' => 'EV6', 'price_per_unit' => 11.00],
            ['brand' => 'Tata', 'model' => 'Altroz EV', 'price_per_unit' => 7.00],
            ['brand' => 'Mahindra', 'model' => 'XUV400 EV', 'price_per_unit' => 8.50],
            ['brand' => 'MG', 'model' => 'Comet EV', 'price_per_unit' => 5.00],
            ['brand' => 'Renault', 'model' => 'ZOE EV', 'price_per_unit' => 6.75],
            ['brand' => 'Nissan', 'model' => 'Leaf', 'price_per_unit' => 9.00],
            ['brand' => 'Volvo', 'model' => 'XC40 Recharge', 'price_per_unit' => 14.50],
            ['brand' => 'Tesla', 'model' => 'Model 3', 'price_per_unit' => 20.00],
            ['brand' => 'Porsche', 'model' => 'Taycan', 'price_per_unit' => 22.00],
            ['brand' => 'Toyota', 'model' => 'bZ4X', 'price_per_unit' => 13.00],
        ];

        DB::table('car_models')->insert($evCars);
    }
}
