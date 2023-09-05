<!---->
<!--Код шаблона страниц для копирования-->
<!---->
@extends('layout')

@section('head')
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <title>Cinematic - Головна сторінка</title>
@endsection
@section('pageTitle')
<div class="text"><p>Зараз у кіно</p></div>
@endsection

@section('content')

@endsection

@section('inner-list')
<a id="now" href="">Зараз у кіно</a>
<a href="">Скоро у прокаті</a>
<a href="{{route('cinemas')}}">Кінотеатри</a>
<a href="">Допомога</a>
<a href="">Про компанію</a>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
@endsection
