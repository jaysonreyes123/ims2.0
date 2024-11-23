<?php

namespace Database\Seeders;

use App\Models\Sensor;
use App\Models\SensorType;
use App\Models\Station;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $stations = Station::all();
        foreach($stations as $station){
            $sensor_types = SensorType::all();
            foreach($sensor_types as $sensor_type){
                $sensor = new Sensor();
                $sensor->station_id = $station->id;
                $sensor->sensor_type = $sensor_type->id;
                $sensor->status = 1;
                $sensor->save();
            }
        }
    }
}
