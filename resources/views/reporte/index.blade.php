@extends('layouts.app')

@section('title', 'Reportes de Comentarios | Panel de Administración')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/reporte.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route("panel-admin") }}">Administración</a> &gt;
    <a href="{{ route("reportes.index") }}">Reportes</a>
@endsection

@section('content')
    <h1 class="titulo">Reportes de Comentarios</h1>

    <div class="reportes-container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($reportes->count() > 0)
            <table class="tabla-reportes">
                <thead>
                <tr>
                    <th>ID</th>
                    <th class="contenido">Comentario</th>
                    <th>Usuario que reporta</th>
                    <th>Razón</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reportes as $reporte)
                    <tr class="reporte-card">
                        <td data-label="ID">{{ $reporte->id }}</td>
                        <td data-label="Comentario">{{ Str::limit($reporte->comentario->contenido ?? 'Comentario eliminado', 50) }}</td>
                        <td data-label="Usuario que reporta">
                            <a href="{{ $reporte->usuario->perfilUrl() }}">
                                {{ $reporte->usuario->nombre." ".$reporte->usuario->apellido ?? 'Usuario eliminado' }}
                            </a>
                        </td>
                        <td data-label="Razón">{{ $reporte->razon }}</td>
                        <td data-label="Fecha">{{ $reporte->created_at->format('d/m/Y H:i') }}</td>
                        <td data-label="Acciones" class="acciones">
                            <a href="{{ route('reportes.mostrar', $reporte) }}" class="boton-ver">Ver detalle</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No hay reportes pendientes.</p>
        @endif
    </div>
    <br>
@endsection
