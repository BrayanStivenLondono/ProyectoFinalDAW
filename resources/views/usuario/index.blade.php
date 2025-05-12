@extends('layouts.app')

@section('title', 'Usuarios index | Galeria Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/usuario_index.css') }}">
@endsection

@section('content')
    @php use Illuminate\Support\Str; @endphp
    <form action="{{ route("panel_usuarios") }}" method="GET" class="form-filtro">
        <input type="text" name="busqueda" value="{{ request('busqueda') }}" placeholder="Buscar usuario...">
        <button type="submit">Buscar</button>
    </form>
    <div class="usuarios-grid">
        @foreach ($usuarios as $usuario)
            <div class="usuario-card">
                <div class="usuario-info">
                    <img src="{{ asset($usuario->imagen_perfil) }}" alt="Imagen del usuario" class="usuario-imagen">
                    <h3>{{ $usuario->nombre_usuario }}</h3>
                    <p><strong>Nombre:</strong> {{ $usuario->nombre }} {{ $usuario->apellido }}</p>
                    <p><strong>Correo:</strong> {{ $usuario->correo }}</p>
                    <p><strong>Tipo:</strong> {{ ucfirst($usuario->tipo) }}</p>
                </div>
                <div class="acciones-admin-container">
                    <form action="{{ route('admin.eliminarUsuario', $usuario->id) }}" method="POST"
                          onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-eliminar">Eliminar</button>
                    </form>

                    @if(strtolower($usuario->tipo) !== 'administrador')
                        <form action="#" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-hacer-admin">Hacer Admin</button>
                        </form>
                    @endif
                    @php
                        $nombreCompleto = $usuario->nombre . ' ' . $usuario->apellido;
                        $slug = Str::slug($nombreCompleto);
                    @endphp

                    <a href="{{ $usuario->tipo === 'artista' ? route('artista.perfil', ['slug' => $slug]) : route('usuario.perfil.publico', ['slug' => $slug]) }}" class="btn-hacer-admin" style="text-decoration: none; background-color:#2d6fa5">Ver Perfil</a>

                </div>
            </div>
        @endforeach
    </div>
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
