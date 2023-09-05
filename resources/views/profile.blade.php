@extends('dashboard')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <title>Профіль | Cinematic</title>
@endsection

@section('pageTitle')
    <div class="text"><p>Профіль</p></div>
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
                <p class="name">Костя Шуригін</p>
                <!-- <h1 class="surname">Фамилия</h1> -->
            </div>
            <div class="buttons">
                <a href = "{{route('tickets')}}" class="bar">
                    <img src="{{asset('images/ticket.png')}}" alt="">
                    <p>Квитки</p>
                </a>
                <a href = "" class="profile">
                    <img src="{{asset('images/profile.png')}}" alt="">
                    <p>Профіль</p>
                </a>
            </div>
        </div>

        <div class="tickets-content">
            <div class="your-tickets">
                <div class="table">
                    <div class="table-header">
                        <h1>Контактна інформація</h1>
                        <p>З номером телефону ви зможете побачити всі свої замовлення.
                            Пошта потрібна для резервного доступу в кабінет.</p>
                    </div>

                    <div class="table-content">
                        <div class="field">
                            <div class="field-left">
                                <p>ваше місто:</p>
                                <p class="city">Одеса</p>
                            </div>

                            <div class="field-right">
                                <img src="{{asset('images/edit.png')}}" alt="" class="edit">
                            </div>
                        </div>

                        <div class="field">
                            <div class="field-left">
                                <p>мобільний телефон:</p>
                                <p class="city">0977954334</p>
                            </div>

                            <div class="field-right">
                                <img src="{{asset('images/edit.png')}}" alt="" class="edit">
                            </div>
                        </div>

                        <div class="field">
                            <div class="field-left">
                                <p>E-MAIL::</p>
                                <p class="city">gfark345@gmail.com</p>
                            </div>

                            <div class="field-right">
                                <img src="{{asset('images/edit.png')}}" alt="" class="edit">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

{{--            <div class="your-tickets">--}}
{{--                <div class="table">--}}
{{--                    <div class="table-header">--}}
{{--                        <h1>Персональна інформація</h1>--}}
{{--                        <p>Розкажи про себе!</p>--}}
{{--                    </div>--}}

{{--                    <div class="table-content">--}}
{{--                        <div class="field">--}}
{{--                            <div class="field-left">--}}
{{--                                <p>ім'я:</p>--}}
{{--                                <p class="city">Костя</p>--}}
{{--                            </div>--}}

{{--                            <div class="field-right">--}}
{{--                                <img src="{{asset('images/edit.png')}}" alt="" class="edit">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="field">--}}
{{--                            <div class="field-left">--}}
{{--                                <p>прізвище:</p>--}}
{{--                                <p class="city">Шуригін</p>--}}
{{--                            </div>--}}

{{--                            <div class="field-right">--}}
{{--                                <img src="{{asset('images/edit.png')}}" alt="" class="edit">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="field">--}}
{{--                            <div class="field-left">--}}
{{--                                <p>сімейний стан:</p>--}}
{{--                                <p class="city">не визначено</p>--}}
{{--                            </div>--}}

{{--                            <div class="field-right">--}}
{{--                                <img src="{{asset('images/edit.png')}}" alt="" class="edit">--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                        <div class="field">--}}
{{--                            <div class="field-left">--}}
{{--                                <p>дата народження:</p>--}}
{{--                                <p class="city">17.01.2002</p>--}}
{{--                            </div>--}}

{{--                            <div class="field-right">--}}
{{--                                <img src="{{asset('images/edit.png')}}" alt="" class="edit">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="field">--}}
{{--                            <div class="field-left">--}}
{{--                                <p>стать:</p>--}}
{{--                                <p class="city">Чоловік</p>--}}
{{--                            </div>--}}

{{--                            <div class="field-right">--}}
{{--                                <img src="{{asset('images/edit.png')}}" alt="" class="edit">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="field">--}}
{{--                            <div class="field-left">--}}
{{--                                <p>улюблений жанр:</p>--}}
{{--                                <p class="city">трилер</p>--}}
{{--                            </div>--}}

{{--                            <div class="field-right">--}}
{{--                                <img src="{{asset('images/edit.png')}}" alt="" class="edit">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection
