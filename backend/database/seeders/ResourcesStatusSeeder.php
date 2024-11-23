<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourcesStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('resources_statuses')->insert([
            [
                "id" => 1,
                "name" => "Allocated"
            ],
            [
                "id" => 2,
                "name" => "Available"
            ],
            [
                "id" => 3,
                "name" => "Deployed"
            ],
            [
                "id" => 4,
                "name" => "In Service"
            ],
            [
                "id" => 5,
                "name" => "In Transit"
            ],
            [
                "id" => 6,
                "name" => "In Use"
            ],
            [
                "id" => 7,
                "name" => "Out of Service"
            ],
        ]);
    }
}
