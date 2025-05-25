@extends('layouts.app')

@section('title', 'Usuarios | Administración')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/usuario_index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route("panel-admin") }}">Administración</a> &gt;
    <a href="{{ route("panel_usuarios") }}">Usuarios</a>
@endsection


@section('content')
    <h1 class="titulo">Lista De Usuario</h1>
    <form action="{{ route('panel_usuarios') }}" method="GET" class="form-filtro">
        <input type="text" name="busqueda" value="{{ request('busqueda') }}" placeholder="Buscar usuario...">

        <select name="tipo">
            <option value="">Todos</option>
            <option value="artista" {{ request('tipo') == 'artista' ? 'selected' : '' }}>Artista</option>
            <option value="visitante" {{ request('tipo') == 'visitante' ? 'selected' : '' }}>Visitante</option>
        </select>

        <button type="submit">Buscar</button>
    </form>

    <table class="usuarios-table">
        <thead>
        <tr>
            <th>Imagen</th>
            <th>Nombre Usuario</th>
            <th>Nombre Completo</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($usuarios as $usuario)
            @if ($usuario->id !== auth()->id())
                @php
                    $nombreCompleto = $usuario->nombre . ' ' . $usuario->apellido;
                    $slug = Str::slug($nombreCompleto);
                @endphp
                <tr>
                    <td><img src="{{ asset($usuario->imagen_perfil) }}" alt="Imagen de {{ $usuario->nombre_usuario }}" class="usuario-imagen"></td>
                    <td>{{ $usuario->nombre_usuario }}</td>
                    <td>{{ $nombreCompleto }}</td>
                    <td>{{ $usuario->correo }}</td>
                    <td>{{ ucfirst($usuario->tipo) }}</td>
                    <td class="acciones-admin-container">
                        <form action="{{ route('admin.eliminarUsuario', $usuario->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-eliminar">Eliminar</button>
                        </form>

                        @if(strtolower($usuario->tipo) !== 'administrador')
                            <form action="#" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn-hacer-admin">Hacer Admin</button>
                            </form>
                        @endif

                        <a href="{{ $usuario->tipo === 'artista' ? route('artista.perfil', ['slug' => $slug]) : route('usuario.perfil.publico', ['slug' => $slug]) }}" class="btn-ver-perfil">Ver Perfil</a>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    <br>
@endsection
@section('scripts')
    <script>
        function confirmarYRecargar() {
            if (confirm('¿Estás seguro de que deseas repoblar la base de datos?')) {
                setTimeout(() => {
                    location.reload();
                }, 2000);
                return true;
            }
            return false;
        }
    </script>
@endsection
