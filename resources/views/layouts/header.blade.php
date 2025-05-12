<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <title></title>

</head>
<body>
<header class="main-header">
    <!-- Selector de idioma fuera del .container -->

    @php use Illuminate\Support\Str; @endphp
    <!-- Usuario también fuera del .container -->
    <div class="user-config-wrapper">
        <div class="user-configuration" id="userMenuToggle">
            <img src="{{ Auth::check() ? asset(Auth::user()->imagen_perfil) : asset('imagenes/user_face.png') }}" id="userImage" alt="">
            <div class="dropdown-menu" id="userDropdown" style="display: none;">
                <ul>
                    @if(auth()->check())
                        @php
                            $slug = Str::slug(auth()->user()->nombre . ' ' . auth()->user()->apellido);
                        @endphp
                        <li><a href="{{ route('usuario.perfil', ['slug' => $slug]) }}">Perfil</a></li>
                    @endif

                    <li><a href="{{ route('configuracion') }}">Configuración</a></li>

                    @auth
                        @if(Auth::user()->tipo === "artista")
                            <li><a href="{{ route('panel.artista') }}">Panel de Artista</a></li>
                        @endif

                        @if(Auth::user()->tipo === "administrador")
                            <li><a href="{{ route("panel-admin") }}">Panel de Administración</a></li>
                        @endif
                    @endauth

                    @if(Auth::check())
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="boton-cerrar-sesion">Cerrar Sesión</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('userMenuToggle');
            const dropdown = document.getElementById('userDropdown');

            toggle.addEventListener('click', function (e) {
                e.stopPropagation();
                dropdown.style.display = (dropdown.style.display === 'none' || dropdown.style.display === '') ? 'block' : 'none';
            });

            document.addEventListener('click', function () {
                dropdown.style.display = 'none';
            });
        });
    </script>


    <!-- Menú y logo centrado -->
    <nav class="container">
        <ul class="left-buttons">
            <li><a href="/">Inicio</a></li>
            <li><a href="{{ route("obra.colecciones") }}">Colecciones</a></li>
        </ul>
        <div class="logo">
            <a href="/">
                <img src="{{ asset('imagenes/galeria_virtual_logo.png') }}" alt="Galería Virtual">
                <h1>Galería Virtual</h1>
            </a>
        </div>
        <ul class="right-buttons">
            <li><a href="{{ route("artistas.index") }}">Artistas</a></li>
            <li><a href="{{ route("harvard") }}">Museo</a></li>
        </ul>
    </nav>
</header>
</body>
</html>
