@extends('layouts.master')

@section('title')
    {{ $page->title }} | @parent
@stop
@section('meta')
    <meta name="title" content="{{ $page->meta_title}}" />
    <meta name="description" content="{{ $page->meta_description }}" />
@stop

@section('content')
    <div class="main-image">
        <img src="{{Theme::url('img/background-home.jpg')}}" class="img-responsive">
        <h1>
            <div>
            Najlepsze apartamenty w Polsce! <br>
            Rezerwuj i korzystaj <br>
            </div>
            <a class="btn-warning btn" href="/apartamenty/lista">Sprawdź!</a>
        </h1>
    </div>
@stop
