<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .main-header {
            padding: 15px 0;
            background-color: rgba(255, 255, 255, 0.8);

        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 50px;

        }


        .left-buttons,
        .right-buttons {
            display: flex;
            gap: 20px;
            list-style: none;
            padding: 0;
            margin: 0;
        }


        .left-buttons a,
        .right-buttons a {
            font-family: "Outfit", sans-serif;
            font-optical-sizing: auto;
            font-weight: 200;
            font-style: normal;
            font-size: 1.2em;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            color: #222;
            position: relative;
        }

        .left-buttons a::after,
        .right-buttons a::after {
            content: "";
            position: absolute;
            bottom: 5px;
            width: 0;
            height: 2px;
            background-color: #222;
            transition: width 0.3s ease-in-out, left 0.3s ease-in-out;
        }

        .left-buttons a:hover::after,
        .right-buttons a:hover::after {
            width: calc(100% - 20px);
            left: 10px;
        }


        .logo img {
            height: 80px;
            max-height: 100%;
            border-radius: 50%;
        }



        .language-switcher {
            font-family: "Outfit", sans-serif;
            font-optical-sizing: auto;
            font-weight: lighter;
            position: absolute;
            top: 10px; /* Ajusta la distancia desde la parte superior */
            right: 20px; /* Ajusta la distancia desde la derecha */
            display: flex;
            align-items: center;
            gap: 5px; /* Espacio entre la etiqueta y el selector */
        }

        .language-switcher label {
            font-size: 0.9em;
            color: #222; /* Color del texto de la etiqueta */
        }

        .language-switcher select {
            font-family: "Outfit", sans-serif;
            font-optical-sizing: auto;
            font-weight: lighter;
            padding: 5px 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 0.9em;
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="currentColor" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg>'); /* Flecha desplegable */
            background-repeat: no-repeat;
            background-position: right 5px top 50%;
            background-size: 12px;
            cursor: pointer;
        }

    </style>
</head>
<body>
    <header class="main-header">
        <nav class="container">
            <ul class="left-buttons">
                <li><a href="/">Inicio</a></li>
                <li><a href=" {{ route("obra.colecciones") }} ">Colecciones</a></li>
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
