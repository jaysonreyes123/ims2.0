<?php

namespace Database\Seeders;

use App\Models\IncidentPiority;
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
            RoleSeeder::class,
            UserSeeder::class,
            IncidentTypeSeeder::class,
            IncidentStatusSeeder::class,
            IncidentPrioritySeeder::class,
            ResourcesTypeSeeder::class,
            ResourcesStatusSeeder::class,
            ResourcesDispatchSeeder::class,
            ResourcesConditionSeeder::class,
            CallerTypeSeeder::class,
            ResponderTypeSeeder::class,
            PrePlanClassificaionSeeder::class,
        ]);
    }
}
