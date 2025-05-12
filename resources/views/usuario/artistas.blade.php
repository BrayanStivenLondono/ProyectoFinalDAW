@extends('layouts.app')

@section('title', 'Artistas | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/artistas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route('artistas.index') }}">Artistas</a>
@endsection

@section('content')
    <h1 class="titulo">Explorar Artistas</h1>
    <div class="artistas-container">
        {{-- Filtros --}}
        <div class="filtros-wrapper">
            <div class="filtros-barra">
                <form action="{{ route('artistas.index') }}" method="GET" class="filtros-form">
                    <input type="text" name="nombre" class="filtro-input" placeholder="Buscar por nombre..." value="{{ request('nombre') }}">

                    <select name="orden" class="filtro-select">
                        <option value="">Ordenar por</option>
                        <option value="nombre_asc" {{ request('orden') == 'nombre_asc' ? 'selected' : '' }}>Nombre A-Z</option>
                        <option value="nombre_desc" {{ request('orden') == 'nombre_desc' ? 'selected' : '' }}>Nombre Z-A</option>
                    </select>

                    <button type="submit" class="filtro-boton">Filtrar</button>
                </form>
            </div>
        </div>
        {{-- Lista de artistas --}}
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
@endsection
