@extends('layouts.app')

@section('title', 'Login | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login_usuario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('breadcrumbs')

@endsection

@section('content')
    <div class="login-container">
        <h1 class="titulo">Iniciar sesión</h1>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nombre_usuario">Nombre de Usuario</label>
                <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" name="contrasena" id="contrasena" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Iniciar sesión</button>

            Si No Tiene Una Cuenta <a style="color: #0056b3" href="{{ route("registro.form") }}">Registrate</a>
        </form>
    </div>
@endsection
