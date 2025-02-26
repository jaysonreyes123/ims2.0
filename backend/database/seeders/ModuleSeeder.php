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
                'entityname' => 'incident_no',
                "label" => "Incidents",
                "icon" => "heroicons:exclamation-triangle",
                "presence" => 1,
                "prefix" => "INCIDENT",
            ],
            [
                'id' => 2,
                'name' => 'resources',
                'entityname' => 'resources_name',
                "label" => "Resources",
                "icon" => "heroicons:clipboard-document-check",
                "presence" => 1,
                "prefix" => "",
            ],
            [
                'id' => 3,
                'name' => 'preplans',
                'entityname' => 'preplan_name',
                "label" => "Pre Plan",
                "icon" => "heroicons:document",
                "presence" => 1,
                "prefix" => "",
            ],
            [
                'id' => 4,
                'name' => 'contacts',
                'entityname' => 'firstname,lastname',
                "label" => "Contact",
                "icon" => "heroicons:users",
                "presence" => 1,
                "prefix" => "",
            ],
            [
                'id' => 5,
                'name' => 'agencies',
                'entityname' => 'agency_name',
                "label" => "Agency",
                "icon" => "carbon:dashboard",
                "presence" => 1,
                "prefix" => "",
            ],
            [
                'id' => 6,
                'name' => 'responders',
                'entityname' => 'responder_types',
                "label" => "Responder",
                "icon" => "carbon:dashboard",
                "presence" => 1,
                "prefix" => "",
            ],
            [
                'id' => 7,
                'name' => 'call_logs',
                'entityname' => 'date_and_time',
                "label" => "Call Logs",
                "icon" => "carbon:dashboard",
                "presence" => 1,
                "prefix" => "",
            ],
            [
                'id' => 8,
                'name' => 'reports',
                'entityname' => 'report_name',
                "label" => "Reports",
                "icon" => "heroicons:chart-pie",
                "presence" => 3,
                "prefix" => "",
            ],
            [
                'id' => 9,
                'name' => 'users',
                'entityname' => 'name',
                "label" => "User",
                "icon" => "carbon:dashboard",
                "presence" => 4,
                "prefix" => "",
            ],
            [
                'id' => 10,
                'name' => 'media',
                'entityname' => 'filetitle',
                "label" => "Media",
                "icon" => "carbon:dashboard",
                "presence" => 2,
                "prefix" => "",
            ],
            [
                'id' => 11,
                'name' => 'comments',
                'entityname' => 'comment',
                "label" => "Comment",
                "icon" => "carbon:dashboard",
                "presence" => 2,
                "prefix" => "",
            ],
            [
                'id' => 12,
                'name' => 'tasks',
                'entityname' => 'name',
                "label" => "Task",
                "icon" => "carbon:dashboard",
                "presence" => 2,
                "prefix" => "",
            ],
        ]);
    }
}
