@extends('layouts.app')

@section('title', 'Editar Perfil | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/editar_perfil.css') }}">
@endsection

@section('content')
    <div class="perfil-editar-container">
        <h2>Editar Perfil</h2>
        <form action="{{ route('perfil.actualizar') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" value="{{ old('apellido', $usuario->apellido) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="biografia">Biografía:</label>
                <textarea name="biografia" class="form-control">{{ old('biografia', $usuario->biografia) }}</textarea>
            </div>

            <div class="form-group">
                <label for="imagen_perfil">Imagen de Perfil:</label>
                <input type="file" name="imagen_perfil" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-success">Guardar Cambios</button>
            <a href="{{ route('perfil') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
