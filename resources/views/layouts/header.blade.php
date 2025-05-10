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
    <div class="language-switcher">
        <div class="language-select-wrapper">
            <label for="language-select">Idioma:</label>
            <select id="language-select" onchange="cambiarIdioma(this.value)">
                <option value="es" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>Español</option>
                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>Français</option>
            </select>
        </div>
    </div>

    <!-- Usuario también fuera del .container -->
    <div class="user-configuration" id="userMenuToggle">
        <img src="{{ Auth::check() ? asset(Auth::user()->imagen_perfil) : asset('imagenes/user_face.png') }}" id="userImage" alt="">
        <div class="dropdown-menu" id="userDropdown" style="display: none;">
            <ul>
                <li><a href="{{ route("perfil") }}">Perfil</a></li>
                <li><a href="{{ route("configuracion") }}">Configuración</a></li>
                @if(Auth::check())
                    <form action="{{ route('logout') }}" method="POST" style="text-decoration: none">
                        @csrf
                        <button type="submit" class="boton-cerrar-sesion">Cerrar Sesión</button>
                    </form>
                @else
                    <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                @endif
            </ul>
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
            <li><a href="#">Mi Arte</a></li>
            <li><a href="#">Historia</a></li>
        </ul>
    </nav>
</header>
</body>
</html>
