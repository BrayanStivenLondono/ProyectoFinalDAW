<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('imagenes/logo-ico.ico') }}" type="image/x-icon">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/breadcrumbs.css') }}">
    <!--Fuente -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@100..900&display=swap');
        body {
            height: 100%;
            box-sizing: border-box;
            background-image: url('{{ asset('imagenes/black_space.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            margin: 0;
            min-height: 100vh;
        }
        .fondo {
            margin: 30px;
            height: calc(100% - 90px);
            width: calc(100% - 60px);
            border-radius: 20px;
            background-color: rgba(255, 255, 255, 0.9);
        }
    </style>
    @yield('styles')

</head>
<body>
    <header>
        @include("layouts.header")
    </header>

    <div class="fondo">
        <div class="breadcrumbs">
            @yield('breadcrumbs')
        </div>
            @yield('content')
    </div>

    <footer>
        @include("layouts.footer")
    </footer>

    @vite(['resources/js/app.js'])
</body>
</html>
