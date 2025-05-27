@extends('layouts.app')

@section('title', ucfirst($tipo) . ' | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/coleccion.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route('obra.colecciones') }}">Colecciones</a> &gt;
    <a href="{{ route('obra.verColeccion', $tipo) }}">{{ Str::ucfirst($tipo) }}</a>
@endsection

@section('content')
    <h1 class="titulo"> {{ ucfirst($tipo) }}</h1>

    <div class="contenedor">
        <div class="listado-obras">
            @php use Illuminate\Support\Str; @endphp
            @forelse ($obrasPorTipo as $obra)
                <div class="obra-item">
                    <a href="{{ route('verObra' , Str::slug($obra->titulo)) }}">
                        <img src="{{ asset($obra->imagen) }}" class="imagen-obra" alt="{{ $obra->titulo }}">
                        <div class="info-obra">
                            <h5 class="titulo-obra">{{ $obra->titulo }}</h5>
                            <p class="autor-obra">Artista: {{ $obra->artista->nombre }}</p>
                        </div>
                    </a>
                </div>
            @empty
                <p class="mensaje-sin-obras">No hay obras disponibles del tipo {{ ucfirst($tipo) }}.</p>
            @endforelse
        </div>

        @if ($obrasPorTipo instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="paginacion">
                {{ $obrasPorTipo->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
@endsection
