@extends('layouts.app')

@section('title', $obra->titulo . ' | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/obra.css') }}">
    <link rel="stylesheet" href="{{ asset('css/comentario.css') }}">
@endsection

@section('breadcrumbs')
    @php use Illuminate\Support\Str; @endphp
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route('verObras') }}">Obras</a>  &gt;
    <a href="{{ url('/obra/' . Str::slug($obra->titulo)) }}">{{ ucfirst($obra->titulo) }}</a>
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
            <p><strong>Estilo:</strong> <span class="wiki-termino" data-termino="{{ $obra->estilo }}">{{ $obra->estilo }}</span></p>
            <p><strong>Técnica:</strong> <span class="wiki-termino" data-termino="{{ $obra->tecnica }}">{{ $obra->tecnica }}</span></p>

            <a href="{{ route("obra.verColeccion", Str::slug($obra->tipo)) }}">
                <p><strong>Coleccion:</strong> {{ $obra->tipo }}</p>
            </a>
            <p><strong>Año de Creación:</strong> {{ $obra->año_creacion }}</p>
            <p><strong>Descripción:</strong> {{ $obra->descripcion }}</p>

            @auth
                <div class="acciones">
                    <form action="{{ route('obras.like', $obra->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-like">
                            @if(auth()->user()->likes->contains($obra->id))
                                💔 No me gusta
                            @else
                                ❤ Me gusta
                            @endif
                        </button>
                    </form>

                    {{-- Compartir --}}
                    <button type="button" id="boton-compartir" class="btn-compartir">🔗 Compartir</button>
                    <span id="mensaje-copiado" style="display:none; color: green; margin-left: 10px;">¡Enlace copiado!</span>

                    {{-- Favorito --}}
                    @if(auth()->user()->favoritos->contains($obra->id))
                        <form action="{{ route('favorito.eliminar', $obra->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-favorito eliminar">💔 Quitar de Favoritos</button>
                        </form>
                    @else
                        <form action="{{ route('favorito.agregar', $obra->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-favorito">➕ Agregar a Favoritos</button>
                        </form>
                    @endif

                    {{-- Seguir / Dejar de seguir --}}
                    @if(auth()->user()->id !== $obra->artista->id)
                        @if(auth()->user()->siguiendo->contains($obra->artista->id))
                            <form method="POST" action="{{ route('dejar.seguir.usuario', $obra->artista->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-seguir">🚫 Dejar de seguir</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('seguir.usuario', $obra->artista->id) }}">
                                @csrf
                                <button type="submit" class="btn-seguir">👤➕ Seguir Artista</button>
                            </form>
                        @endif
                    @endif
                </div>
            @else
                <p>Para dar like o comentar esta obra, debes <a style="color: #0056b3" href="{{ route('login') }}">iniciar sesión</a>.</p>
            @endauth

            @if ($obrasMismoTipo->count())
                <h4>Otras obras:</h4>
                <div class="lista-obras-similares">
                    @foreach ($obrasMismoTipo as $obraSim)
                        <div class="obra-similar">
                            <a href="{{ route('verObra', Str::slug($obraSim->titulo)) }}">
                               <p>{{ $obraSim->titulo }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="comentarios-lista">
        <h3>Deja tu comentario:</h3>
        @auth
            <div class="comentario">
                <form action="{{ route('crearComentario') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_obra" value="{{ $obra->id }}">
                    <input type="hidden" name="id_comentario_respuesta" value="">
                    <textarea name="contenido" rows="4" placeholder="Escribe tu comentario aquí..." required></textarea>
                    <button type="submit">Comentar</button>
                </form>
            </div>
        @else
            <p>Debes <a style="color: #0056b3" href="{{ route('login') }}">iniciar sesión</a> para comentar.</p>
        @endauth
    </div>

    <div id="wiki-definicion" class="modal" style="display:none;">
        <div class="modal-content">
            <span id="closeModal" style="cursor:pointer;">&times;</span>
            <h2 id="wikiTitle"></h2>
            <p id="wikiExtract"></p>
            <a href="#" id="wikiLink" target="_blank">Leer más en Wikipedia</a>
        </div>
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
                        </a>:
                    </strong> {{ $comentario->contenido }}</p>
                <p><small>Publicado el {{ $comentario->fecha_comentario }}</small></p>

                @auth
                    <div class="comentario-acciones">
                        <form action="{{ route('crearComentario') }}" method="POST" class="form-respuesta">
                            @csrf
                            <input type="hidden" name="id_obra" value="{{ $obra->id }}">
                            <input type="hidden" name="id_comentario_respuesta" value="{{ $comentario->id }}">
                            <textarea name="contenido" rows="2" placeholder="Escribe tu respuesta..." class="campo-texto" required></textarea>
                            <div class="botones-comentario">
                                <button type="submit" class="btn btn-success">Responder</button>
                                <button type="button" class="btn btn-outline-danger btn-toggle-reporte" style="background-color: darkred;">Reportar</button>
                            </div>
                        </form>

                        <form action="{{ route('comentarios.reportar', $comentario->id) }}" method="POST" class="form-reportar mt-2" style="display: none;">
                            @csrf
                            <textarea name="razon" rows="2" placeholder="Motivo del reporte (opcional)" class="form-control mb-2" style="max-width: 400px;"></textarea>
                            <button type="submit" class="btn btn-danger" style="background-color: darkred">Enviar reporte</button>
                        </form>
                    </div>
                @endauth


                <div class="respuestas">
                    @foreach ($comentario->respuestas as $respuesta)
                        <div class="respuesta">
                            <p><strong>
                                    <a style="text-decoration: none; color: black;" href="{{ $respuesta->usuario->tipo === 'artista' ? route('artista.perfil', ['slug' => Str::slug($respuesta->usuario->nombre." ".$respuesta->usuario->apellido)]) : route('usuario.perfil.publico', ['slug' => Str::slug($respuesta->usuario->nombre." ".$respuesta->usuario->apellido)]) }}">
                                        {{ $respuesta->usuario->nombre." ".$respuesta->usuario->apellido}}
                                        @if ($respuesta->usuario->tipo === 'artista')
                                            <span class="artista-icono" title="Artista">&#127912;</span>
                                        @endif
                                    </a>:
                                </strong>{{$respuesta->contenido }}</p>
                            <p><small>Publicado el {{ $respuesta->fecha_comentario }}</small></p>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <p>No hay comentarios para esta obra. ¡Sé el primero en comentar!</p>
        @endforelse
    </div>
    <script>

        document.addEventListener('DOMContentLoaded', () => {
            const botones = document.querySelectorAll('.btn-toggle-reporte');
            botones.forEach(boton => {
                boton.addEventListener('click', () => {
                    const form = boton.closest('.comentario-acciones').querySelector('.form-reportar');
                    if (form) {
                        form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
                    }
                });
            });
        });


        document.addEventListener('DOMContentLoaded', () => {
            const botonCompartir = document.getElementById('boton-compartir');
            const mensajeCopiado = document.getElementById('mensaje-copiado');

            botonCompartir.addEventListener('click', async () => {
                try {
                    // Copiar la URL actual
                    await navigator.clipboard.writeText(window.location.href);

                    // Mostrar mensaje de éxito
                    mensajeCopiado.style.display = 'inline';

                    // Ocultar después de 2.5 segundos
                    setTimeout(() => {
                        mensajeCopiado.style.display = 'none';
                    }, 2500);
                } catch (err) {
                    alert('No se pudo copiar el enlace.');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const wikiTerminos = document.querySelectorAll('.wiki-termino');
            const modal = document.getElementById('wiki-definicion');
            const closeModal = document.getElementById('closeModal');
            const wikiTitle = document.getElementById('wikiTitle');
            const wikiExtract = document.getElementById('wikiExtract');
            const wikiLink = document.getElementById('wikiLink');

            wikiTerminos.forEach(term => {
                term.style.cursor = 'pointer';

                term.addEventListener('click', async () => {
                    const termino = term.getAttribute('data-termino');

                    try {
                        const res = await fetch(`/wiki/resumen?termino=${encodeURIComponent(termino)}`);
                        if (!res.ok) throw new Error('Error en la respuesta');

                        const data = await res.json();

                        wikiTitle.textContent = data.titulo || termino;
                        wikiExtract.textContent = data.extracto || 'No hay resumen disponible.';
                        wikiLink.href = data.url || '#';

                        modal.style.display = 'block';
                    } catch (error) {
                        wikiTitle.textContent = 'Error';
                        wikiExtract.textContent = 'No se pudo cargar la información.';
                        wikiLink.href = '#';
                        modal.style.display = 'block';
                    }
                });
            });

            closeModal.addEventListener('click', () => {
                modal.style.display = 'none';
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
