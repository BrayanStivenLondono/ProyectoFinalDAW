@extends('layouts.app')

@section('title', 'Panel del Artista | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/panel_artista.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/obra.css') }}">
@endsection
@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route('panel.artista') }}">Panel Artista</a>
@endsection

@section('content')
    <div class="panel-artista-container">
        <h1 class="titulo">Panel Artista</h1>
        <div class="artista-info">
            <div class="imagen-perfil">
                <img src="{{ asset($artista->imagen_perfil) }}" alt="Imagen de {{ $artista->nombre_usuario }}">
            </div>
            <div class="detalles">
                <h2>{{ $artista->nombre. " ". $artista->apellido }}</h2>
                <p><strong>Nombre de Usuario:</strong> {{ $artista->nombre_usuario }}
                <p><strong>Correo:</strong> {{ $artista->correo }}</p>
                <p><strong>Biografía:</strong> {{ $artista->biografia }}</p>
                <p><strong>Cantidad Seguidores:</strong> {{ $artista->seguidores->count() }}</p>
            </div>
        </div>
        <div class="subir-obra">
            <a href="{{ route('formCrearObra') }}" class="btn-subir">Subir Obra</a>
        </div>
        <h3 class="seccion-obras">Tus Obras: {{ $artista->nombre ." ". $artista->apellido }}</h3>
        <div class="obra-detalle">
            <div class="obras-grid">
                @forelse($artista->obras as $obra)
                    <div class="obra-card">
                         <img src="{{ asset($obra->imagen) }}" alt="{{ $obra->titulo }}">
                        <div class="obra-info">
                            <h4>{{ $obra->titulo }}</h4>
                            <p><strong>Estilo:</strong> {{ $obra->estilo }}</p>
                        </div>
                        <div class="acciones-artista">
                            <a href="{{ route('verObra', Str::slug($obra->titulo)) }}">Ver detalles</a>
                            <a href="{{ route("obra.editar", $obra->id) }}">Editar Obra</a>
                            <form action="{{ route('artista.eliminarObra', $obra->id) }}" method="POST"
                                  onsubmit="return confirm('¿Estás seguro de eliminar esta obra?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-eliminar">Eliminar Obra</button>
                            </form>
                        </div>
                    </div>

                @empty
                    <p>Este artista aún no tiene obras registradas.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
