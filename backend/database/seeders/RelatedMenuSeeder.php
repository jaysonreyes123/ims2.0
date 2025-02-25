<?php

namespace Database\Seeders;

use App\Models\RelatedMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelatedMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('related_menus')->insert([
            [
                "module" => 1,
                "related_module" => 10,
                "label" => "Media",
                "action" => "add"
            ],
            [
                "module" => 1,
                "related_module" => 11,
                "label" => "Comment",
                "action" =>null

            ],
            [
                "module" => 1,
                "related_module" => 2,
                "label" => "Resources",
                "action" =>"select"
            ],
            [
                "module" => 1,
                "related_module" => 6,
                "label" => "Responder",
                "action" =>"add"
            ],
            [
                "module" => 1,
                "related_module" => 3,
                "label" => "Pre Plan",
                "action" =>"select"
            ],
            [
                "module" => 2,
                "related_module" => 11,
                "label" => "Comment",
                "action" =>null
            ],
            [
                "module" => 1,
                "related_module" => 12,
                "label" => "Action Plan",
                "action" =>"add"
            ],
        ]);
    }
}
