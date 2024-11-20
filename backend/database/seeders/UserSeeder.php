<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            [
                'name' => 'Mark Santos',
                'email' => 'mark@test.com',
                'password' => bcrypt('123456789'),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'password' => bcrypt('admin'),
            ]

        ]);
    }
}
