@extends('layouts.app')

@section('title', 'Obras del Rijksmuseum')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/rijks_obras.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route("rijks.index") }}">Museo</a> &gt;
    <a href="{{ route("rijks.obras") }}">Obras</a>
@endsection

@section('content')
    <h1 class="titulo">Obras Destacadas</h1>
    <section class="rijks-obras-section">
        <div class="obras-grid">
            @forelse($obras as $obra)
                <div class="obra-card">
                    <div class="obra-img">
                        <img src="{{ $obra['webImage']['url'] ?? 'https://via.placeholder.com/300x280' }}" alt="{{ $obra['title'] }}">
                    </div>
                    <div class="obra-info">
                        <h3>{{ $obra['title'] }}</h3>
                        <p><strong>Artista:</strong> {{ $obra['principalOrFirstMaker'] }}</p>
                        <a href="{{ $obra['links']['web'] }}" target="_blank" class="btn-ver">Ver en Rijksmuseum</a>
                    </div>
                </div>
            @empty
                <p>No se encontraron obras.</p>
            @endforelse
        </div>
    </section>
    <div class="paginacion">
        {{ $obras->appends(request()->query())->links('pagination::simple-bootstrap-5') }}
    </div>
    <br>
@endsection
