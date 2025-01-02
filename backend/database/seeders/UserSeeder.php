<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserPrivileges;
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
                'roles_picklist' => 1
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'password' => bcrypt('admin'),
                'roles_picklist' => 1
            ]

        ]);

        $users = User::all();
        foreach($users as $user){
            $user_privileges = new UserPrivileges();
            $user_privileges->user_id = $user->id;
            $user_privileges->incidents = true;
            $user_privileges->resources = true;
            $user_privileges->preplans = true;
            $user_privileges->contacts = true;
            $user_privileges->agencies = true;
            $user_privileges->responders = true;
            $user_privileges->responders = true;
            $user_privileges->incident_map = true;
            $user_privileges->heat_map = true;
            $user_privileges->call_logs = true;
            $user_privileges->users = true;
            $user_privileges->save();
        }
    }
}
