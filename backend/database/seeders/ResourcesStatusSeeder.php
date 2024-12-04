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
                "label" => "Allocated"
            ],
            [
                "id" => 2,
                "label" => "Available"
            ],
            [
                "id" => 3,
                "label" => "Deployed"
            ],
            [
                "id" => 4,
                "label" => "In Service"
            ],
            [
                "id" => 5,
                "label" => "In Transit"
            ],
            [
                "id" => 6,
                "label" => "In Use"
            ],
            [
                "id" => 7,
                "label" => "Out of Service"
            ],
        ]);
    }
}
