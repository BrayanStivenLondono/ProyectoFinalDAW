@extends('layouts.app')

@section('title', 'Nuestra Historia | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/contacto.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route('contacto') }}">Nuestra Historia</a>
@endsection

@section('content')
    <div class="contacto-container">
        <h1 class="titulo">Contáctanos</h1>

        <p>¿Tienes dudas, sugerencias o simplemente quieres saludarnos? ¡Nos encantará saber de ti!</p>

        <form action="#" class="form-contacto">
            @csrf
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required>

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="mensaje" rows="5" required></textarea>

            <button class="btn-enviar">Enviar mensaje</button>
        </form>

        <div class="info-contacto">
            <p><strong>Email:</strong> contacto@galeriavirtual.com</p>
            <p><strong>Teléfono:</strong> +34 600 123 456</p>
            <p><strong>Dirección:</strong> Calle del Arte, 123, Madrid, España</p>
        </div>
    </div>
    <br>
@endsection
