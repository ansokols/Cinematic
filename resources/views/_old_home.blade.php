@extends('layout')

@section('head')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{asset('css/home.css')}}">

    @if($isHomePage)
        <title>Зараз у кіно | Cinematic</title>
    @else
        <title>Скоро у прокаті | Cinematic</title>
    @endif
@endsection

@section('pageTitle')
    @if($isHomePage)
        <div class="text"><p>Зараз у кіно</p></div>
    @else
        <div class="text"><p>Скоро у прокаті</p></div>
    @endif
@endsection

@section('content')
    <div class="page-content" onclick="deleteDropdown()">
        <div class="slider-container">
            <?php /* */$i = 0;/* */ ?>
            @foreach($films as $film)
            <div class="slide" style = "background-image: url({{asset('images/'.$film -> film_id.'.jpg')}})"><p class="name"> {{$film -> film_name}}</p>
                <div class="overlay">
                    <div class="overlay-header">
                        <a href="{{route('film', $film -> film_id)}}" class="details">
                            <img src="{{asset('images/information.svg')}}" alt="">
                            <p>Детальніше</p>
                        </a>
                        <a href="{{$film -> trailer_url}}" class="trailer" target="_blank">
                            <img src="{{asset('images/play.svg')}}" alt="">
                            <p>Трейлер</p>
                        </a>
                    </div>

                    <div class="overlay-content">
                        <div class="first"><p id="first">{{$currentCinema -> cinema_name}}</p></div>
                        <div class="second">
                            <p id="second">
                                @if(!$seances -> isEmpty() && $film -> film_id == $seances[$i] -> film_id)
                                    @if($seances[$i] -> seance_date == date('Y-m-d'))
                                        сьогодні
                                    @else
                                        {{Carbon\Carbon::parse($seances[$i] -> seance_date)->isoFormat('dddd, D MMMM')}}
                                    @endif
                                @endif
                            </p>
                        </div>
                        <div class="third"><p id="third">Розклад сеансів</p></div>

                        <div class="shedule">
                            <?php /* */$first = true;/* */ ?>
                            <?php /* */$validDate = true;/* */ ?>
                            @while($i < count($seances) && $film -> film_id == $seances[$i] -> film_id)
                                <div class="time-line">
                                    <?php /* */$j = 0;/* */ ?>
                                    @while($j < 5)
                                        @if($i == count($seances) || $film -> film_id != $seances[$i] -> film_id)
                                            @break;
                                        @endif

                                        @if($first)
                                            <a href="{{route('seance', $seances[$i] -> seance_id)}}" data-toggle="tooltip" title="95грн">{{Carbon\Carbon::parse($seances[$i] -> time_start)->format('H:i')}}</a>
                                            <?php /* */$first = false;/* */ ?>
                                            <?php /* */$j++;/* */ ?>
                                        @elseif($seances[$i-1] -> seance_date != $seances[$i] -> seance_date)
                                            <?php /* */$validDate = false;/* */ ?>
                                        @elseif($validDate)
                                            <a href="{{route('seance', $seances[$i] -> seance_id)}}" data-toggle="tooltip" title="95грн">{{Carbon\Carbon::parse($seances[$i] -> time_start)->format('H:i')}}</a>
                                            <?php /* */$j++;/* */ ?>
                                        @endif

                                        <?php /* */$i++;/* */ ?>
                                    @endwhile
                                </div>
                            @endwhile
                        </div>
                    </div>

                    <div class="overlay-footer">
                        <a href="{{route('film', $film -> film_id)}}"> {{$film -> film_name}}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="vertical-content">
            @foreach($films as $film)
                <div class="slide" style = "background-image: url({{asset('images/'.$film -> film_id.'.jpg')}})"><a href="{{route('film', $film -> film_id)}}" class="name">{{$film -> film_name}}</a></div>
            @endforeach
        </div>
    </div>
@endsection

@section('inner-list')
    @if($isHomePage)
        <a id="now" href="">Зараз у кіно</a>
        <a href="{{route('soon')}}">Скоро у прокаті</a>
        <a href="{{route('cinemas')}}">Кінотеатри</a>
        <a href="{{route('faq')}}">Допомога</a>
        <a href="{{route('about')}}">Про компанію</a>
    @else
        <a href="{{route('home')}}">Зараз у кіно</a>
        <a id="now" href="">Скоро у прокаті</a>
        <a href="{{route('cinemas')}}">Кінотеатри</a>
        <a href="{{route('faq')}}">Допомога</a>
        <a href="{{route('about')}}">Про компанію</a>
    @endif
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
@endsection
