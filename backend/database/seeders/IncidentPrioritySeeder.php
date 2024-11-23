<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncidentPrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('incident_priorities')->insert([
            [
                "id" => 1,
                "name" => "Low"
            ],
            [
                "id" => 2,
                "name" => "Medium"
            ],
            [
                "id" => 3,
                "name" => "High"
            ],
            [
                "id" => 4,
                "name" => "Urgent"
            ],
        ]);
    }
}
