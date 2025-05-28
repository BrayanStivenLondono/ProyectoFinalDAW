@extends('layouts.app')

@section('title', 'Inicio | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slider_tipo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
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
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <button class="next">
            <img src="{{ asset("imagenes/fle.png") }}" alt="Siguiente" class="rotate">
        </button>
    </div>
    <div class="hero">
        <h1>Bienvenido a la Galería Virtual</h1>
        <p>Explora obras de arte únicas, descubre artistas emergentes y vive una experiencia visual sin igual.</p>
        @guest
            <a href="{{ route('login') }}" class="btn">Iniciar sesión</a>
            <a href="{{ route('registro') }}" class="btn">Registrarse</a>
        @endguest
        <br>
    </div>


    <div class="descripcion">
        <h2>¿Qué es esta galería?</h2>
        <p>
            Esta plataforma es un espacio digital donde artistas pueden compartir sus creaciones
            y los visitantes pueden explorar diferentes estilos, técnicas y colecciones.
            Puedes seguir a tus artistas favoritos, descubrir nuevas obras y participar en nuestra comunidad.
        </p>
    </div>

    <h1 class="titulo">Colecciones</h1>
    <div class="carrusel-tipo">
        <div class="obras-carrusel">
            @foreach($obrasPorTipo as $obra)
                <div class="obra-item">
                    <a href="{{ route('obras.coleccion', $obra->tipo) }}">
                        <img src="{{ asset($obra->imagen) }}" alt="{{ $obra->titulo }}">
                    </a>
                </div>
            @endforeach

            @foreach($obrasPorTipo as $obra)
                <div class="obra-item">
                    <a href="{{ route('obras.coleccion', $obra->tipo) }}">
                        <img src="{{ asset($obra->imagen) }}" alt="{{ $obra->titulo }}">
                    </a>
                </div>
            @endforeach
        </div>
        <br>

        <h1 class="titulo">Artistas</h1>
        <div class="carrusel-artistas">
            <!-- -->
        </div>

    </div>
@endsection
