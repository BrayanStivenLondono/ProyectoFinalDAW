@extends('layouts.app')

@section('title', 'Colecciones | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/colecciones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slider_tipo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route('obra.colecciones') }}">Colecciones</a>
@endsection

@section('content')
    <h1 class="titulo">Colecciones</h1>
    <div class="colecciones-lista">
        @forelse ($obrasPorTipo as $obra)
            <a href="{{ route('obras.coleccion', $obra->tipo) }}" class="coleccion-item" style="background-image: url('{{ asset($obra->imagen) }}')">
                <div class="overlay">
                    <div class="texto-coleccion">
                        <h3>{{ ucfirst($obra->tipo) }}</h3>
                        <h4>Piezas: {{ $obra->total }}</h4>
                    </div>
                </div>
            </a>
        @empty
            <p>No hay colecciones disponibles.</p>
        @endforelse
            <div class="paginacion">
                {{ $obrasPorTipo->links('pagination::simple-bootstrap-5') }}
            </div>
    </div>
@endsection
