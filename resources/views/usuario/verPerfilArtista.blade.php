@extends('layouts.app')

@section('title', $artista->nombre." " .$artista->apellido. ' | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/ver_perfil_artista.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route('artistas.index') }}">Artistas</a> &gt;
    <a href="{{ route('artista.perfil', ['slug' => Str::slug($artista->nombre . ' ' . $artista->apellido)])}}"> {{ $artista->nombre ." " .$artista->apellido }}</a>
@endsection

@section('content')
    <div class="perfil-artista-container">
        <div class="artista-info">
            <img src="{{ asset($artista->imagen_perfil) }}" alt="Imagen de perfil" class="imagen-perfil">
            <h2>{{ $artista->nombre }} {{ $artista->apellido }}</h2>
            <p class="biografia">{{ $artista->biografia ?? 'Este artista aún no ha agregado una biografía.' }}</p>
        </div>

        <div class="obras-artista">
            @php use Illuminate\Support\Str; @endphp
            <h3>Obras de {{ $artista->nombre }}</h3>
            @if($artista->obras->isEmpty())
                <p>Este artista aún no ha publicado ninguna obra.</p>
            @else
                <div class="galeria-obras">
                    @foreach($artista->obras as $obra)
                        <div class="obra-card">
                            <a href="{{ url('/obra/' . Str::slug($obra->titulo)) }}">
                                <img src="{{ asset($obra->imagen) }}" alt="{{ $obra->titulo }}">
                                <h4>{{ $obra->titulo }}</h4>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
