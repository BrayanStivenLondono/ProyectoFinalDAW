<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset("css/index.css") }}">
    <link rel="stylesheet" href="{{ asset("css/slider.css") }}">
    @vite(['resources/js/app.js'])
    <title>Inicio | Galeria Virtual</title>
</head>
<body>
    @include("layouts.header")

    <div class="fondo">
    <!-- CARRUSEL DE IMAGENES -->
        <br>
        <div class="carrusel">
            <div class="slides">
                @foreach($obras as $obra)
                    <div class="slide">
                        <img src="{{ asset($obra->imagen) }}" alt="{{$obra->titulo}}">
                        <h3>{{ $obra->titulo }}</h3>
                    </div>
                @endforeach
            </div>
        </div>
        <button class="prev">&#10094;</button>
        <button class="next">&#10095;</button>

        Esto es el index
    </div>

    @include("layouts.footer")
</body>
</html>
