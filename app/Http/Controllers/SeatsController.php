<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SeatsController extends Controller
{
    public function seatsUpdate(Request $request) {        //контроллер для обновления рейтинга фильма
        DB::table('orders')->insert([
            'price' => $request['price'],
            'operation_date' => date('Y-m-d H:i:s'),
            'user_id' => Auth::id(),
            'seance_id' => $request['seance_id']
        ]);

        $orderId = DB::table('orders')->select('orders.order_id')->orderby('order_id', 'desc')->first();

        $ticketsId = $request['tickets'];
        $ticketsId = json_decode($ticketsId,false);


        for ($i = 0; $i < count($ticketsId); $i++) {
            DB::table('tickets')
                ->where('tickets.ticket_id', '=', $ticketsId[$i])
                ->update([
                    'order_id' => $orderId -> order_id,
                    'status' => 1
                ]);
        }
    }
}
