<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('user_roles')->insert([
            "name" => "admin",
            "dashboard" => 1,
            "warning" => 1,
            "monitoring" => 1,
            "database" => 1,
            "sensor" => 1,
            "station" => 1,
            "maintenance_warning" => 1,
            "notification" => 1,
            "recipient" => 1,
            "user" => 1,
            "user_role" => 1,
            "system" => 1
        ]);
    }
}
