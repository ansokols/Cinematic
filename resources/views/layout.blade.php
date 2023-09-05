<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">--}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    @yield('head')
    <link rel="shortcut icon" type="image/jpg" href="{{asset('images/favicon.jpg')}}"/>
    <link rel="icon" type="image/jpg" href="{{asset('images/favicon.png')}}"/>
</head>
<body>
    <div class="page-header">
        <div class="left-block">
            <img class = "menu-left" onclick="mySecondFunction()" src="{{asset('images/menu.svg')}}" alt="">
            <a href="{{route('home')}}">
                <div class="logo-container">
                    <p class="title">Cinematic</p>
                </div>
            </a>
        </div>

        <div class="right-block">
            <div id="1" class="cinema">
                <div class="cinema-name"><p>{{$currentCinema -> cinema_name}}, {{$currentCinema -> city}}</p></div>
                @yield('pageTitle')
                <div class="cinema-list" onclick="myFunction()"><img src="{{asset('images/arrow.svg')}}" alt=""></div>

                <div class="dropdown-content" id="myDropdown">
                    @foreach($cinemas as $cinema)
                        <a href="{{route('cinemaUpdate', $cinema -> cinema_id)}}">{{$cinema -> cinema_name}}, {{$cinema -> city}}</a>
                    @endforeach
                </div>
            </div>

            @auth
                <a href="{{route('tickets')}}" class="account">
                    <div class="enter"><p>Особистий кабінет</p></div>

                    <svg class="svg" width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle  cx="16.5" cy="16.5" r="16.5" fill="#393636"/>
                        <circle class="circle" cx="16.5" cy="16.5" r="12.5" fill="#515151"/>
                        <line x1="8" y1="17.25" x2="23" y2="17.25" stroke="white" stroke-width="1.5"/>
                        <path d="M17 23L23.1142 17.7593C23.5798 17.3602 23.5798 16.6398 23.1142 16.2407L17 11" stroke="white" stroke-width="1.5"/>
                    </svg>
                </a>
            @endauth
            @guest
                <a href="{{route('login')}}" class="account">
                    <div class="enter"><p>Увійти</p></div>

                    <svg class="svg" width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle  cx="16.5" cy="16.5" r="16.5" fill="#393636"/>
                        <circle class="circle" cx="16.5" cy="16.5" r="12.5" fill="#515151"/>
                        <line x1="8" y1="17.25" x2="23" y2="17.25" stroke="white" stroke-width="1.5"/>
                        <path d="M17 23L23.1142 17.7593C23.5798 17.3602 23.5798 16.6398 23.1142 16.2407L17 11" stroke="white" stroke-width="1.5"/>
                    </svg>
                </a>
            @endguest

            <img class="end" src="{{asset('images/menu.svg')}}" onclick="myThirdFunction()" alt="">
        </div>
    </div>

    @yield('content')

    <div class="dropoverlay" onclick="deleteDropLeft()">

    </div>

    <div class="dropleft">
        <div class="dropleft-header">
            <img onclick="deleteDropLeft()" src="{{asset('images/cancel.png')}}" alt="" >
            <div class="languages">
                <p class="ru">RU</p>
                <p class="ua">UA</p>
            </div>
        </div>

        <div class="dropleft-content">
            <div class="logo">
                <img src="{{asset('images/logo.png')}}" alt="">
            </div>

            <div class="inner-list">
                @yield('inner-list')
            </div>

            <div class="cabinet">
                <p>Особистий кабінет</p>
                @auth
                    <a href="{{route('tickets')}}"><img src="{{asset('images/cabinet.svg')}}" alt=""></a>
                @endauth
                @guest
                    <a href="{{route('login')}}"><img src="{{asset('images/cabinet.svg')}}" alt=""></a>
                @endguest
            </div>
        </div>

        <div class="dropleft-footer">
            <p>Служба підтримки</p>
            <div class="telephone">
                <img src="{{asset('images/phone.svg')}}" alt="">
                <p>0 800 300 600</p>
            </div>
            <p> Ми в соціальних мережах</p>
            <div class="networks">
                <a href="{{url('https://uk-ua.facebook.com/')}}" target="_blank"><img src="{{asset('images/facebook.svg')}}" alt=""></a>
                <a href="{{url('https://www.viber.com/ru/')}}" target="_blank"><img src="{{asset('images/viber.svg')}}" alt=""></a>
                <a href="{{url('https://www.instagram.com/')}}" target="_blank"><img src="{{asset('images/instagram.svg')}}" alt=""></a>
            </div>
        </div>
    </div>

    <div class="dropleft full">
        <div class="dropleft-header">
            <img onclick="deleteDropLeft()" src="{{asset('images/cancel.png')}}"  alt="" >
            <div class="languages">
                <p class="ru">RU</p>
                <p class="ua">UA</p>
            </div>
        </div>

        <div class="dropleft-content">
            <div class="logo">
                <img src="{{asset('images/logo.png')}}" alt="">
            </div>

            <div class="inner-list">
                @yield('inner-list')
            </div>

            <div class="cabinet">
                <p>Особистий кабінет</p>
                @auth
                    <a href="{{route('tickets')}}"><img src="{{asset('images/cabinet.svg')}}" alt=""></a>
                @endauth
                @guest
                    <a href="{{route('login')}}"><img src="{{asset('images/cabinet.svg')}}" alt=""></a>
                @endguest
            </div>

        </div>

        <div class="dropleft-footer">
            <p>Служба підтримки</p>
            <div class="telephone">
                <img src="{{asset('images/phone.svg')}}" alt="">
                <p>0 800 300 600</p>
            </div>
            <p> Ми в соціальних мережах</p>
            <div class="networks">
                <a href="{{url('https://uk-ua.facebook.com/')}}" target="_blank"><img src="{{asset('images/facebook.svg')}}" alt=""></a>
                <a href="{{url('https://www.viber.com/ru/')}}" target="_blank"><img src="{{asset('images/viber.svg')}}" alt=""></a>
                <a href="{{url('https://www.instagram.com/')}}" target="_blank"><img src="{{asset('images/instagram.svg')}}" alt=""></a>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="{{ asset('js/layout.js') }}"></script>
    @yield('script')
</body>
</html>
