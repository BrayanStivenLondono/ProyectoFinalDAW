@extends('layouts.app')

@section('title', 'Panel del Artista | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/panel_artista.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('content')
    <div class="panel-artista-container">
        <h1 class="titulo">Panel Artista</h1>
        <div class="artista-info">
            <div class="imagen-perfil">
                <img src="{{ asset($usuario->imagen_perfil ?? 'imagenes/user_face.png') }}" alt="Imagen de {{ $artista->nombre_usuario }}">
            </div>
            <div class="detalles">
                <h2>{{ $artista->nombre_usuario }}</h2>
                <p><strong>Nombre:</strong> {{ $artista->nombre }} {{ $artista->apellido }}</p>
                <p><strong>Correo:</strong> {{ $artista->correo }}</p>
                <p><strong>Biografía:</strong> {{ $artista->biografia }}</p>
            </div>
        </div>

        <h3 class="seccion-obras">Tus Obras: {{ $artista->nombre ." ". $artista->apellido }}</h3>

        <div class="obras-grid">
            @forelse($artista->obras as $obra)
                <a href="{{ url('/obra/' . Str::slug($obra->titulo)) }}">
                    <div class="obra-card">
                            <img src="{{ asset($obra->imagen) }}" alt="{{ $obra->titulo }}">
                            <h4>{{ $obra->titulo }}</h4>
                            <p><strong>Estilo:</strong> {{ $obra->estilo }}</p>
                            <p><strong>Técnica:</strong> {{ $obra->tecnica }}</p>
                            <p><strong>Año:</strong> {{ $obra->año_creacion }}</p>
                    </div>
                </a>
            @empty
                <p>Este artista aún no tiene obras registradas.</p>
            @endforelse
        </div>
    </div>
@endsection
