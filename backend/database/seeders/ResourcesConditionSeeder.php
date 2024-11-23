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
                "name" => "Excellent"
            ],
            [
                "id" => 2,
                "name" => "Fair"
            ],
            [
                "id" => 3,
                "name" => "Good"
            ],
            [
                "id" => 4,
                "name" => "New"
            ],
            [
                "id" => 5,
                "name" => "Poor"
            ],
        ]);
    }
}
