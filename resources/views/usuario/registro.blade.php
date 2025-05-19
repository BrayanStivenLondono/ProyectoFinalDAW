@extends('layouts.app')

@section('title', 'Registro | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/registro_usuario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('breadcrumbs')

@endsection

@section('content')
    <div class="registro-wrapper">
        <div class="registro-container">
            <h1 class="titulo">Registro</h1>

            <form action="{{ route('registro') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nombre_usuario">Nombre de Usuario</label>
                    <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" name="apellido" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" id="correo" name="correo" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" id="contrasena" name="contrasena" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="contrasena_confirmation">Confirmar Contraseña</label>
                    <input type="password" id="contrasena_confirmation" name="contrasena_confirmation" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="tipo">Tipo de Usuario</label>
                    <select id="tipo" name="tipo" class="form-control" required>
                        <option value="artista">Artista</option>
                        <option value="visitante">Visitante</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="biografia">Biografía (Opcional)</label>
                    <textarea id="biografia" name="biografia" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="enlaces_sociales">Enlaces Sociales (Opcional)</label>
                    <input type="text" id="enlaces_sociales" name="enlaces_sociales" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Registrarse</button>
                <p>Si Tiene Una Cuenta <a style="color: #0056b3" href="{{ route("login.form") }}">Inicia Sesión</a> </p>
            </form>
            </div>
        <div class="imagen-fondo">
            <img src="{{ asset("imagenes/welcome.png") }}" alt="">
        </div>
    </div>
@endsection

