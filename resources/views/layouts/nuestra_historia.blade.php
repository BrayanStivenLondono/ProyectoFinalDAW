@extends('layouts.app')

@section('title', 'Nuestra Historia | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/nuestra_historia.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route('nuestraHistoria') }}">Nuestra Historia</a>
@endsection

@section('content')
    <div class="historia-container">
        <h1 class="titulo">Nuestra Historia</h1>

        <p>
            Nuestra galería virtual nació del deseo de acercar el arte a todas las personas sin importar su ubicación.
            Comenzamos en 2020 como un pequeño proyecto entre artistas y desarrolladores apasionados por el arte digital.
        </p>

        <p>
            A lo largo de los años, hemos colaborado con museos, artistas independientes y comunidades culturales para construir
            un espacio accesible y diverso donde se expongan obras de todas partes del mundo.
        </p>

        <p>
            Nuestra misión es seguir promoviendo el arte como una herramienta de transformación social y cultural.
            Creemos en el poder de la creatividad para conectar personas y enriquecer nuestras vidas.
        </p>

        <p>
            Gracias a todos los que han apoyado este proyecto. ¡Lo mejor aún está por venir!
        </p>
    </div>
    <br>
@endsection
