<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourcesTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('resources_types')->insert([
            [
                "label" => "Firefighter",
                "resources_categories_id" => 1
            ],
            [
                "label" => "Paramedic",
                "resources_categories_id" => 1
            ],
            [
                "label" => "Police Officer",
                "resources_categories_id" => 1
            ],
            [
                "label" => "Volunteer",
                "resources_categories_id" => 1
            ],
            [
                "label" => "Technician",
                "resources_categories_id" => 1
            ],


            [
                "label" => "Ambulance",
                "resources_categories_id" => 2
            ],
            [
                "label" => "Fire Truck",
                "resources_categories_id" => 2
            ],
            [
                "label" => "Police Car",
                "resources_categories_id" => 2
            ],
            [
                "label" => "Rescue Boat",
                "resources_categories_id" => 2
            ],
            [
                "label" => "Helicopter",
                "resources_categories_id" => 2
            ],
            [
                "label" => "Utility Vehicle",
                "resources_categories_id" => 2
            ],



            [
                "label" => "First Aid Kit",
                "resources_categories_id" => 3
            ],
            [
                "label" => "Fire Extinguisher",
                "resources_categories_id" => 3
            ],
            [
                "label" => "Defibrillator (AED)",
                "resources_categories_id" => 3
            ],
            [
                "label" => "Rescue Tools",
                "resources_categories_id" => 3
            ],
            [
                "label" => "Flashlight",
                "resources_categories_id" => 3
            ],
            [
                "label" => "Communication Radio",
                "resources_categories_id" => 3
            ],



            [
                "label" => "Hospital",
                "resources_categories_id" => 4
            ],
            [
                "label" => "Evacuation Center",
                "resources_categories_id" => 4
            ],
            [
                "label" => "Command Center",
                "resources_categories_id" => 4
            ],
            [
                "label" => "Shelter",
                "resources_categories_id" => 4
            ],
            [
                "label" => "Supply Deport",
                "resources_categories_id" => 4
            ],

        ]);
    }
}
