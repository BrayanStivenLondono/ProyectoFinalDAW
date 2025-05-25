@extends('layouts.app')

@section('title', 'Museo | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index_api.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route("rijks.index") }}">Museo</a>
@endsection

@section('content')
    <div class="harvard-museum">
        <h1 class="titulo">RIJKS MUSEUM</h1>

        <div class="container">
            <div class="botones">
                <ul>
                    <li><a href="#">Artistas</a></li>
                    <li><a href="{{ route("rijks.obras") }}">Obras</a></li>
                    <li><a href="#">Colecciones</a></li>
                </ul>
            </div>
        </div>
    </div>
    <br>
@endsection
