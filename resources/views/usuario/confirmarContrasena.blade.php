@extends('layouts.app')

@section('title', 'Confirmar | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/confirmarIdentidad.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('content')
    <div class="form-confirmacion">
        <form method="POST" action="{{ route('confirmarContrasena.post') }}">
            @csrf
            <h2>Confirma tu contraseña</h2>
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Confirmar</button>

            @error('password')
            <div class="error">{{ $message }}</div>
            @enderror
        </form>
    </div>
    <br>
@endsection
