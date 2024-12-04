<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourcesDispatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('resources_dispatchers')->insert([
            [
                "id" => 1,
                "label" => "Makati Fire Dept"
            ],
            [
                "id" => 2,
                "label" => "Makati Rescue Team"
            ],
            [
                "id" => 3,
                "label" => "Pending"
            ],
            [
                "id" => 4,
                "label" => "No"
            ],
            [
                "id" => 5,
                "label" => "Yes"
            ],
        ]);
    }
}
