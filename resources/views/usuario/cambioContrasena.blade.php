@extends('layouts.app')

@section('title', 'Cambiar contraseña | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/editar_contrasena.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route("configuracion") }}">Configuracion</a> &gt;
    <a href="{{ route("panelPrivacidad") }}">Privacidad</a> &gt;
    <a href="{{ route("cambiarContrasena") }}">Actualizar Contraseña</a>
@endsection


@section('content')
    <h1 class="titulo">Actualizar contraseña</h1>

    <div class="contenedor-cambiar-contrasena">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('cambiarContrasena') }}">
            @csrf

            <div class="form-group">
                <label for="password_actual">Contraseña actual</label>
                <input type="password" name="password_actual" required>
                @error('password_actual')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nueva_password">Nueva contraseña</label>
                <input type="password" name="nueva_password" required>
                @error('nueva_password')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nueva_password_confirmation">Confirmar nueva contraseña</label>
                <input type="password" name="nueva_password_confirmation" required>
            </div>

            <button type="submit">Cambiar contraseña</button>
            <div class="boton-container">
                <button onclick="window.history.back()" class="boton-retroceso">Cancelar</button>
            </div>
        </form>
    </div>
    <br>
@endsection
