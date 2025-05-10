@extends('layouts.app')

@section('title', 'Configuración de Usuario | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/configuracion_usuario.css') }}">
@endsection

@section('content')
    <div class="configuracion-container">
        <h2>Configuración de Usuario</h2>

        <div class="configuracion-opciones">
            <ul>
                <li><a href="{{ route("mostrarEditorPerfil") }}">Editar Perfil</a></li>
                <li><a href="#">Privacidad</a></li>
                <li><a href="#">Notificaciones</a></li>
                <li><a href="#">Redes Sociales</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
@endsection
