<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrePlanClassificaionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('pre_plan_classifications')->insert([
            [
                "id" => 1,
                "label" => "Fire Incident"
            ],
            [
                "id" => 2,
                "label" => "Hazardous Material"
            ],
            [
                "id" => 3,
                "label" => "Health Emergency"
            ],
            [
                "id" => 4,
                "label" => "High"
            ],
            [
                "id" => 5,
                "label" => "Low"
            ],
            [
                "id" => 6,
                "label" => "Natural Disaster"
            ],
        ]);
    }
}
