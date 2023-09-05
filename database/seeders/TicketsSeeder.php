<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seanceId = 2;
        $price = 140;

        $seats = DB::table('seances')
            ->where('seances.seance_id', '=', $seanceId)
            ->select('seats.seat_id')
            ->join('halls', 'halls.hall_id', '=', 'seances.hall_id')
            ->join('seats', 'seats.hall_id', '=', 'halls.hall_id')
            ->get();

        foreach ($seats as $seat) {
            DB::table('tickets')->insert([
                'seance_id' => $seanceId,
                'status' => rand(0, 1),
                'price' => $price,
                'seat_id' => $seat -> seat_id
            ]);
        }
    }
}
