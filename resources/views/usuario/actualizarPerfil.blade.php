@extends('layouts.app')

@section('title', 'Editar Perfil | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/editar_perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('content')
    <div class="perfil-editar-container">
        <h1 class="titulo">Editar Perfil</h1>
        <form action="{{ route('perfil.actualizar') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nombre_usuario">Nombre de Usuario:</label>
                <input type="text" name="nombre_usuario" value="{{ old('nombre_usuario', $usuario->nombre_usuario) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" value="{{ old('apellido', $usuario->apellido) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" value="{{ old('correo', $usuario->correo) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="imagen_perfil">Imagen de Perfil:</label>
                <input type="file" name="imagen_perfil" class="form-control" accept="image/*">
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-success">Guardar Cambios</button>
                <button type="button" class="btn btn-cancel" onclick="window.history.back()">Cancelar</button>
            </div>
        </form>
    </div>
    <br>
@endsection
