@extends('layout')

@section('head')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/cinemas.css') }}">

    <title>Кінотеатри | Cinematic</title>
@endsection
@section('pageTitle')
    <div class="text"><p>Кінотеатри</p></div>
@endsection

@section('content')
    <a href="" class="big-logo">Cinematic</a>
    <div id="city">
        <a href="" class="city">Одеса</a>
        <a href="" class="city">Київ</a>
        <a href="" class="city">Харків</a>
    </div>
    <div class="m">
        @foreach($cinemas as $cinema)
            <div class="matic">
                <img src="{{asset('images/cinema'.$cinema -> cinema_id.'.jpg')}}" alt="cinema" width="366.96px" height="180px" class="image">
                <p class="m4-1">{{$cinema -> cinema_name}}</p>
                <a href="" class="timetable">До розкладу</a>
                <p class="street">{{$cinema -> address}}<br>{{$cinema -> phone_number}}</p>
                <p class="imax">3D IMAX 4DX ATMOS</p>
            </div>
        @endforeach
    </div>
@endsection

@section('inner-list')
    <a href="{{route('home')}}">Зараз у кіно</a>
    <a href="{{route('soon')}}">Скоро у прокаті</a>
    <a id="now" href="">Кінотеатри</a>
    <a href="{{route('faq')}}">Допомога</a>
    <a href="{{route('about')}}">Про компанію</a>
@endsection

@section('script')

@endsection

