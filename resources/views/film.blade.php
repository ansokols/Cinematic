@extends('layout')

@section('head')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/film.css') }}">

    <title>{{$film -> film_name}} | Cinematic</title>
@endsection

@section('pageTitle')
    <div class="text"><p>Про фільм</p></div>
@endsection

@section('content')
    <p id="film-path">Cinematic > Фільми > {{$film -> film_name}}</p>
    <p id="film-name">{{$film -> film_name}}</p>
    <img src="{{asset('images/'.$film -> film_id.'poster.jpg')}}" alt="poster" id="poster" width="275px" height="406px">
    <a href="{{$film -> trailer_url}}" class="trailer" target="_blank">Дивитись трейлер</a>
    <img src="{{asset('images/trailer.png')}}" alt="" class="trailer-img" width="13px" height="17px">

    @auth
        @if (isset($personalRating))
            @if($personalRating -> value == -1)
                <input type="image" class="like" name="like" src = "{{asset('images/like.png')}}" alt="like">
                <input type="image" class="dislike active-dislike" name="dislike" src="{{asset('images/dislike-active.png')}}" alt="dislike">
            @elseif($personalRating -> value == 1)
                <input type="image" class="like active-like" name="like" src = "{{asset('images/like-active.png')}}" alt="like">
                <input type="image" class="dislike" name="dislike" src="{{asset('images/dislike.png')}}" alt="dislike">
            @else
                <input type="image" class="like" name="like" src = "{{asset('images/like.png')}}" alt="like">
                <input type="image" class="dislike" name="dislike" src="{{asset('images/dislike.png')}}" alt="dislike">
            @endif
        @else
            <input type="image" class="like" name="like" src = "{{asset('images/like.png')}}" alt="like" data-like-value="false">
            <input type="image" class="dislike" name="dislike" src="{{asset('images/dislike.png')}}" alt="dislike" data-dislike-value="false">
        @endif
    @endauth
    @guest
        <a href="{{route('login')}}">
            <img src="{{asset('images/like.png')}}" alt="like" class="like-img">
            <img src="{{asset('images/dislike.png')}}" alt="dislike" class="dislike-img">
        </a>
    @endguest

    <p class="like-num">{{$film -> likes}}</p>
    <p class="dislike-num">{{$film -> dislikes}}</p>

    <table id="film-info">
        <tr>
            <td class="col1">Вік:</td>
            <td class="col2">{{$film -> age}}</td>
        </tr>
        <tr>
            <td class="col1">Рік:</td>
            <td class="col2">{{$film -> release_date}}</td>
        </tr>
        <tr>
            <td class="col1">Оригінальна назва:</td>
            <td class="col2">{{$film -> original_name}}</td>
        </tr>
        <tr>
            <td class="col1">Режисер:</td>
            <td class="col2">{{$film -> director}}</td>
        </tr>
        <tr>
            <td class="col1">Період прокату:</td>
            <td class="col2">{{Carbon\Carbon::parse($film -> date_start)->format('d.m.Y')}} - {{Carbon\Carbon::parse($film -> date_end)->format('d.m.Y')}}</td>
        </tr>
        <tr>
            <td class="col1">Рейтинг Imdb:</td>
            <td class="col2">{{$film -> rating_imdb}}</td>
        </tr>
        <tr>
            <td class="col1">Мова:</td>
            <td class="col2">{{$film -> language}}</td>
        </tr>
        <tr>
            <td class="col1">Жанр:</td>
            <td class="col2">{{$film -> genre}}</td>
        </tr>
        <tr>
            <td class="col1">Тривалість:</td>
            <td class="col2">{{Carbon\Carbon::parse($film -> seance_time)->format('G:i')}}</td>
        </tr>
        <tr>
            <td class="col1">Виробництво:</td>
            <td class="col2">{{$film -> production}}</td>
        </tr>
        <tr>
            <td class="col1">Студія:</td>
            <td class="col2">{{$film -> studio}}</td>
        </tr>
        <tr>
            <td class="col1">Сценарій:</td>
            <td class="col2">{{$film -> script}}</td>
        </tr>
        <tr>
            <td class="col1">У головних ролях:</td>
            <td class="col2">{{$film -> main_cast}}</td>
        </tr>
    </table>

    <p class="description">
        {{$film -> description}}
    </p>

    <div class="timetable">
        <div class="timetable-1">
            <p class="timetable-text">Розклад сеансів</p>

            <div class="time-drop" onclick="rotate()">
                <p style="padding-top: 7px;">
                    @if(isset($dates -> first() -> seance_date))
                        @if(session('selectedSeanceDate', $dates -> first() -> seance_date) == date('Y-m-d'))
                            сьогодні
                        @else
                            {{Carbon\Carbon::parse(session('selectedSeanceDate', $dates -> first() -> seance_date))->isoFormat('dddd, D MMMM')}}
                        @endif
                    @else
                        На жаль, сеансів немає 😥
                    @endif
                </p> <img src="{{asset('images/arrow.svg')}}" alt="arrow" height="20px" width="20px" class="time-arrow ">
            </div>

            <div class="dates">
                @foreach($dates as $date)
                    <a href="{{route('seanceDateUpdate', $date -> seance_date)}}">
                        @if($date -> seance_date == date('Y-m-d'))
                            сьогодні
                        @else
                            {{Carbon\Carbon::parse($date -> seance_date)->isoFormat('dddd, D MMMM')}}
                        @endif
                    </a><br><br>
                @endforeach
            </div>
        </div>

        <div class="times">
            <p class="c-c">
                @if(isset($dates -> first() -> seance_date))
                    {{$currentCinema -> cinema_name}}
                @endif
            </p>
            <table class="times-table">
                <?php /* */$i = 0;/* */ ?>
                @while($i < count($seances))
                    <tr>
                        @for($j = 0; $j < 5; $j++)
                            @if($i == count($seances))
                                @break;
                            @endif
                            <td>
                                <a href="{{route('seance', $seances[$i] -> seance_id )}}"
                                   @if(isset($seances[$i] -> price))
                                        data-toggle="tooltip" title="{{$seances[$i] -> price}} грн"
                                   @endif
                                        > {{Carbon\Carbon::parse($seances[$i] -> time_start)->format('H:i')}}</a>
                            </td>
                            <?php /* */$i++;/* */ ?>
                        @endfor
                    </tr>
                @endwhile
            </table>
        </div>
    </div>

    <div class="timetable-sm">
        <div class="timetable-1">
            <p class="timetable-text text-center">Розклад сеансів</p>

            <div class="time-drop time-drop-sm" onclick="rotate()">
                <p style="padding-top: 7px;">
                    @if(isset($dates -> first() -> seance_date))
                        @if(session('selectedSeanceDate', $dates -> first() -> seance_date) == date('Y-m-d'))
                            сьогодні
                        @else
                            {{Carbon\Carbon::parse(session('selectedSeanceDate', $dates -> first() -> seance_date))->isoFormat('dddd, D MMMM')}}
                        @endif
                    @else
                        На жаль, сеансів немає 😥
                    @endif
                </p>
                <img src="{{asset('images/arrow.svg')}}" alt="arrow" height="20px" width="20px" class="time-arrow ">
            </div>

            <div class="dates dates-sm">
                @foreach($dates as $date)
                    <a href="{{route('seanceDateUpdate', $date -> seance_date)}}">
                        @if($date -> seance_date == date('Y-m-d'))
                            сьогодні
                        @else
                            {{Carbon\Carbon::parse($date -> seance_date)->isoFormat('dddd, D MMMM')}}
                        @endif
                    </a><br><br>
                @endforeach
            </div>
        </div>

        <div class="times">
            <p class="c-c">
                @if(isset($dates -> first() -> seance_date))
                    {{$currentCinema -> cinema_name}}
                @endif
            </p>
            <table class="times-table">
                <?php /* */$i = 0;/* */ ?>
                @while($i < count($seances))
                    <tr>
                        @for($j = 0; $j < 5; $j++)
                            @if($i == count($seances))
                                @break;
                            @endif
                            <td>
                                <a href="{{route('seance', $seances[$i] -> seance_id )}}"
                                   @if(isset($seances[$i] -> price))
                                   data-toggle="tooltip" title="{{$seances[$i] -> price}} грн"
                                    @endif
                                > {{Carbon\Carbon::parse($seances[$i] -> time_start)->format('H:i')}}</a>
                            </td>
                            <?php /* */$i++;/* */ ?>
                        @endfor
                    </tr>
                @endwhile
            </table>
        </div>
    </div>
