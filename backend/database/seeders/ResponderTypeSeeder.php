<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResponderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('responder_types')->insert([
            [
                "id" => 1,
                "label" => "Fire Department"
            ],
            [
                "id" => 2,
                "label" => "Local Enforcement Division (LED)"
            ],
            [
                "id" => 3,
                "label" => "Public Safety"
            ],
        ]);
    }
}