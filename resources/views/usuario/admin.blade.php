@extends('layouts.app')

@section('title', 'Panel de Administracion | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/vista_admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">

@endsection

@section('content')
    <div class="admin-panel">
            <h1 class="titulo">Administración</h1>

            <div class="main-content">
                <p>Bienvenido al panel de administración. Seleccione una opción del menú para continuar.</p>
            </div>
            <div class="navigation">
                <ul>
                    <li><a href="{{ route("panel_obras") }}"><h2>Obras</h2></a></li>
                    <li><a href="{{ route("panel_usuarios") }}"><h2>Usuarios</h2></a></li>
                    <li><a href="{{ route("harvard") }}"><h2>Museo</h2></a></li>
                </ul>
            </div>
    </div>
    <br>
@endsection
