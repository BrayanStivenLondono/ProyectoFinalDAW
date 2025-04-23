<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="shortcut icon" href="{{ asset('imagenes/logo-ico.ico') }}" type="image/x-icon">
    <title></title>
</head>
<body>
    <header class="main-header">
        <nav class="container">
            <ul class="left-buttons">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Colecciones</a></li>
            </ul>
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('imagenes/galeria_virtual_logo.png') }}" alt="Galería Virtual">
                </a>
            </div>
            <ul class="right-buttons">
                <li><a href="#">Mi Arte</a></li>
                <li><a href="#">Historia</a></li>
            </ul>

            <div class="language-switcher">
                <label for="language-select">Idioma:</label>
                <select id="language-select" onchange="cambiarIdioma(this.value)">
                    <option value="es" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>Español</option>
                    <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                    <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>Français</option>
                </select>
            </div>
        </nav>
    </header>
</body>
</html>
