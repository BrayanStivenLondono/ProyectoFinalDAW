@extends('layouts.app')

@section('title', 'Artistas | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/artistas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route('artistas.index') }}">Artistas</a>
@endsection

@section('content')
    <h1 class="titulo">Explorar Artistas</h1>
    <div class="artistas-container">
        <div class="filtros-wrapper">
            <div class="filtros-barra">
                <form action="{{ route('artistas.index') }}" method="GET" class="filtros-form">
                    <input type="text" name="nombre" class="filtro-input" placeholder="Buscar por nombre..." value="{{ request('nombre') }}">
                    <button type="submit" class="filtro-boton">Filtrar</button>
                </form>
            </div>
        </div>
        <div class="lista-artistas">
            @forelse ($artistas as $artista)
                <div class="artista-card">
                    <a href="{{ route('artista.perfil', Str::slug($artista->nombre . ' ' . $artista->apellido)) }}">
                        <img src="{{ asset($artista->imagen_perfil ?? 'imagenes/user_default.png') }}" alt="Perfil de {{ $artista->nombre }}">
                        <h3>{{ $artista->nombre }} {{ $artista->apellido }}</h3>
                    </a>
                </div>
            @empty
                <p>No se encontraron artistas.</p>
            @endforelse
        </div>
    </div>
    <div class="paginacion">
        {{ $artistas->appends(request()->query())->links('pagination::simple-bootstrap-5') }}
    </div>
    <br>
@endsection
