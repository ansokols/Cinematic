<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">
{{--    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">--}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @yield('head')
    <link rel="shortcut icon" type="image/jpg" href="{{asset('images/favicon.jpg')}}"/>
    <link rel="icon" type="image/jpg" href="{{asset('images/favicon.png')}}"/>
</head>

<body>
    <div class="page-header">
        <div class="left-block">
            <img class = "menu-left" onclick="mySecondFunction()" src="{{asset('images/menu.svg')}}" alt="">
            <a href="{{route('home')}}" class="logo-container">
                <p class="title">Cinematic</p>
            </a>
        </div>

        <div class="right-block">
            @yield('pageTitle')

            @yield('exit')

            <img class="end" src="{{asset('images/menu.svg')}}" onclick="myThirdFunction()" alt="">
        </div>
    </div>

    <div class="page-content">
        @yield('content')
    </div>

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
                <a href="{{route('home')}}">Зараз у кіно</a>
                <a href="{{route('soon')}}">Скоро у прокаті</a>
                <a href="{{route('cinemas')}}">Кінотеатри</a>
                <a href="{{route('faq')}}">Допомога</a>
                <a href="{{route('about')}}">Про компанію</a>
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
                <a href="{{route('home')}}">Зараз у кіно</a>
                <a href="{{route('soon')}}">Скоро у прокаті</a>
                <a href="{{route('cinemas')}}">Кінотеатри</a>
                <a href="{{route('faq')}}">Допомога</a>
                <a href="{{route('about')}}">Про компанію</a>
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

    <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>
    @yield('script')

</body>
</html>
