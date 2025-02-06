<?php

namespace Database\Seeders;

use App\Models\IncidentPiority;
use App\Models\IncidentType;
use App\Models\ResourcesDispatcher;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            ModuleSeeder::class,
            UserRoleSeeder::class,
            UserSeeder::class,
            IncidentTypeSeeder::class,
            IncidentStatusSeeder::class,
            IncidentPrioritySeeder::class,
            FieldSeeder::class
        ]);
    }
}
