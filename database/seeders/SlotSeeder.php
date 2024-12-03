<?php

namespace Database\Seeders;

use App\Models\EVStation;
use App\Models\Slot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stations = EVStation::all();

        foreach ($stations as $station) {
            for ($i = 0; $i < 10; $i++) { // 10 slots per station
                Slot::create([
                    'ev_station_id' => $station->id,
                    'date' => now()->addDays($i)->toDateString(),
                    'start_time' => sprintf('%02d:00:00', 9 + $i % 6), // Times: 09:00 to 14:00
                    'end_time' => sprintf('%02d:00:00', 10 + $i % 6),
                    'status' => $i % 2 === 0 ? 'available' : 'booked', // Alternate availability
                ]);
            }
        }
    }
}
