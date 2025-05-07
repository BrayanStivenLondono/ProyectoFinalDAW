@extends('layouts.app')

@section('title', 'Colecciones | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/colecciones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slider_tipo.css') }}">

@endsection

@section('content')
    <h1 class="colecciones">Colecciones</h1>
    <div class="colecciones-lista">
        @forelse ($obrasPorTipo as $obra)
            <a href="{{ route('obras.coleccion', $obra->tipo) }}" class="coleccion-item">
                <div class="imagen-wrapper">
                    <img src="{{ asset($obra->imagen) }}" alt="Imagen de {{ $obra->tipo }}">
                </div>
                <div class="texto-coleccion">
                    <h3>{{ ucfirst($obra->tipo) }}</h3>
                    <h4>Cantidad de piezas: {{ $obra->total }}</h4>
                </div>
            </a>
        @empty
            <p>No hay colecciones disponibles.</p>
        @endforelse
    </div>
@endsection
