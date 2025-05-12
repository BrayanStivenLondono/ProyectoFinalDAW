@extends('layouts.app')

@section('title', 'Configuración de Usuario | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/configuracion_usuario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('content')
    <div class="configuracion-container">
        <h1 class="titulo">Configuración</h1>

        <div class="configuracion-opciones">
            <ul>
                <li><a href="{{ route("mostrarEditorPerfil") }}">Editar Perfil</a></li>
                <li><a href="#">Privacidad</a></li>
                <li><a href="#">Notificaciones</a></li>
                <li><a href="#">Redes Sociales</a></li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="btn btn-danger">
                        Cerrar Sesión
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
@endsection
