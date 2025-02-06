<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //presence
        // 1 - visible in navbar and report
        // 2 - not visisble in navbar but visible in report
        // 3 - visible in navbar not but visible in report
        DB::table('modules')->insert([
            [
                'id' => 1,
                'name' => 'incidents',
                "label" => "Incidents",
                "icon" => "carbon:dashboard",
                "presence" => 1
            ],
            [
                'id' => 2,
                'name' => 'resources',
                "label" => "Resources",
                "icon" => "carbon:dashboard",
                "presence" => 1
            ],
            [
                'id' => 3,
                'name' => 'preplans',
                "label" => "Pre Plan",
                "icon" => "carbon:dashboard",
                "presence" => 1
            ],
            [
                'id' => 4,
                'name' => 'contacts',
                "label" => "Contact",
                "icon" => "carbon:dashboard",
                "presence" => 1
            ],
            [
                'id' => 5,
                'name' => 'agencies',
                "label" => "Agency",
                "icon" => "carbon:dashboard",
                "presence" => 1
            ],
            [
                'id' => 6,
                'name' => 'responders',
                "label" => "Responder",
                "icon" => "carbon:dashboard",
                "presence" => 1
            ],
            [
                'id' => 7,
                'name' => 'call_logs',
                "label" => "Call Logs",
                "icon" => "carbon:dashboard",
                "presence" => 1
            ],
            [
                'id' => 8,
                'name' => 'reports',
                "label" => "Reports",
                "icon" => "carbon:dashboard",
                "presence" => 3
            ],
            [
                'id' => 9,
                'name' => 'users',
                "label" => "User",
                "icon" => "carbon:dashboard",
                "presence" => 3
            ],
            [
                'id' => 10,
                'name' => 'media',
                "label" => "Media",
                "icon" => "carbon:dashboard",
                "presence" => 2
            ],
        ]);
    }
}
