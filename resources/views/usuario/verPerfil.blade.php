@extends('layouts.app')

@section('title', 'Mi Perfil | Galeria Virtual')


@section('styles')
    <link rel="stylesheet" href="{{ asset('css/perfil_usuario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection


@section('content')
    <div class="perfil-container">
        <h1 class="titulo">Mi Perfil</h1>
        <div class="perfil-info">
            <img src="{{ asset($usuario->imagen_perfil) }}" alt="Imagen de perfil" class="perfil-imagen">
            <p><strong>Usuario:</strong> {{ $usuario->nombre_usuario }}</p>
            <p><strong>Nombre:</strong> {{ $usuario->nombre }} {{ $usuario->apellido }}</p>
            <p><strong>Email:</strong> {{ $usuario->correo }}</p>
            <p><strong>Biografía:</strong> {{ $usuario->biografia ?? 'No disponible' }}</p>
            <a href="{{ route("mostrarEditorPerfil") }}" class="btn btn-primary">Editar Perfil</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="boton-cerrar-sesion">Cerrar Sesión</button>
            </form>
        </div>
    </div>
    <br>
@endsection
