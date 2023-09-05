<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hallId = 3;

        $rows = DB::table('halls')
            ->where('halls.hall_id', '=', $hallId)
            ->select('halls.rows')
            ->first();

        $columns = DB::table('halls')
            ->where('halls.hall_id', '=', $hallId)
            ->select('halls.columns')
            ->first();

        for($i = 0; $i < $rows -> rows; $i++) {
            for($j = 0; $j < $columns -> columns; $j++) {
                DB::table('seats')->insert([
                    'row' => $i + 1,
                    'column' => $j + 1,
                    'hall_id' => $hallId
                ]);
            }
        }
    }
}
