@extends('layouts.configuration')

@section('title', 'Tus Favoritos | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/configuracion_usuario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/favoritos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route("configuracion") }}">Configuración</a> &gt;
    <a href="{{ route("favoritos.ver") }}">Favoritos</a>
@endsection

@section('config-content')
    <div class="favoritos-container">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @elseif(session('info'))
            <div class="alert-info">{{ session('info') }}</div>
        @endif

        @if($favoritos->isEmpty())
            <p>No tienes obras en favoritos todavía.</p>
        @else
            <div class="obras-grid">
                @foreach($favoritos as $obra)
                    <div class="obra-card">
                        <img src="{{ asset($obra->imagen) }}" alt="{{ $obra->titulo }}">
                        <div class="obra-botones">
                            <a href="{{ route('verObra', $obra->titulo) }}" class="btn-ver">Ver Obra</a>

                            <form action="{{ route('favorito.eliminar', $obra->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-quitar">Quitar de Favoritos</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
