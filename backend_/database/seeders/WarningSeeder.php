<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('warnings')->insert([
            [
                "id"                => 1,
                "sensor_id"         => 2,
                "sensor_thresholds" => 4.50,
                "status"            => "normal",
                "color"             => "#10b053",
                "is_check"          => 0
            ],
            [
                "id"                => 2,
                "sensor_id"         => 2,
                "sensor_thresholds" => 5.00,
                "status"            => "alert",
                "color"             => "#e3d407",
                "is_check"          => 1
            ],
            [
                "id"                => 3,
                "sensor_id"         => 2,
                "sensor_thresholds" => 5.50,
                "status"            => "alarm",
                "color"             => "#f59905",
                "is_check"          => 1
            ],
            [
                "id"                => 4,
                "sensor_id"         => 2,
                "sensor_thresholds" => 6.00,
                "status"            => "critical",
                "color"             => "#f50505",
                "is_check"          => 1
            ],


            //station 2

            [
                "id"                => 5,
                "sensor_id"         => 5,
                "sensor_thresholds" => 1.20,
                "status"            => "normal",
                "color"             => "#10b053",
                "is_check"          => 0
            ],
            [
                "id"                => 6,
                "sensor_id"         => 5,
                "sensor_thresholds" => 1.50,
                "status"            => "alert",
                "color"             => "#e3d407",
                "is_check"          => 1
            ],
            [
                "id"                => 7,
                "sensor_id"         => 5,
                "sensor_thresholds" => 2.50,
                "status"            => "alarm",
                "color"             => "#f59905",
                "is_check"          => 1
            ],
            [
                "id"                => 8,
                "sensor_id"         => 5,
                "sensor_thresholds" => 3.50,
                "status"            => "critical",
                "color"             => "#f50505",
                "is_check"          => 1
            ],
            

            //station 3

            [
                "id"                => 9,
                "sensor_id"         => 8,
                "sensor_thresholds" => 1.00,
                "status"            => "normal",
                "color"             => "#10b053",
                "is_check"          => 0
            ],
            [
                "id"                => 10,
                "sensor_id"         => 8,
                "sensor_thresholds" => 2.50,
                "status"            => "alert",
                "color"             => "#e3d407",
                "is_check"          => 1
            ],
            [
                "id"                => 11,
                "sensor_id"         => 8,
                "sensor_thresholds" => 5.00,
                "status"            => "alarm",
                "color"             => "#f59905",
                "is_check"          => 1
            ],
            [
                "id"                => 12,
                "sensor_id"         => 8,
                "sensor_thresholds" => 6.50,
                "status"            => "critical",
                "color"             => "#f50505",
                "is_check"          => 1
            ],

            //station 4
            [
                "id"                => 13,
                "sensor_id"         => 11,
                "sensor_thresholds" => 1.00,
                "status"            => "normal",
                "color"             => "#10b053",
                "is_check"          => 0
            ],
            [
                "id"                => 14,
                "sensor_id"         => 11,
                "sensor_thresholds" => 2.50,
                "status"            => "alert",
                "color"             => "#e3d407",
                "is_check"          => 1
            ],
            [
                "id"                => 15,
                "sensor_id"         => 11,
                "sensor_thresholds" => 3.50,
                "status"            => "alarm",
                "color"             => "#f59905",
                "is_check"          => 1
            ],
            [
                "id"                => 16,
                "sensor_id"         => 11,
                "sensor_thresholds" => 4.00,
                "status"            => "critical",
                "color"             => "#f50505",
                "is_check"          => 1
            ],

            //station 5

            [
                "id"                => 17,
                "sensor_id"         => 14,
                "sensor_thresholds" => 1.50,
                "status"            => "normal",
                "color"             => "#10b053",
                "is_check"          => 0
            ],
            [
                "id"                => 18,
                "sensor_id"         => 14,
                "sensor_thresholds" => 2.50,
                "status"            => "alert",
                "color"             => "#e3d407",
                "is_check"          => 1
            ],
            [
                "id"                => 19,
                "sensor_id"         => 14,
                "sensor_thresholds" => 3.50,
                "status"            => "alarm",
                "color"             => "#f59905",
                "is_check"          => 1
            ],
            [
                "id"                => 20,
                "sensor_id"         => 14,
                "sensor_thresholds" => 5.00,
                "status"            => "critical",
                "color"             => "#f50505",
                "is_check"          => 1
            ],

            //station 6

            // [
            //     "id"                => 21,
            //     "sensor_id"         => 17,
            //     "sensor_thresholds" => 4.30,
            //     "status"            => "normal",
            //     "color"             => "#10b053",
            //     "is_check"          => 0
            // ],
            // [
            //     "id"                => 22,
            //     "sensor_id"         => 17,
            //     "sensor_thresholds" => 4.70,
            //     "status"            => "alert",
            //     "color"             => "#e3d407",
            //     "is_check"          => 1
            // ],
            // [
            //     "id"                => 23,
            //     "sensor_id"         => 17,
            //     "sensor_thresholds" => 5.00,
            //     "status"            => "alarm",
            //     "color"             => "#f59905",
            //     "is_check"          => 1
            // ],
            // [
            //     "id"                => 24,
            //     "sensor_id"         => 17,
            //     "sensor_thresholds" => 5.50,
            //     "status"            => "critical",
            //     "color"             => "#f50505",
            //     "is_check"          => 1
            // ],
            // //station 7

            // [
            //     "id"                => 25,
            //     "sensor_id"         => 20,
            //     "sensor_thresholds" => 5.30,
            //     "status"            => "normal",
            //     "color"             => "#10b053",
            //     "is_check"          => 0
            // ],
            // [
            //     "id"                => 26,
            //     "sensor_id"         => 20,
            //     "sensor_thresholds" => 6.00,
            //     "status"            => "alert",
            //     "color"             => "#e3d407",
            //     "is_check"          => 1
            // ],
            // [
            //     "id"                => 27,
            //     "sensor_id"         => 20,
            //     "sensor_thresholds" => 6.50,
            //     "status"            => "alarm",
            //     "color"             => "#f59905",
            //     "is_check"          => 1
            // ],
            // [
            //     "id"                => 28,
            //     "sensor_id"         => 20,
            //     "sensor_thresholds" => 7.50,
            //     "status"            => "critical",
            //     "color"             => "#f50505",
            //     "is_check"          => 1
            // ],

            // //station 8

            // [
            //     "id"                => 29,
            //     "sensor_id"         => 23,
            //     "sensor_thresholds" => 1.00,
            //     "status"            => "normal",
            //     "color"             => "#10b053",
            //     "is_check"          => 0
            // ],
            // [
            //     "id"                => 30,
            //     "sensor_id"         => 23,
            //     "sensor_thresholds" => 2.00,
            //     "status"            => "alert",
            //     "color"             => "#e3d407",
            //     "is_check"          => 1
            // ],
            // [
            //     "id"                => 31,
            //     "sensor_id"         => 23,
            //     "sensor_thresholds" => 2.50,
            //     "status"            => "alarm",
            //     "color"             => "#f59905",
            //     "is_check"          => 1
            // ],
            // [
            //     "id"                => 32,
            //     "sensor_id"         => 23,
            //     "sensor_thresholds" => 3.00,
            //     "status"            => "critical",
            //     "color"             => "#f50505",
            //     "is_check"          => 1
            // ],

            // //station 9
            // [
            //     "id"                => 33,
            //     "sensor_id"         => 26,
            //     "sensor_thresholds" => 7.50,
            //     "status"            => "normal",
            //     "color"             => "#10b053",
            //     "is_check"          => 0
            // ],
            // [
            //     "id"                => 34,
            //     "sensor_id"         => 26,
            //     "sensor_thresholds" => 8.00,
            //     "status"            => "alert",
            //     "color"             => "#e3d407",
            //     "is_check"          => 1
            // ],
            // [
            //     "id"                => 35,
            //     "sensor_id"         => 26,
            //     "sensor_thresholds" => 8.20,
            //     "status"            => "alarm",
            //     "color"             => "#f59905",
            //     "is_check"          => 1
            // ],
            // [
            //     "id"                => 36,
            //     "sensor_id"         => 26,
            //     "sensor_thresholds" => 8.50,
            //     "status"            => "critical",
            //     "color"             => "#f50505",
            //     "is_check"          => 1
            // ],

            // //station 10
            // [
            //     "id"                => 37,
            //     "sensor_id"         => 29,
            //     "sensor_thresholds" => 8.50,
            //     "status"            => "normal",
            //     "color"             => "#10b053",
            //     "is_check"          => 0
            // ],
            // [
            //     "id"                => 38,
            //     "sensor_id"         => 29,
            //     "sensor_thresholds" => 8.80,
            //     "status"            => "alert",
            //     "color"             => "#e3d407",
            //     "is_check"          => 1
            // ],
            // [
            //     "id"                => 39,
            //     "sensor_id"         => 29,
            //     "sensor_thresholds" => 9.00,
            //     "status"            => "alarm",
            //     "color"             => "#f59905",
            //     "is_check"          => 1
            // ],
            // [
            //     "id"                => 40,
            //     "sensor_id"         => 29,
            //     "sensor_thresholds" => 9.50,
            //     "status"            => "critical",
            //     "color"             => "#f50505",
            //     "is_check"          => 1
            // ],
        ]);

        $sensors = DB::table('sensors')->select('id')->where('sensor_type',1)->get();
        $status = array("red" => 30.00,"orange" => 15.00, "yellow" => 7.50);
        $colors = array("red" => "#f50505","orange"=>"#f59905","yellow"=> "#e3d407");
        foreach($sensors as $sensor){
            foreach($status as $key => $stat){
                DB::table('warnings')->insert([
                    "sensor_id" => $sensor->id,
                    "sensor_thresholds" => $stat,
                    "status" => $key,
                    "color" => $colors[$key],
                    "is_check" => 1
                ]);
            }
            DB::table('warnings')->insert([
                "sensor_id" => $sensor->id,
                "sensor_thresholds" => 0.00,
                "status" => "no rain",
                "color" => "#808080",
                "is_check" => 0
            ]);
        }

    }
}
