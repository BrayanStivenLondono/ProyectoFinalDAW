@extends('layouts.app')

@section('title', 'Publicar Obra | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/formulario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route('panel.artista') }}">Panel Artista</a> &gt;
    <a href="{{ route('formCrearObra') }}">Crear Obra</a>
@endsection

@section('content')
    <h1 class="titulo">Subir Obra</h1>
    <div class="subir-obra-form">
        <form action="{{ route('subirObra') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="titulo">Título:</label>
            <input type="text" name="titulo" value="{{ old('titulo') }}" required>
            @error('titulo')
            <div class="error">{{ $message }}</div>
            @enderror

            <label for="estilo">Estilo:</label>
            <select name="estilo" id="estilo" required>
                <option value="">Selecciona un estilo</option>
                @foreach ($estilos as $estilo)
                    <option value="{{ $estilo }}" {{ old('estilo') == $estilo ? 'selected' : '' }}>{{ $estilo }}</option>
                @endforeach
            </select>
            @error('estilo')
            <div class="error">{{ $message }}</div>
            @enderror

            <label for="tecnica">Técnica:</label>
            <select name="tecnica" id="tecnica" required>
                <option value="">Selecciona una técnica</option>
                @foreach ($tecnicas as $tecnica)
                    <option value="{{ $tecnica }}" {{ old('tecnica') == $tecnica ? 'selected' : '' }}>{{ $tecnica }}</option>
                @endforeach
            </select>
            @error('tecnica')
            <div class="error">{{ $message }}</div>
            @enderror

            <label for="tipo">Tipo:</label>
            <input type="text" name="tipo" value="{{ old('tipo') }}" required>
            @error('tipo')
            <div class="error">{{ $message }}</div>
            @enderror

            <label for="año_creacion">Año de creación:</label>
            <input type="number" name="año_creacion" value="{{ old('año_creacion') }}" required>
            @error('año_creacion')
            <div class="error">{{ $message }}</div>
            @enderror

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" required>{{ old('descripcion') }}</textarea>
            @error('descripcion')
            <div class="error">{{ $message }}</div>
            @enderror

            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" accept="image/*">
            @error('imagen')
            <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">Guardar Obra</button>
        </form>
    </div>
    <br>
@endsection
