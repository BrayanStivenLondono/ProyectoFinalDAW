@extends('layouts.app')

@section('title', 'Harvard Museo | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index_api.css') }}">

@endsection

@section('content')
    <div class="harvard-museum">
        <h1 class="titulo">Harvard Museum</h1>

        <div class="container">
            <div class="botones">
                <ul>
                    <li><a href="#">Artistas</a></li>
                    <li><a href="#">Obras</a></li>
                    <li><a href="#">Otros</a></li>
                </ul>
            </div>
        </div>
    </div>
    <br>
@endsection
