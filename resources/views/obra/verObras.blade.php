@extends('layouts.app')

@section('title', 'Obras | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/vista_obras.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
@endsection

@section('breadcrumbs')
    @php use Illuminate\Support\Str; @endphp
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route('verObras') }}">Obras</a>
@endsection

@section('content')
    <div class="contenedor-obras">
        <h1 class="titulo">Obras</h1>
        <form method="GET" action="{{ route('verObras') }}" class="filtros-busqueda">
            <div class="filtro-busqueda-grupo">
                <input type="text" name="busqueda" placeholder="Buscar por título..." value="{{ request('busqueda') }}">

                <select name="tipo">
                    <option value="">-- Filtrar por tipo --</option>
                    @foreach ($tiposObra as $tipo)
                        <option value="{{ $tipo }}" {{ request('tipo') == $tipo ? 'selected' : '' }}>{{ ucfirst($tipo) }}</option>
                    @endforeach
                </select>

                <button type="submit">Filtrar</button>
                <a href="{{ route('verObras') }}" class="btn-reset">Restablecer</a>
            </div>
        </form>

        <div class="obras-grid">
            @forelse ($obras as $obra)
                <div class="obra-card">
                    <a href="{{ route('verObra', Str::slug($obra->titulo)) }}">
                        <div class="obra-img-container">
                            <img src="{{ asset($obra->imagen) }}" alt="{{ $obra->titulo }}">
                            <div class="obra-overlay">
                                <h3>{{ $obra->titulo }}</h3>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <p>No hay obras registradas aún.</p>
            @endforelse
        </div>
        <div class="paginacion">
            {{ $obras->appends(request()->query())->links('pagination::simple-bootstrap-5') }}
        </div>
    </div>
    <br>
@endsection
