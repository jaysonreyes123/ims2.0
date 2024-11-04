<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('stations')->insert([
            [
                'id' => 1,
                'code' => "mqtt_table_station01",
                'name' => 'Angono',
                'coordinates' => '14.538419792360996, 121.15904515315604',
                'river_bed' => 8.0,
                'water_surface' => 3.5
            ],
            [
                'id' => 2,
                'code' => "mqtt_table_station02",
                'name' => 'Burgos',
                'coordinates' => '14.586703786212343, 120.99940281386573',
                'river_bed' => 5.2,
                'water_surface' => 4.0
            ],
            [
                'id' => 3,
                'code' => "mqtt_table_station03",
                'name' => 'La Mesa Dam',
                'coordinates' => '14.716484131419277, 121.07235708100956',
                'river_bed' => 9.0,
                'water_surface' => 8.3
            ],
            [
                'id' => 4,
                'code' => "mqtt_table_station04",
                'name' => 'Manalo Bridge',
                'coordinates' => '14.603794900052089, 121.08907614632616',
                'river_bed' => 7.5,
                'water_surface' => 7.0
            ],
            [
                'id' => 5,
                'code' => "mqtt_table_station05",
                'name' => 'Marcos Highway',
                'coordinates' => '14.6136118136375, 121.33570054064121',
                'river_bed' => 10.5,
                'water_surface' => 9.0
            ],
            [
                'id' => 6,
                'code' => "mqtt_table_station06",
                'name' => 'Mindanao ave',
                'coordinates' => '14.695213760602483, 121.01937833593371',
                'river_bed' => 6.0,
                'water_surface' => 1.7
            ],
            [
                'id' => 7,
                'code' => "mqtt_table_station07",
                'name' => 'Nangka',
                'coordinates' => '14.669856629378051, 121.10235485065978',
                'river_bed' => 8.5,
                'water_surface' => 3.2
            ],
            [
                'id' => 8,
                'code' => "mqtt_table_station08",
                'name' => 'Pandacan',
                'coordinates' => '14.58978813993799, 120.99988540868837',
                'river_bed' => 6.0,
                'water_surface' => 5.0
            ],
            [
                'id' => 9,
                'code' => "mqtt_table_station09",
                'name' => 'Quirino',
                'coordinates' => '14.59003078914181, 120.99839825361767',
                'river_bed' => 10.5,
                'water_surface' => 3.0
            ],
            [
                'id' => 10,
                'code' => "mqtt_table_station10",
                'name' => 'Rosario Bridge',
                'coordinates' => '14.590362182989285, 121.08301772759165',
                'river_bed' => 11.0,
                'water_surface' => 2.0
            ],
        ]);
    }
}
