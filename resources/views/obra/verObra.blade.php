@extends('layouts.app')

@section('title', $obra->titulo.' | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/obra.css') }}">

@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route('obra.colecciones') }}">Colecciones</a> &gt;
    <a href="{{ route('obra.verColeccion', $obra->tipo) }}">{{ $obra->tipo }}</a>  &gt;
    <a href="{{ route('obra.ver',['slug' => $obra->titulo]) }}">{{ $obra->titulo }}</a>
@endsection

@section('content')
    <div class="obra-detalle">
        <div class="obra-imagen">
            <img src="{{ asset($obra->imagen) }}" alt="Imagen de {{ $obra->titulo }}">
        </div>
        <div class="obra-info">
            <h1>{{ str_replace(".","",$obra->titulo) }}</h1>
            <p><strong>Autor:</strong> <a href="#"></a></p>
            <p><strong>Estilo:</strong> {{ $obra->estilo }}</p>
            <p><strong>Técnica:</strong> {{ $obra->tecnica }}</p>
            <p><strong>Año de Creación:</strong> {{ $obra->año_creacion }}</p>
            <p><strong>Descripción:</strong> {{ $obra->descripcion }}</p>
        </div>
    </div>
@endsection
