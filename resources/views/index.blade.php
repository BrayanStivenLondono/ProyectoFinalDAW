@extends('layouts.app')

@section('title', 'Inicio | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slider_tipo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('content')
    <div class="carrusel-container">
        <button class="prev">
            <img src="{{ asset("imagenes/fle.png") }}" alt="Anterior">
        </button>
        <div class="carrusel">
            <div class="slides">
                @foreach($obras as $obra)
                    <div class="slide">
                        <a href="{{ route('obras.coleccion', $obra->tipo) }}" class="coleccion-item">
                            <img src="{{ asset($obra->imagen) }}" alt="{{$obra->titulo}}">
                            <h3>{{ $obra->titulo }}</h3>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <button class="next">
            <img src="{{ asset("imagenes/fle.png") }}" alt="Siguiente" class="rotate">
        </button>
    </div>

    <h1 class="titulo">Colecciones</h1>
    <div class="carrisel-tipo">
        <div class="obras">
            @foreach($obrasPorTipo as $obra)
                <div class="obra">
                    <a href="{{ route("obras.coleccion", $obra->tipo) }}">
                        <img src=" {{ asset($obra->imagen) }}" alt="{{ $obra->titulo }}">
                        <h4 class="tipo-obra">{{ $obra->tipo }}</h4>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
