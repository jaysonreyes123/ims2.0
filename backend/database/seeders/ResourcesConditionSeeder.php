<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourcesConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('resources_conditions')->insert([
            [
                "id" => 1,
                "label" => "Excellent"
            ],
            [
                "id" => 2,
                "label" => "Fair"
            ],
            [
                "id" => 3,
                "label" => "Good"
            ],
            [
                "id" => 4,
                "label" => "New"
            ],
            [
                "id" => 5,
                "label" => "Poor"
            ],
        ]);
    }
}
