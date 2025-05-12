@extends('layouts.app')

@section('title', $usuario->nombre . ' | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/usuario_publico.css') }}">
@endsection

@section('content')
    <br>
    <div class="perfil-publico">
        <div class="usuario-info">
            <img class="avatar" src="{{ asset($usuario->imagen_perfil ?? 'images/default-avatar.png') }}" alt="Imagen de perfil de {{ $usuario->nombre }}">

            <div class="detalles">
                <h1>{{ $usuario->nombre }} {{ $usuario->apellido }}</h1>
                <p><span class="etiqueta">Correo:</span> {{ $usuario->correo }}</p>

                @if($usuario->tipo === 'artista')
                    <p class="etiqueta">Artista 🎨</p>
                @endif
            </div>
        </div>

        @if($usuario->tipo === 'artista')
            <div class="bio">
                <strong>Biografía:</strong>
                <p>{{ $usuario->biografia }}</p>
            </div>
        @else
            <p>Este usuario no es un artista.</p>
        @endif

        {{-- Aquí podrías incluir comentarios, obras favoritas, etc. --}}
    </div>
    <br><br>
@endsection

