<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncidentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('incident_statuses')->insert([
            [
                "id" => 1,
                'name' => "Open",
            ],
            [
                "id" => 2,
                'name' => "In Progress",
            ],
            [
                "id" => 3,
                'name' => "Completed",
            ],
        ]);
    }
}
