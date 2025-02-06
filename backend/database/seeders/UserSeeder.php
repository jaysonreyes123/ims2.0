<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\User;
use App\Models\UserPrivilege;
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
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'password' => bcrypt('admin'),
                'user_roles' => 'Admin'
            ],
            [
                'name' => 'Jayson',
                'email' => 'jayson.reyes@microbizone.com',
                'password' => bcrypt('admin'),
                'user_roles' => 'Non Admin'
            ]

        ]);

        $users = User::all();
        $modules = Module::whereIn('presence',[1,3])->get();
        foreach($users as $user){
            $user_privileges = new UserPrivilege();
            $user_privileges->user_id = $user->id;
            foreach($modules as $module){
                $name = $module->name;
                $user_privileges->$name = 1;
            }
            $user_privileges->save();
        }
    }
}
