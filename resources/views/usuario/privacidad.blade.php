@extends('layouts.configuration')

@section('title', 'Privacidad | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/configuracion_usuario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('breadcrumbs')
<a href="{{ url('/') }}">Inicio</a> &gt;
<a href="{{ route("configuracion") }}">Configuracion</a> &gt;
<a href="{{ route("panelPrivacidad") }}">Privacidad</a>
@endsection

@section('config-content')
    <h1 class="titulo">Privacidad</h1>
    <div class="configuracion-container">
        <div class="configuracion-opciones">
            <ul>
                <li><a href="{{ route("dardeBaja") }}">Darse de Baja</a></li>
                <li><a href="{{ route("formContrasena") }}">Actualizar Contraseña</a></li>
            </ul>
        </div>
    </div>
@endsection
