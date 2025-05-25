@extends('layouts.app')

@section('title', 'Obras | Administración')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/obra_index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route("panel-admin") }}">Administración</a> &gt;
    <a href="{{ route("panel_obras") }}">Obras</a>
@endsection

@section('content')
    <h1 class="titulo">Lista de Obras</h1>
    @php use Illuminate\Support\Str; @endphp
    <form action="{{ route('panel_obras') }}" method="GET" class="form-filtro">
        <input type="text" name="busqueda" value="{{ request('busqueda') }}" placeholder="Buscar obra o autor...">
        <button type="submit">Buscar</button>
    </form>

    <div class="usuarios-grid">
        @forelse ($obras as $obra)
            <div class="usuario-card">
                <img src="{{ asset($obra->imagen) }}" alt="Imagen de la obra" class="usuario-imagen">

                <div class="usuario-info">
                    <h3>{{ $obra->titulo }}</h3>
                    <p><strong>Autor:</strong>
                        <a href="{{ route('verObra', Str::slug($obra->titulo)) }}">
                            {{ $obra->artista->nombre }} {{ $obra->artista->apellido }}
                        </a>
                    </p>
                    <p><strong>Año:</strong> {{ $obra->año_creacion }}</p>
                    <a href="{{ route("obra.verColeccion", Str::slug($obra->tipo)) }}">
                        <p><strong>Coleccion:</strong> {{ $obra->tipo }}</p>
                    </a>
                </div>

                <div class="acciones-admin-container">
                    <a href="{{ route('verObra', Str::slug($obra->titulo)) }}" class="acciones">Ver Detalles</a>
                    <form action="{{ route('admin.eliminarObra', $obra->id) }}" method="POST"
                          onsubmit="return confirm('¿Estás seguro de eliminar esta obra?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-eliminar">Eliminar Obra</button>
                    </form>
                </div>
            </div>
        @empty
            <p style="text-align: center; font-weight: bold;">No se encontraron obras.</p>
        @endforelse
            <div class="paginacion">
                {{ $obras->appends(request()->query())->links('pagination::simple-bootstrap-5') }}
            </div>
    </div>
    <br><br>
@endsection
