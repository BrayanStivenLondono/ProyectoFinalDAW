@extends('layouts.app')

@section('title', 'Panel del Artista | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/panel_artista.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/obra.css') }}">
@endsection

@section('content')
    <div class="panel-artista-container">
        <h1 class="titulo">Panel Artista</h1>
        <div class="artista-info">
            <div class="imagen-perfil">
                <img src="{{ asset($artista->imagen_perfil) }}" alt="Imagen de {{ $artista->nombre_usuario }}">
            </div>
            <div class="detalles">
                <h2>{{ $artista->nombre_usuario }}</h2>
                <p><strong>Nombre:</strong> {{ $artista->nombre }} {{ $artista->apellido }}</p>
                <p><strong>Correo:</strong> {{ $artista->correo }}</p>
                <p><strong>Biografía:</strong> {{ $artista->biografia }}</p>
            </div>
        </div>
        <div class="subir-obra">
            <a href="#">Subir Obra</a>
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
                            <p><strong>Técnica:</strong> {{ $obra->tecnica }}</p>
                            <p><strong>Año:</strong> {{ $obra->año_creacion }}</p>
                        </div>
                        <div class="acciones-artista">
                            <a href="{{ route('verObra', $obra->titulo)}}">Ver detalles</a>
                            <a href="{{ route("obra.editar", $obra->id) }}">Editar Obra</a>
                            <form action="{{ route('admin.eliminarObra', $obra->id) }}" method="POST"
                                  onsubmit="return confirm('¿Estás seguro de eliminar esta receta?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-eliminar">Eliminar Receta</button>
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
