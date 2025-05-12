@extends('layouts.app')

@section('title', $obra->titulo . ' | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/obra.css') }}">
@endsection

@section('breadcrumbs')
    @php use Illuminate\Support\Str; @endphp
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route('obra.colecciones') }}">Colecciones</a> &gt;
    <a href="{{ route('obra.verColeccion', $obra->tipo) }}">{{ $obra->tipo }}</a>  &gt;
    <a href="{{ url('/obra/' . Str::slug($obra->titulo)) }}">{{ $obra->titulo }}</a>
@endsection

@section('content')
    <div class="obra-detalle">
        <div class="obra-imagen">
            <img src="{{ asset($obra->imagen) }}" alt="Imagen de {{ $obra->titulo }}">
        </div>
        <div class="obra-info">
            <h1>{{ str_replace(".", "", $obra->titulo) }}</h1>
            <p><strong>Autor:</strong>
                <a href="{{ route('artista.perfil', ['slug' => Str::slug($obra->artista->nombre . ' ' . $obra->artista->apellido)]) }}">
                    {{ $obra->artista->nombre }} {{ $obra->artista->apellido }}
                </a>
            </p>
            <p><strong>Estilo:</strong> {{ $obra->estilo }}</p>
            <p><strong>Técnica:</strong> {{ $obra->tecnica }}</p>
            <p><strong>Año de Creación:</strong> {{ $obra->año_creacion }}</p>
            <p><strong>Descripción:</strong> {{ $obra->descripcion }}</p>

            @auth
                <div class="acciones">
                    <form action="{{ route('obras.like', $obra->id) }}" method="POST">
                        @csrf
                        <button type="submit">
                            @if(auth()->user()->likes->contains('obra_id', $obra->id))
                                💔 Quitar like
                            @else
                                ❤️ Dar like
                            @endif
                        </button>
                    </form>
                    <button onclick="copiarEnlace()" class="boton-accion">🔗 Compartir obra</button>
                </div>
                <p>{{ $obra->usuarioDaLike()->count() }} likes</p>
            @else
                <p>Para dar like o comentar esta obra, debes <a style="color: #0056b3" href="{{ route('login') }}">iniciar sesión</a>.</p>
            @endauth
        </div>
    </div>

    <div class="comentarios-lista">
        <h3>Deja tu comentario:</h3>
        @auth
            <div class="comentario">
                <form action="{{ route('crearComentario') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_obra" value="{{ $obra->id }}">
                    <textarea name="contenido" rows="4" placeholder="Escribe tu comentario aquí..." required></textarea>
                    <button type="submit">Comentar</button>
                </form>
            </div>
        @else
            <p>Debes <a href="{{ route('login') }}">iniciar sesión</a> para comentar.</p>
        @endauth
    </div>

    <div class="comentarios-lista">
        <h3>Comentarios:</h3>
        @forelse ($obra->comentarios->whereNull('id_comentario_respuesta') as $comentario)
            <div class="comentario">
                @php
                    $usuario = $comentario->usuario;
                    $nombreCompleto = $usuario->nombre . ' ' . $usuario->apellido;
                    $slug = Str::slug($nombreCompleto);
                @endphp
                <p><strong>
                        <a href="{{ $usuario->tipo === 'artista' ? route('artista.perfil', ['slug' => $slug]) : route('usuario.perfil.publico', ['slug' => $slug]) }}"
                           style="color: black; text-decoration: none;">
                            {{ $nombreCompleto }}
                            @if ($usuario->tipo === 'artista')
                                <span class="artista-icono" title="Artista">&#127912;</span>
                            @endif
                        </a>
                    </strong> {{ $comentario->contenido }}</p>
                <p><small>Publicado el {{ $comentario->fecha_comentario }}</small></p>

                @auth
                    <form action="#" method="POST">
                        @csrf
                        <input type="hidden" name="id_comentario" value="{{ $obra->id }}">
                        <input type="hidden" name="id_comentario_respuesta" value="{{ $comentario->id }}">
                        <textarea name="contenido" rows="2" placeholder="Escribe tu respuesta..." required></textarea>
                        <button type="submit">Responder</button>
                        <button style="background-color: darkred">Reportar</button>
                    </form>
                @else
                    <p>Debes <a href="{{ route('login') }}">iniciar sesión</a> para responder.</p>
                @endauth

                <div class="respuestas">
                    @foreach ($comentario->respuestas as $respuesta)
                        <div class="respuesta">
                            <p><strong>
                                    <a href="#">
                                        {{ $respuesta->usuario->nombre_usuario }}
                                    </a>:
                                </strong> {{ $respuesta->contenido }}</p>
                            <p><small>Publicado el {{ $respuesta->fecha_creacion }}</small></p>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <p>No hay comentarios para esta obra. ¡Sé el primero en comentar!</p>
        @endforelse
    </div>
@endsection

{{-- ✅ Script separado y visible en layout --}}
@push('scripts')
    <script>
        function copiarEnlace() {
            navigator.clipboard.writeText(window.location.href)
                .then(() => alert("¡Enlace copiado al portapapeles!"))
                .catch(() => alert("Error al copiar el enlace."));
        }
    </script>
@endpush
