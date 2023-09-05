@extends('dashboard')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Вхід | Cinematic</title>
@endsection

@section('pageTitle')
    <div class="text"><p>Авторизація</p></div>
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
    <div class="login">
        <div class="login-header">
            <h1>Вхід до особистого кабінету</h1>
            <p>Тут всі ваші замовлення та особиста інформація</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="login-content">
                <input id="lgn" type="text" class="login-form" placeholder="email" name="email" required autofocus>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif

                <input id="pswrd" type="password" class="password-form" placeholder="пароль" name="password" required>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="login-footer">
                <button type="submit" class="btn-sub">
                    <h1>
                        Увійти
                    </h1>
                </button>

                <div class="btn-reg">
                    <a href="{{route('registration')}}">Реєстрація</a>
                </div>
            </div>

            @if (Illuminate\Support\Facades\Session::has('message'))
                <div class="login-footer">
                    {{Illuminate\Support\Facades\Session::get('message')}}
                </div>
            @endif
        </form>
    </div>
@endsection
