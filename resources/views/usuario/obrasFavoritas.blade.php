@extends('layouts.configuration')

@section('title', 'Tus Favoritos | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/configuracion_usuario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/favoritos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route("configuracion") }}">Ajustes</a> &gt;
    <a href="{{ route("favoritos.ver") }}">Favoritos</a>
@endsection

@section('config-content')
    <!-- Buscador -->
    <form method="GET" action="{{ route("favoritos.ver") }}" class="buscador-favoritos">
        <input type="text" name="q" placeholder="Buscar obra o artista..." value="{{ request('q') }}">
        <button type="submit">🔍 Buscar</button>
    </form>

    <div class="favoritos-container">

        {{-- MENSAJES --}}
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @elseif(session('info'))
            <div class="alert-info">{{ session('info') }}</div>
        @endif

        {{-- GRID UNIFICADA --}}
        <div class="favoritos-grid">

            {{-- OBRAS FAVORITAS --}}
            @foreach($obrasFavoritas as $obra)
                <div class="tarjeta-favorito">
                    <div class="imagen-favorito" style="background-image: url('{{ asset($obra->imagen) }}');"></div>
                    <div class="contenido-favorito">
                        <h3 class="titulo-favorito">{{ $obra->titulo }}</h3>
                        <div class="botones-favorito">
                            <a href="{{ route('verObra', $obra->titulo) }}" class="btn-ver">Ver Obra</a>
                            <form action="{{ route('favorito.eliminar', $obra->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-quitar">Quitar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- ARTISTAS SEGUIDOS --}}
            @foreach($artistasSeguidos as $artista)
                <div class="tarjeta-favorito">
                    <div class="imagen-favorito" style="background-image: url('{{ asset($artista->imagen_perfil ?? 'imagenes/user_default.png') }}');"></div>
                    <div class="contenido-favorito">
                        <h3 class="titulo-favorito">{{ $artista->nombre }} {{ $artista->apellido }}</h3>
                        <div class="botones-favorito">
                            <a href="{{ route('artista.perfil', Str::slug($artista->nombre . ' ' . $artista->apellido)) }}" class="btn-ver">Ver Artista</a>
                            <form method="POST" action="{{ route('dejar.seguir.usuario', $artista->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-quitar">Dejar de seguir</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        {{-- MENSAJE SI ESTÁ VACÍO --}}
        @if($obrasFavoritas->isEmpty() && $artistasSeguidos->isEmpty())
            <p class="mensaje-vacio">No tienes favoritos todavía.</p>
        @endif
    </div>
@endsection
