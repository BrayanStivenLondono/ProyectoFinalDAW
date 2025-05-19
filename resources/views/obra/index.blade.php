@extends('layouts.app')

@section('title', 'Obras | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/usuario_index.css') }}">
@endsection

@section('content')
    @php use Illuminate\Support\Str; @endphp
    <form action="{{ route('panel_obras') }}" method="GET" class="form-filtro">
        <input type="text" name="busqueda" value="{{ request('busqueda') }}" placeholder="Buscar obra, autor, estilo...">
        <button type="submit">Buscar</button>
    </form>

    <div class="usuarios-grid">
        @forelse ($obras as $obra)
            <div class="usuario-card">
                <div class="usuario-info">
                    <img src="{{ asset($obra->imagen) }}" alt="Imagen de la obra" class="usuario-imagen">
                    <h3>{{ $obra->titulo }}</h3>
                    <p><strong>Autor:</strong>
                        <a href="{{ route('verObra', Str::slug($obra->titulo)) }}">
                            {{ $obra->artista->nombre }} {{ $obra->artista->apellido }}
                        </a>
                    </p>
                    <p><strong>Año:</strong> {{ $obra->año_creacion }}</p>
                    <p><strong>Estilo:</strong> {{ $obra->estilo }}</p>
                </div>
                <div class="acciones-admin-container">
                    <a href="{{ route('verObra', Str::slug($obra->titulo)) }}" class="btn-hacer-admin" style="background-color: #2d6fa5;">Ver Detalles</a>
                    <div class="acciones-admin-container">
                        <form action="{{ route('admin.eliminarObra', $obra->id) }}" method="POST"
                              onsubmit="return confirm('¿Estás seguro de eliminar esta receta?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-eliminar">Eliminar Obra</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p style="text-align: center; font-weight: bold;">No se encontraron obras.</p>
        @endforelse
    </div>
@endsection
