<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <title></title>
</head>
<body>
<header class="main-header">
    @php use Illuminate\Support\Str; @endphp
    <div class="user-config-wrapper">
        <div class="user-configuration" id="userMenuToggle">
            @if(Auth::check())
                <img src="{{ asset(Auth::user()->imagen_perfil) }}" id="userImage" alt="">
            @else
                <div class="login-register-text">
                    <a class="login" href="{{ route('login.form') }}">Iniciar Sesión</a>
                    <span class="separador">|</span>
                    <a class="registro" href="{{ route('registro.form') }}">Registro</a>
                </div>
            @endif
            @if(Auth::check())
                <div class="dropdown-menu" id="userDropdown" style="display: none;">
                    <ul>

                        @if(Auth::user()->tipo === "visitante")
                            <li><a href="{{ route('favoritos.ver') }}">Favoritos </a></li>
                        @endif
                        <li><a href="{{ route('configuracion') }}">Ajustes</a></li>

                        @if(Auth::user()->tipo === "artista")
                            <li><a href="{{ route('panel.artista') }}">Panel de Artista</a></li>
                        @endif

                        @if(Auth::user()->tipo === "administrador")
                            <li><a href="{{ route("panel-admin") }}">Panel de Administración</a></li>
                        @endif

                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="boton-cerrar-sesion">Cerrar Sesión</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endif
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

    <div class="menu-toggle" id="menuToggle" aria-label="Toggle menu" aria-expanded="false" role="button" tabindex="0">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <nav class="container">
        <ul class="left-buttons">
            <li><a href="{{ url("/") }}">Inicio</a></li>
            <li><a href="{{ route("verObras") }}">Obras</a></li>
        </ul>

        <div class="logo">
            <a href="/">
                <img src="{{ asset('imagenes/galeria_virtual_logo.png') }}" alt="Galería Virtual">
                <h1 class="nombre-pagina">Galería Virtual</h1>
            </a>
        </div>

        <ul class="right-buttons">
            <li><a href="{{ route("obra.colecciones") }}">Colecciones</a></li>
            <li><a href="{{ route("artistas.index") }}">Artistas</a></li>
        </ul>

        <ul class="mobile-buttons">
            <li><a href="{{ url('/') }}">Inicio</a></li>
            <li><a href="{{ route('verObras') }}">Obras</a></li>
            <li><a href="{{ route('obra.colecciones') }}">Colecciones</a></li>
            <li><a href="{{ route('artistas.index') }}">Artistas</a></li>
        </ul>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.querySelector('.mobile-buttons');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
        });

        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('open');
            });
        });
    });

</script>
</body>
</html>
