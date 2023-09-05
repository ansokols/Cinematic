@extends('layout')

@section('head')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/about.css') }}">

    <title>Про компанію | Cinematic</title>
@endsection
@section('pageTitle')
    <div class="text"><p>Про компанію</p></div>
@endsection

@section('content')
    <main id="main">
        <div id="afisha">
            <div id="blur">
                <div id="aflogo">Cinematic</div>
            </div>
        </div>

        <div id="content">
            <h2 >Про компанію:</h2>
            <p>
                Cinematic - це найбільша мережа кінотеатрів в Україні заснована у 2004 році.
                <br>
                Cinematic - це 28 кінотеатрів та 141 кінозал у найбільших містах України.
                <br>
                Відповідно до кращої світової практики корпоративного управління, у серпні 2018 року був сформований найвищий орган управління компанією Cinematic – борд, до складу якого увійшли впливові українські підприємці, управлінці і лідери громадської думки.
                <br>
                Cinematic активно підтримує та інвестує у розвиток українського кінематографу.
            </p>

            <h2>Наші особливості:</h2>
            <p>
            - унікальні смаки продукції попкорн-бару;
            <br>
            - selfie-friendly дизайн інтер'єрів;
            <br>
            - стандартні зали із місцями підвищеного комфорту в задніх рядах та інноваційні формати IMAX та ScreenX;
            <br>
            - VIP кінотеатр з ексклюзивним сервісом у головному ТРЦ країни - ЦУМ у Києві;
            <br>
            </p>
        </div>
    </main>

    <footer id="footer">
        Зв'яжіться з нами <br><br><br> <img src="{{asset('images/Соцсети.svg')}}" alt="">
    </footer>
@endsection

@section('inner-list')
    <a href="{{route('home')}}">Зараз у кіно</a>
    <a href="{{route('soon')}}">Скоро у прокаті</a>
    <a href="{{route('cinemas')}}">Кінотеатри</a>
    <a href="{{route('faq')}}">Допомога</a>
    <a id="now" href="">Про компанію</a>
@endsection

@section('script')
@endsection
