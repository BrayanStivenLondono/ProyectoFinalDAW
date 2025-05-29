@extends('layouts.app')

@section('title', 'Editar Obra | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/editar_obra.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('content')
    <h1 class="titulo">Editar Obra</h1>
    <div class="editar-obra-container">
        <form action="{{ route('obra.actualizar', $obra->id) }}" method="POST" class="form-editar-obra">
            @csrf
            @method('PUT')

            <label for="titulo">Título:</label>
            <input type="text" name="titulo" value="{{ old('titulo', $obra->titulo) }}" required>
            @error('titulo')
            <div class="error">{{ $message }}</div>
            @enderror

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion">{{ old('descripcion', $obra->descripcion) }}</textarea>
            @error('descripcion')
            <div class="error">{{ $message }}</div>
            @enderror

            <label for="año_creacion">Año:</label>
            <input type="number" name="año_creacion" value="{{ old('año_creacion', $obra->año_creacion) }}">
            @error('año_creacion')
            <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">Actualizar</button>

            @if ($errors->any())
                <div class="error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
    <br>
@endsection
