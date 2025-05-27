@extends('layouts.app')

@section('title', 'Detalle del Reporte | Panel de Administración')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/ver_reporte.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route("panel-admin") }}">Administración</a> &gt;
    <a href="{{ route("reportes.index") }}">Reportes</a> &gt;
    <a href="{{ route("reportes.mostrar", $reporte) }}"> Reporte #{{ $reporte->id }}</a>
@endsection

@section('content')
    <div class="detalle-reporte-container">
        <h1>Detalle del Reporte #{{ $reporte->id }}</h1>
        <p><strong>Comentario:</strong> {{ $reporte->comentario->contenido ?? 'Comentario eliminado' }}</p>
        <p><strong>Usuario que reporta:</strong> {{ $reporte->usuario->nombre." ".$reporte->usuario->apellido ?? 'Usuario eliminado' }}</p>
        <p><strong>Razón:</strong> {{ $reporte->razon }}</p>
        <p><strong>Fecha del reporte:</strong> {{ $reporte->created_at->format('d/m/Y H:i') }}</p>

        <div class="acciones-reportes">
            <form action="{{ route('admin.reportes.aprobar', $reporte) }}" method="POST">
                @csrf
                <button type="submit" onclick="return confirm('¿Estás seguro de aprobar y eliminar el comentario?')">✅ Aprobar</button>
            </form>

            <form action="{{ route('admin.reportes.rechazar', $reporte) }}" method="POST">
                @csrf
                <button type="submit" onclick="return confirm('¿Estás seguro de rechazar este reporte?')">❌ Rechazar</button>
            </form>
        </div>

        <p class="volver-link"><a href="{{ route('reportes.index') }}">← Volver a la lista</a></p>
    </div>
    <br>
@endsection
