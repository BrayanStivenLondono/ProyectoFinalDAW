@extends('layouts.configuration')

@section('title', 'Mi Perfil | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/configuracion_usuario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/perfil_usuario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route("configuracion") }}">Ajustes</a> &gt;
    <a href="{{ route("usuario.perfil", $usuario->nombre ." ".$usuario->apellido) }}">Perfil</a>
@endsection

@section('config-content')
    <div class="perfil-container">
        <div class="perfil-info">
            <img src="{{ asset($usuario->imagen_perfil) }}" alt="Imagen de perfil" class="perfil-imagen">
            <p><strong>Usuario:</strong> {{ $usuario->nombre_usuario }}</p>
            <p><strong>Nombre:</strong> {{ $usuario->nombre }} {{ $usuario->apellido }}</p>
            <p><strong>Email:</strong> {{ $usuario->correo }}</p>
            <p><strong>Biografía:</strong> {{ $usuario->biografia ?? 'No disponible' }}</p>
            <a href="{{ route("mostrarEditorPerfil") }}" class="btn btn-primary">Editar Perfil</a>
        </div>
@endsection
