@extends('layouts.app')

@section('title', 'Equipo | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/equipo.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route("equipo") }}">Equipo</a> &gt;
@endsection

@section('content')
    <div class="equipo-container">
        <h1 class="titulo">Nuestro Equipo</h1>

        <p>La Galería Virtual es posible gracias al esfuerzo conjunto de un equipo multidisciplinar, apasionado por el arte, la tecnología y la cultura.</p>

        <div class="miembros-equipo">
            <div class="miembro">
                <img src="{{ asset('imagenes/user_default.jpg') }}" alt="Fundador">
                <h3>Ana Martínez</h3>
                <p>Fundadora y Directora General</p>
            </div>
            <div class="miembro">
                <img src="{{ asset('imagenes/user_default.jpg') }}" alt="Curador">
                <h3>Carlos Pérez</h3>
                <p>Curador de Contenido</p>
            </div>
            <div class="miembro">
                <img src="{{ asset('imagenes/user_default.jpg') }}" alt="Desarrollador">
                <h3>Laura Gómez</h3>
                <p>Desarrolladora Web</p>
            </div>
            <div class="miembro">
                <img src="{{ asset('imagenes/user_default.jpg') }}" alt="Redes Sociales">
                <h3>David Ruiz</h3>
                <p>Comunicación y Redes Sociales</p>
            </div>
        </div>
    </div>
@endsection
