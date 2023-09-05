@extends('dashboard')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/tickets.css') }}">
    <title>Квитки | Cinematic</title>
@endsection

@section('pageTitle')
    <div class="text"><p>Квитки</p></div>
@endsection

@section('exit')
    @auth
        <a href="{{route('signout')}}" class="exit">
            <p>Вийти</p>

            <svg class="svg" width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle  cx="16.5" cy="16.5" r="16.5" fill="#393636"/>
                <circle class="circle" cx="16.5" cy="16.5" r="12.5" fill="#515151"/>
                <line x1="8" y1="17.25" x2="23" y2="17.25" stroke="white" stroke-width="1.5"/>
                <path d="M17 23L23.1142 17.7593C23.5798 17.3602 23.5798 16.6398 23.1142 16.2407L17 11" stroke="white" stroke-width="1.5"/>
            </svg>
        </a>
    @endauth
    @guest
        <a href="{{route('login')}}" class="exit">
            <p>Увійти</p>

            <svg class="svg" width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle  cx="16.5" cy="16.5" r="16.5" fill="#393636"/>
                <circle class="circle" cx="16.5" cy="16.5" r="12.5" fill="#515151"/>
                <line x1="8" y1="17.25" x2="23" y2="17.25" stroke="white" stroke-width="1.5"/>
                <path d="M17 23L23.1142 17.7593C23.5798 17.3602 23.5798 16.6398 23.1142 16.2407L17 11" stroke="white" stroke-width="1.5"/>
            </svg>
        </a>
    @endguest
@endsection

@section('content')
    <div class="tickets">
        <div class="tickets-header">
            <div class="pers-info">
                <p class="name">{{$user -> email}}</p>
            </div>
            <div class="buttons">
                <a href="" class="bar">
                    <img src="{{asset('images/ticket.png')}}" alt="">
                    <p>Квитки</p>
                </a>
                <a href="{{route('profile')}}" class="profile">
                    <img src="{{asset('images/profile.png')}}" alt="">
                    <p>Профіль</p>
                </a>
            </div>
        </div>

        <div class="tickets-content">
            <div class="your-tickets">
                <h1>Ваші квитки</h1>
                <div class="table">
                    <div class="cols">
                        <p>Дата операції</p>
                        <p>Фільм</p>
                        <p>Дата сеансу</p>
                        <p>Квитки</p>
                        <p>Статус</p>
                        <p>Вартість</p>
                        <p>Деталі</p>
                    </div>

                    @foreach($orders as $order)
                        <div class="record" id="{{$order -> order_id}}">
                            <p>{{$order -> operation_date}}</p>
                            <p>{{$order -> film_name}}</p>
                            <p>{{$order -> seance_date}}</p>
                            <p>
                                <?php /* */$i = 0;/* */ ?>
                                @foreach($tickets as $ticket)
                                    @if($order -> order_id == $ticket -> order_id)
                                            <?php /* */$i ++;/* */ ?>
                                    @endif
                                @endforeach
                                {{$i}}
                            </p>
                            <p>
                                @if(!$order -> confirmation)
                                    Підтверджено
                                @else
                                    Підтверджується
                                @endif
                            </p>
                            <p>{{$order -> price}} грн.</p>
                            <div class="image-holder" onclick="ticketDetails({{$order -> order_id}}, '{{$order -> order_id}}ar', 'inf{{$order -> order_id}}')">
                                <img src="{{asset('images/down.png')}}" alt="" id="{{$order -> order_id}}ar" >
                            </div>
                        </div>

                        <div class="record more-info" id="inf{{$order -> order_id}}">
                            <p>№ замовлення: {{$order -> order_id}}</p>
                            <p>Квитки:</p>
                            <p>
                            @foreach($tickets as $ticket)
                                @if($order -> order_id == $ticket -> order_id)
                                    Ряд {{$ticket -> row}}, місце {{$ticket -> column}}
                                @endif
                            @endforeach
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/tickets.js') }}"></script>
@endsection
