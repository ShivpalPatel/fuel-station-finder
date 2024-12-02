<?php

namespace App\Console\Commands;

use App\Models\Station;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportFuelStations extends Command
{
    protected $signature = 'import:fuel-stations';

    protected $description = 'Import fuel stations data from OpenStreetMap';

    public function handle()
    {
        $overpassUrl = 'https://overpass-api.de/api/interpreter';
        $query = '[out:json];node["amenity"="fuel"](22.6,75.7,22.9,76.0);out;';

        $response = Http::get($overpassUrl, ['data' => $query]);

        if ($response->successful()) {
            $data = $response->json();

            foreach ($data['elements'] as $element) {
                // Determine name with fallback
                $name = $element['tags']['name']
                    ?? $element['tags']['brand']
                    ?? 'Unknown Name';

                // Determine address with fallback
                $address = $element['tags']['addr:full']
                    ?? trim(
                        ($element['tags']['addr:street'] ?? '') .
                        (isset($element['tags']['addr:city']) ? ', ' . $element['tags']['addr:city'] : '')
                    )
                    ?: 'Unknown Address';

                // Insert or update the station
                Station::updateOrCreate(
                    [
                        'latitude' => $element['lat'], // Unique key part 1
                        'longitude' => $element['lon'], // Unique key part 2
                    ],
                    [
                        'name' => $name,
                        'address' => $address,
                    ]
                );
            }

            $this->info('Fuel stations imported successfully!');
        } else {
            $this->error('Failed to fetch data from Overpass API');
        }
    }
}
