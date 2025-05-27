@extends('layouts.configuration')

@section('title', ' Darse de Baja | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/baja.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/configuracion_usuario.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route("configuracion") }}">Ajustes</a> &gt;
    <a href="{{ route("darseBaja") }}">Baja</a>
@endsection

@section('config-content')
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <p>¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.</p>
            <div class="modal-buttons">
                <button id="cancelBtn" class="btn-cancel">Cancelar</button>
                <button id="confirmBtn" class="btn-confirm">Eliminar cuenta</button>
            </div>
        </div>
    </div>
    <div class="form-contenedor">
        <div class="btn-wrapper">
            <form method="POST" action="{{ route('eliminarCuenta') }}" id="deleteForm">
                @csrf
                @method('DELETE')

                <button type="button" id="openModalBtn" class="btn-eliminar">Eliminar cuenta</button>

                <button type="submit" id="submitBtn" style="display:none;">Eliminar cuenta</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('confirmModal');
            const openModalBtn = document.getElementById('openModalBtn');
            const cancelBtn = document.getElementById('cancelBtn');
            const confirmBtn = document.getElementById('confirmBtn');
            const submitBtn = document.getElementById('submitBtn');

            openModalBtn.addEventListener('click', () => {
                modal.style.display = 'flex';
            });

            cancelBtn.addEventListener('click', () => {
                modal.style.display = 'none';
            });

            confirmBtn.addEventListener('click', () => {
                submitBtn.click();
            });

            window.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>

    <br>
@endsection

