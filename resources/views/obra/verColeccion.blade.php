@extends('layouts.app')

@section('title', ucfirst($tipo) . ' | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/coleccion.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route('obra.colecciones') }}">Colecciones</a> &gt;
    <a href="{{ route('obra.verColeccion', $tipo) }}">{{ $tipo }}</a>
@endsection

@section('content')
    <!-- Filtros fuera del contenedor principal -->
    <div class="zona-filtros">
        <form method="GET" action="{{ route('obras.coleccion', $tipo) }}">
            <input type="text" name="titulo" placeholder="Buscar por título..." value="{{ request('titulo') }}">
            <select name="orden">
                <option value="">Ordenar por</option>
                <option value="titulo_asc" {{ request('orden') == 'titulo_asc' ? 'selected' : '' }}>Título A-Z</option>
                <option value="titulo_desc" {{ request('orden') == 'titulo_desc' ? 'selected' : '' }}>Título Z-A</option>
            </select>
            <button type="submit">Filtrar</button>
        </form>
    </div>

    <div class="contenedor">
        <h1> {{ ucfirst($tipo) }}</h1>

        <div class="listado-obras">
            @php use Illuminate\Support\Str; @endphp
            @forelse ($obrasPorTipo as $obra)
                <div class="obra-item">
                    <a href="{{ url('/obra/' . Str::slug($obra->titulo)) }}">
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
