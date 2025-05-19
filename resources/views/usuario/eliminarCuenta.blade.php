@extends('layouts.app')

@section('title', ' Darse de Baja | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/baja.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route("configuracion") }}">Configuracion</a> &gt;
    <a href="{{ route("panelPrivacidad") }}">Privacidad</a>
@endsection

@section('content')
    <h1 class="titulo">Eliminar cuenta</h1>

    <div class="form-contenedor">
        <p>⚠️ Esta acción es irreversible. Todos tus datos serán eliminados.</p>

        <form method="POST" action="{{ route('eliminarCuenta') }}" onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.')">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn-eliminar">Eliminar cuenta</button>
        </form>
    </div>
    <br>
@endsection