@endsection

@section('inner-list')
    <a href="{{route('home')}}">Зараз у кіно</a>
    <a href="{{route('soon')}}">Скоро у прокаті</a>
    <a href="{{route('cinemas')}}">Кінотеатри</a>
    <a href="{{route('faq')}}">Допомога</a>
    <a href="{{route('about')}}">Про компанію</a>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/film.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.like').on('click', function() {
                let clicked = $(this);
                let action;

                if (clicked.hasClass("active-like")) {
                    action = "unlike";
                    $(".like").attr('src', '../images/like.png');
                    $(".like").removeClass("active-like");

                    $('.like-num').html(function(index, oldhtml) {
                        return (parseInt(oldhtml) - 1);
                    });

                } else if ($(".dislike").hasClass("active-dislike")) {
                    action = "like-undislike";
                    $(".like").attr('src', '../images/like-active.png');
                    $(".like").addClass("active-like");
                    $(".dislike").attr('src', '../images/dislike.png');
                    $(".dislike").removeClass("active-dislike");

                    $('.like-num').html(function(index, oldhtml) {
                        return (parseInt(oldhtml) + 1);
                    });
                    $('.dislike-num').html(function(index, oldhtml) {
                        return (parseInt(oldhtml) - 1);
                    });

                } else {
                    action = "like";
                    $(".like").attr('src', '../images/like-active.png');
                    $(".like").addClass("active-like");

                    $('.like-num').html(function(index, oldhtml) {
                        return (parseInt(oldhtml) + 1);
                    });
                }

                $.ajax({
                    type: "POST",
                    method: "POST",
                    url: "{{ route('ratingUpdate') }}",
                    data: {
                        _token:"{{csrf_token()}}",
                        action: action,
                        film_id: {{$film -> film_id}}
                    }
                });
            });

            $('.dislike').on('click', function() {
                let clicked = $(this);
                let action;

                if (clicked.hasClass("active-dislike")) {
                    action = "undislike";
                    $(".dislike").attr('src', '../images/dislike.png');
                    $(".dislike").removeClass("active-dislike");

                    $('.dislike-num').html(function(index, oldhtml) {
                        return (parseInt(oldhtml) - 1);
                    });

                } else if ($(".like").hasClass("active-like")) {
                    action = "dislike-unlike";
                    $(".dislike").attr('src', '../images/dislike-active.png');
                    $(".dislike").addClass("active-dislike");
                    $(".like").attr('src', '../images/like.png');
                    $(".like").removeClass("active-like");

                    $('.dislike-num').html(function(index, oldhtml) {
                        return (parseInt(oldhtml) + 1);
                    });
                    $('.like-num').html(function(index, oldhtml) {
                        return (parseInt(oldhtml) - 1);
                    });
                } else {
                    action = "dislike";
                    $(".dislike").attr('src', '../images/dislike-active.png');
                    $(".dislike").addClass("active-dislike");

                    $('.dislike-num').html(function(index, oldhtml) {
                        return (parseInt(oldhtml) + 1);
                    });
                }

                $.ajax({
                    type: "POST",
                    method: "POST",
                    url: "{{ route('ratingUpdate') }}",
                    data: {
                        _token:"{{csrf_token()}}",
                        action: action,
                        film_id: {{$film -> film_id}}
                    }
                });
            });
        })
    </script>
@endsection
