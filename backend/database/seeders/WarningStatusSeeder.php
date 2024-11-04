<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarningStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('warning_statuses')->insert([
            [
                "sensor_type" => 1,
                "name" => "No rain"
            ],
            [
                "sensor_type" => 1,
                "name" => "Light"
            ],
            [
                "sensor_type" => 1,
                "name" => "Moderate"
            ],
            [
                "sensor_type" => 1,
                "name" => "Yellow"
            ],
            [
                "sensor_type" => 1,
                "name" => "Orange"
            ],
            [
                "sensor_type" => 1,
                "name" => "Red"
            ],

            [
                "sensor_type" => 2,
                "name" => "Normal"
            ],
            [
                "sensor_type" => 2,
                "name" => "Alert"
            ],
            [
                "sensor_type" => 2,
                "name" => "Alarm"
            ],
            [
                "sensor_type" => 2,
                "name" => "Critical"
            ],
        ]);
    }
}
