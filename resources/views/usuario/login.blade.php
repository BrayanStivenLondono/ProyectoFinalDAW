@extends('layouts.app')

@section('title', 'Iniciar Sesión | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/formulario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route("login.form") }}">Iniciar Sesión</a>
@endsection

@section('content')
    <h1 class="titulo">Iniciar sesión</h1>
    <div class="login-container">
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nombre_usuario">Nombre de Usuario</label>
                <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" value="{{ old('nombre_usuario') }}" required>
                @error('nombre_usuario')
                <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <div class="input-with-checkbox">
                    <input type="password" name="contrasena" id="contrasena" class="form-control" required>
                    <label class="checkbox-container">
                        <input type="checkbox" class="toggle-password" onclick="mostrarContrasena()">
                    </label>
                </div>
                @error('contrasena')
                <small class="erro">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Iniciar sesión</button>

            @if($errors->has('login_error'))
                <div class="error" style="margin-top: 1rem;">
                    {{ $errors->first('login_error') }}
                </div>
            @endif

            <p> Si No tienes una cuenta  <a style="color: #0056b3" href="{{ route('registro.form') }}">Regístrate</a> </p>
        </form>
        <br>
    </div>

    <script>
        function mostrarContrasena(){
            var tipo = document.getElementById("contrasena");
            if(tipo.type === "password") {
                tipo.type = "text";
            } else {
                tipo.type = "password";
            }
        }
    </script>
@endsection
