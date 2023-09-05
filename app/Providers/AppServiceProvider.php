<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Date\Date;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Date::setlocale(config('app.locale'));

        $cinemas = DB::table('cinemas')     //список всех кинотеатров (для выпадающего списка шапки, используется в layout.blade.php)
            ->orderBy('city')
            ->orderBy('cinema_name')
            ->get();
        View::share('cinemas', $cinemas);
    }
}
