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
            @foreach($data as $film)
            <div class="slide" style = "background-image: url({{asset('images/'.$film["id"].'.jpg')}})"><p class="name"> {{$film["name"]}}</p>
                <div class="overlay">
                    <div class="overlay-header">
                        <a href="{{route('film', $film["id"])}}" class="details">
                            <img src="{{asset('images/information.svg')}}" alt="">
                            <p>Детальніше</p>
                        </a>
                        <a href="{{$film["url"]}}" class="trailer" target="_blank">
                            <img src="{{asset('images/play.svg')}}" alt="">
                            <p>Трейлер</p>
                        </a>
                    </div>

                    <div class="overlay-content">
                        <div class="first"><p id="first">{{$currentCinema -> cinema_name}}</p></div>
                        <div class="second">
                            <p id="second">
                                @if(isset($film["selectedDate"]))
                                    @if($film["selectedDate"] == date('Y-m-d'))
                                        сьогодні
                                    @else
                                        {{Carbon\Carbon::parse($film["selectedDate"])->isoFormat('dddd, D MMMM')}}
                                    @endif
                                @endif
                            </p>
                        </div>
                        <div class="third"><p id="third">Розклад сеансів</p></div>

                        <div class="shedule">
                            <?php /* */$i = 0;/* */ ?>
                            @while($i < count($film["seances"]))
                                <?php /* */$j = 0;/* */ ?>
                                <div class="time-line">
                                    @while($j < 5)
                                        @if($i == count($film["seances"]))
                                            @break;
                                        @endif
                                        @if($film["selectedDate"] == $film["seances"][$i]["date"])
                                            <a href="{{route('seance', $film["seances"][$i]["id"])}}"
                                               @if(isset($film["seances"][$i]["price"]))
                                                    data-toggle="tooltip" title="{{$film["seances"][$i]["price"]}} грн"
                                               @endif
                                            >{{Carbon\Carbon::parse($film["seances"][$i]["time"])->format('H:i')}}</a>
                                            <?php /* */$j++;/* */ ?>
                                        @endif
                                        <?php /* */$i++;/* */ ?>
                                    @endwhile
                                </div>
                            @endwhile
                        </div>
                    </div>

                    <div class="overlay-footer">
                        <a href="{{route('film', $film["id"])}}"> {{$film["name"]}}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="vertical-content">
            @foreach($data as $film)
                <div class="slide" style = "background-image: url({{asset('images/'.$film["id"].'.jpg')}})"><a href="{{route('film', $film["id"])}}" class="name">{{$film["name"]}}</a></div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
@endsection
