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
    <div class="user-configuration">
        <img src="{{ asset('imagenes/user_face.png') }}">
    </div>

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
