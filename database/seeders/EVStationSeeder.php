<?php

namespace Database\Seeders;

use App\Models\EVStation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EVStationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stations = [
            ['Green EV Station 1', 'MG Road, Indore', 22.7196, 75.8577],
            ['Green EV Station 2', 'Palasia Square, Indore', 22.7252, 75.8655],
            ['Green EV Station 3', 'Vijay Nagar, Indore', 22.7544, 75.8856],
            ['Eco EV Station 1', 'Rau, Indore', 22.6526, 75.8080],
            ['Eco EV Station 2', 'Rajendra Nagar, Indore', 22.6838, 75.8455],
            ['Eco EV Station 3', 'Kanadia Road, Indore', 22.7292, 75.9326],
            ['Future EV Station 1', 'Bhanwar Kuwa, Indore', 22.7183, 75.8518],
            ['Future EV Station 2', 'Gumasta Nagar, Indore', 22.7041, 75.8345],
            ['Future EV Station 3', 'Dewas Naka, Indore', 22.7723, 75.8941],
            ['EcoGreen EV Station 1', 'AB Road, Indore', 22.7051, 75.8893],
            ['EcoGreen EV Station 2', 'Pipliyahana, Indore', 22.7317, 75.8867],
            ['EcoGreen EV Station 3', 'Nipania, Indore', 22.7725, 75.8974],
            ['Green Future EV Station 1', 'Mhow, Indore', 22.5574, 75.7669],
            ['Green Future EV Station 2', 'Bijalpur, Indore', 22.6702, 75.8018],
            ['Green Future EV Station 3', 'Aerodrome Road, Indore', 22.7192, 75.7992],
            ['Ultra EV Station 1', 'Khajrana, Indore', 22.7355, 75.9063],
            ['Ultra EV Station 2', 'Sapna Sangeeta, Indore', 22.7199, 75.8500],
            ['Ultra EV Station 3', 'Geeta Bhawan, Indore', 22.7282, 75.8673],
            ['Prime EV Station 1', 'Vishnupuri, Indore', 22.7195, 75.8324],
            ['Prime EV Station 2', 'Ranjit Hanuman, Indore', 22.7073, 75.8807],
        ];

        foreach ($stations as $station) {
            EVStation::create([
                'name' => $station[0],
                'address' => $station[1],
                'latitude' => $station[2],
                'longitude' => $station[3],
            ]);
        }
    }
}
