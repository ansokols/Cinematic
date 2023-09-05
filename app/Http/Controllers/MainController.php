<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MainController extends Controller {
//
//    Загрузка списка всех кинотеатров в дропдаун производится в AppServiceProvider
//

    public function cinemaUpdate($currentCinemaId) {        //обновляет ID текущего кинотеатра при выборе в шапке, сбрасывает выюранную дату сеансов
        session(['currentCinemaId' => $currentCinemaId]);
        session(['selectedSeanceDate' => date('00-00-00')]);
        return redirect()->back();
    }

    public function seanceDateUpdate($selectedSeanceDate) {     //обновляет дату сеансов при выборе на странице фильма
        session(['selectedSeanceDate' => $selectedSeanceDate]);
        return redirect()->back();
    }

    public function getCurrentCinema($currentCinemaId) {        //возвращает все поля текущего кинотеатра
        return DB::table('cinemas')
            ->where('cinema_id', '=', $currentCinemaId)
            ->first();
    }

    public function home() {        //контроллер для страниц "Сейчас в кино" и "Скоро в кино"
        $currentCinemaId = session('currentCinemaId', 3);         //обновляется через Route 'cinemaUpdate'
        $currentCinema = $this->getCurrentCinema($currentCinemaId);     //выбранный кинотеатр

        $now = date('Y-m-d');       //сегодняшняя дата

        if (is_null(request()->segment(count(request()->segments())))) {
            $isHomePage = true;     //при передаче в view отобразит дроплефт и заголовок главной страницы
            $operator = '<=';
        } else {
            $isHomePage = false;        //при передаче в view отобразит дроплефт и заголовок страницы "скоро в прокате"
            $operator = '>';
        }

        $films = DB::table('halls')     //список всех актуальных уникальных фильмов для выбранного кинотеатра (сортировка по актуальности)
            ->where('halls.cinema_id', '=', $currentCinemaId)
            ->select('films.film_id', 'films.film_name', 'films.trailer_url')
            ->join('seances','halls.hall_id', '=' ,'seances.hall_id')
            ->join('films','films.film_id', '=' ,'seances.film_id')
            ->whereDate('date_start', $operator, date('3000-01-01'))     //вместо date должно быть $now
            ->whereDate('date_end', '>=', date('2000-01-01'))       //вместо date должно быть $now
            ->groupBy('films.film_id')
            ->orderByDesc('date_start')
            ->get();

        $seances = DB::table('halls')       //список всех сеансов для всех кинотеатров (сортировка по актуальности фильма и времени проката)
            ->where('halls.cinema_id', '=', $currentCinemaId)
            ->select('seances.film_id', 'seances.seance_id', 'seances.seance_date', 'seances.time_start', 'seances.quality')
            ->join('seances','halls.hall_id', '=' ,'seances.hall_id')
            ->where('seances.seance_date', '>=', date('1021-10-22'))        //вместо date должно быть $now
//            ->join('films','films.film_id', '=' ,'seances.film_id')
//            ->orderByDesc('date_start')
            ->orderBy('seance_date')
            ->orderBy('time_start')
            ->get();

        $data = array();
        foreach ($films as $i => $film) {
            $filmSeances = $seances->where('film_id', '=' , $film -> film_id);
            $selectedDate = "";
            if(isset($filmSeances -> first() -> seance_date)) {
                $selectedDate = $filmSeances -> first() -> seance_date;
            }
            $data[$i] = array(
                "id" => $film -> film_id,
                "name" => $film -> film_name,
                "url" => $film -> trailer_url,
                "selectedDate" => $selectedDate,
                "seances" => array()
            );

            $j = 0;
            foreach ($filmSeances as $seance) {
                $price = DB::table('seances')
                    ->where('seances.seance_id', '=', $seance -> seance_id)
                    ->select('tickets.price')
                    ->join('tickets','tickets.seance_id', '=' ,'seances.seance_id')
                    ->first();

                $price = $price -> price ?? null;

                $data[$i]["seances"][$j] = array(
                    "id" => $seance -> seance_id,
                    "date" => $seance -> seance_date,
                    "time" => $seance -> time_start,
                    "quality" => $seance -> quality,
                    "price" => $price
                );
                $j++;
            }
        }

//        return dd(compact(  'isHomePage', 'currentCinema',  'films', 'seances', 'data'));
//        return view('home', compact(  'currentCinema', 'isHomePage', 'films', 'seances'));
        return view('home', compact(  'currentCinema', 'isHomePage', 'data'));
    }


    public function cinemas() {     //контроллер для страницы "Кинотеатры"
        $currentCinemaId = session('currentCinemaId', 3);         //обновляется через Route 'cinemaUpdate'
        $currentCinema = $this->getCurrentCinema($currentCinemaId);     //выбранный кинотеатр

        return view('cinemas', compact('currentCinema',));
    }


    public function about() {       //контроллер для страницы "Про компанию"
        $currentCinemaId = session('currentCinemaId', 3);         //обновляется через Route 'cinemaUpdate'
        $currentCinema = $this->getCurrentCinema($currentCinemaId);     //выбранный кинотеатр

        return view('about', compact('currentCinema',));
    }


    public function faq() {     //контроллер для страницы "Помошь"
        $currentCinemaId = session('currentCinemaId', 3);         //обновляется через Route 'cinemaUpdate'
        $currentCinema = $this->getCurrentCinema($currentCinemaId);     //выбранный кинотеатр

        return view('faq', compact('currentCinema',));
    }


    public function film($film_id) {        //контроллер для страницы фильма
        $currentCinemaId = session('currentCinemaId', 3);         //обновляется через Route 'cinemaUpdate'
        $currentCinema = $this->getCurrentCinema($currentCinemaId);     //выбранный кинотеатр
        $now = date('Y-m-d');       //сегодняшняя дата


        $film = DB::table('films')      //фильм, выбранный в home.blade.php
            ->where('films.film_id', '=', $film_id)
            ->first();

        $personalRating = null;
        if (Auth::check()) {
            $personalRating = DB::table('ratings')
                ->where('ratings.user_id', '=', Auth::id())
                ->where('ratings.film_id', '=', $film -> film_id)
                ->first();
        }

        $dates = DB::table('halls')      //список всех дат для выбранного фильма в выбранном кинотеатре (сортировка по актуальности фильма и времени проката)
            ->where('halls.cinema_id', '=', $currentCinemaId)       //TODO в списке не должно быть прошедших сеансов (или хотя бы неактуальных дней)
            ->select('seances.seance_date')
            ->join('seances','halls.hall_id', '=' ,'seances.hall_id')
            ->where('seances.seance_date', '>=', date('2020-10-25'))        //вместо date должно быть $now
            ->join('films','films.film_id', '=' ,'seances.film_id')
            ->where('films.film_id', '=', $film -> film_id)
            ->groupBy('seance_date')
            ->orderBy('seance_date')
            ->get();

        $now = date('Y-m-d');       //сегодняшняя дата
        if (url()->previous() != url()->current() || session('selectedSeanceDate') == date('00-00-00')) {       //обновляет дату сеансов филма на первую существующую при смене кинотеатра на странице филма
            if(isset($dates -> first() -> seance_date)) {
                session(['selectedSeanceDate' => $dates -> first() -> seance_date]);
            }
        }
        $nearestDate = session('selectedSeanceDate', $now);      //выбранная дата


        $seances = DB::table('halls')       //список всех сеансов для выбранного фильма в выбранном кинотеатре на текущую дату (сортировка по актуальности фильма и времени проката)
            ->where('halls.cinema_id', '=', $currentCinemaId)
            ->select('seances.seance_id', 'seances.seance_date', 'seances.time_start', 'seances.quality')
            ->join('seances','halls.hall_id', '=' ,'seances.hall_id')
            ->whereDate('seances.seance_date', '=', $nearestDate)
            ->join('films','films.film_id', '=' ,'seances.film_id')
            ->where('films.film_id', '=', $film -> film_id)
            ->orderBy('time_start')
            ->get();

        foreach ($seances as $seance) {
            $price = DB::table('seances')
                ->where('seances.seance_id', '=', $seance -> seance_id)
                ->select('tickets.price')
                ->join('tickets','tickets.seance_id', '=' ,'seances.seance_id')
                ->first();

            $seance -> price = null;
            if(isset($price -> price)) {
                $seance -> price = $price -> price;
            }
        }

//        return dd(compact('currentCinema', 'film', 'personalRating', 'dates', 'seances'));
        return view('film', compact('currentCinema', 'film', 'personalRating', 'dates', 'seances'));
    }


    public function seance($seance_id) {     //контроллер для страницы сеанса
        $currentCinemaId = session('currentCinemaId', 3);         //обновляется через Route 'cinemaUpdate'
        $currentCinema = $this->getCurrentCinema($currentCinemaId);     //выбранный кинотеатр


        $seance = DB::table('seances')
            ->where('seances.seance_id', '=', $seance_id)
            ->select('films.film_id', 'films.film_name', 'halls.hall_name', 'halls.rows', 'halls.columns', 'seances.seance_id', 'seances.seance_date', 'seances.time_start', 'seances.time_end', 'seances.quality')
            ->join('halls','halls.hall_id','=','seances.hall_id')
            ->join('films', 'films.film_id','=','seances.film_id')
            ->first();

        $tickets = DB::table('tickets')
            ->where('tickets.seance_id', '=', $seance_id)
            ->select('tickets.ticket_id', 'tickets.status', 'tickets.price', 'seats.row', 'seats.column')
            ->join('seats', 'seats.seat_id','=','tickets.seat_id')
            ->get();

//        $orderId = DB::table('orders')->select('orders.order_id')->orderby('order_id', 'desc')->first();
//        return dd(compact('orderId'));
//        return dd(compact('seance', 'tickets'));
        return view('seance', compact('currentCinema','seance', 'tickets'));
    }

    public function tickets() {     //контроллер для страницы с билетами в личном кабинете
        $currentCinemaId = session('currentCinemaId', 3);         //обновляется через Route 'cinemaUpdate'
        $user = Auth::user();

        $orders = DB::table('orders')
            ->where('orders.user_id', '=', Auth::id())
            ->select('orders.order_id', 'orders.price', 'orders.operation_date', 'orders.confirmation', 'films.film_name', 'seances.seance_date')
            ->join('tickets','tickets.order_id', '=' ,'orders.order_id')
            ->join('seances','seances.seance_id', '=' ,'tickets.seance_id')
            ->join('films','films.film_id', '=' ,'seances.film_id')
            ->groupBy('orders.order_id')
            ->get();

        $tickets = DB::table('orders')
            ->where('orders.user_id', '=', Auth::id())
            ->select('orders.order_id', 'seats.row', 'seats.column')
            ->join('tickets','tickets.order_id', '=' ,'orders.order_id')
            ->join('seats','seats.seat_id', '=' ,'tickets.seat_id')
            ->get();

//        return dd(compact('user', 'orders', 'tickets'));
        return view('tickets', compact('user', 'orders', 'tickets'));
    }

    public function profile() {     //контроллер для страницы профиля в личном кабинете
        $currentCinemaId = session('currentCinemaId', 3);         //обновляется через Route 'cinemaUpdate'
        $currentCinema = $this->getCurrentCinema($currentCinemaId);     //выбранный кинотеатр
        $user = Auth::user();

        return view('profile', compact('currentCinema', 'user'));
    }
}
