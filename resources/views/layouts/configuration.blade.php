@extends('layouts.app')

@section('title', 'Configuracion | Galería Virtual')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/configuracion_usuario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/titulo_botones.css') }}">
@endsection

@section('breadcrumbs')
    <a href="{{ url('/') }}">Inicio</a> &gt;
    <a href="{{ route('configuracion') }}">Ajustes</a>
@endsection

@section('content')
    <h1 class="titulo">Ajustes</h1>
    @hasSection('config-content')
        {{-- Mostrar panel completo con menú lateral y contenido --}}
        <div class="configuracion-layout">
            <aside class="configuracion-opciones">
                <ul>
                    @php
                        $slug = Str::slug(auth()->user()->nombre . ' ' . auth()->user()->apellido);
                    @endphp
                    <li>
                        <a href="{{ route('usuario.perfil', ['slug' => $slug]) }}"
                           class="{{ request()->routeIs('usuario.perfil') ? 'active' : '' }}">
                            Perfil
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('favoritos.ver')}}"
                           class="{{ request()->routeIs('favoritos.ver') ? 'active' : '' }}">
                            Favoritos
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('formContrasena') }}"
                           class="{{ request()->routeIs('formContrasena') ? 'active' : '' }}">
                            Actualizar Contraseña
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('darseBaja') }}"
                           class="{{ request()->routeIs('darseBaja') ? 'active' : '' }}">
                            Darse de Baja
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="btn btn-danger">
                            Cerrar Sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </aside>

            <section class="configuracion-contenido">
                @yield('config-content')
            </section>
        </div>
        <br>
    @else
        {{-- Mostrar solo las opciones si no se ha cargado contenido --}}
        <div class="configuracion-centro">
            <div class="configuracion-opciones">
                <ul>
                    @php
                        $slug = Str::slug(auth()->user()->nombre . ' ' . auth()->user()->apellido);
                    @endphp
                    <li><a href="{{ route('usuario.perfil', ['slug' => $slug]) }}">Perfil</a></li>
                    <li><a href="{{ route('favoritos.ver') }}">Favoritos</a></li>
                    <li><a href="{{ route("formContrasena") }}">Actualizar Contraseña</a></li>
                    <li><a href="{{ route("darseBaja") }}">Darse de Baja</a></li>

                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="cerrar-sesion">
                            Cerrar Sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    @endif
    <br><br><br>
@endsection
