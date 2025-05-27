@extends('layouts.app')

@section('title', 'Configuración de Usuario | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/configuracion_usuario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route("configuracion") }}">Agustes</a>
@endsection

@section('content')
    <h1 class="titulo">Agustes</h1>
    <div class="configuracion-container">
        <div class="configuracion-opciones">
            <ul>
                <li><a href="{{ route("mostrarEditorPerfil") }}">Perfil de Usuario</a></li>
                <li><a href="{{ route("panelPrivacidad") }}">Privacidad</a></li>
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
