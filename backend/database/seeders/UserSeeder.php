<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Mark Santos',
                'email' => 'mark@test.com',
                'password' => bcrypt('123456789'),
                'role' => 1,
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'password' => bcrypt('admin'),
                'role' => 1,
            ]

        ]);

        DB::table('sensor_types')->insert([
            [
                'id' => 1,
                'name' => "REG20000",
                "description" => "Rain Fall"
            ],
            [
                'id' => 2,
                'name' => "REG20001",
                "description" => "Water Level"
            ],
            [
                'id' => 3,
                'name' => "EXTPWR",
                "description" =>  "External Power Supply"
            ],
        ]);

        DB::table('stations')->insert([
            [
                'id' => 1,
                'code' => "mqtt_table_Station01",
                'name' => 'Kinabutan Bridge 2',
                'coordinates' => '9.77483313476873, 125.48055559999999',
                'river_bed' => 9.0,
                'water_surface' => 7.0
            ],
            [
                'id' => 2,
                'code' => "mqtt_table_Station02",
                'name' => 'Sitio Hubasan Bridge',
                'coordinates' => '9.708423118955283, 125.47253413877168',
                'river_bed' => 10.5,
                'water_surface' => 8.5
            ],
            [
                'id' => 3,
                'code' => "mqtt_table_Station03",
                'name' => 'Anomar Bridge',
                'coordinates' => '9.687364910877305, 125.50583963877152',
                'river_bed' => 6.2,
                'water_surface' => 5.7
            ],
            [
                'id' => 4,
                'code' => "mqtt_table_Station04",
                'name' => 'Mabuhay Bridge',
                'coordinates' => '9.679181093186234, 125.52445073877158',
                'river_bed' => 7.9,
                'water_surface' => 7.4
            ],
            [
                'id' => 5,
                'code' => "mqtt_table_Station05",
                'name' => 'San Pedro Bridge',
                'coordinates' => '9.467250, 125.588611',
                'river_bed' => 9.1,
                'water_surface' => 7.6
            ],
            // [
            //     'id' => 6,
            //     'code' => "mqtt_table_station06",
            //     'name' => 'Friendship Bridge',
            //     'coordinates' => '9.793028, 125.482306',
            //     'river_bed' => 6.0,
            //     'water_surface' => 1.7
            // ],
            // [
            //     'id' => 7,
            //     'code' => "mqtt_table_station07",
            //     'name' => 'Daywan Parallel Bridge',
            //     'coordinates' => '9.574333, 125.720611',
            //     'river_bed' => 8.5,
            //     'water_surface' => 3.2
            // ],
            // [
            //     'id' => 8,
            //     'code' => "mqtt_table_station08",
            //     'name' => 'Kinalablaban Bridge',
            //     'coordinates' => '9.497472, 125.869944',
            //     'river_bed' => 6.0,
            //     'water_surface' => 5.0
            // ],
            // [
            //     'id' => 9,
            //     'code' => "mqtt_table_station09",
            //     'name' => 'San Isidro Bridge',
            //     'coordinates' => '9.937806, 126.089528',
            //     'river_bed' => 10.5,
            //     'water_surface' => 3.0
            // ],
            // [
            //     'id' => 10,
            //     'code' => "mqtt_table_station10",
            //     'name' => 'Sabang Bridge 3',
            //     'coordinates' => '9.801167, 125.458917',
            //     'river_bed' => 11.0,
            //     'water_surface' => 2.0
            // ],
        ]);


        //
        for($a = 1; $a <= 5 ; $a++){
            DB::table('latest_intervals')->insert([
                "id" => $a,
                "station_id" => $a,
                "timestamp" => "2023-09-28 00:00:00"
            ]);
        }

    }
}
