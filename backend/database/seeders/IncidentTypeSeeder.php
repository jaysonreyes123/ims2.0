<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncidentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('incident_types')->insert([
            [
                'id' => 1,
                'label' => 'Animal Accident'
            ],
            [
                'id' => 2,
                'label' => 'Assualt'
            ],
        ]);
    }
}
