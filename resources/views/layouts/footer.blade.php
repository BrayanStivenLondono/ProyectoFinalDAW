<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title></title>
</head>
<body>
@php use Illuminate\Support\Str; @endphp

    <footer class="main-footer complex-footer">
        <div class="footer-top container">
            <div class="footer-column">
                <h3>Descubre</h3>
                <ul class="footer-links">
                    <li><a href="{{ route("artistas.index") }}">Artistas</a></li>
                    <li><a href="{{ route("verObras") }}">Obras</a></li>
                    <li><a href="{{ route("obra.colecciones") }}">Colecciones</a></li>
                </ul>
            </div>
            @auth
                @php
                    $nombreUsuario = Auth()->user()->nombre . " " . Auth()->user()->apellido;
                    $slug = Str::slug($nombreUsuario);
                @endphp
                <div class="footer-column">
                    <h3>Mi Cuenta</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route("usuario.perfil.publico", ["slug" => $slug]) }}">Perfil Público</a></li>
                        <li><a href="{{ route("favoritos.ver") }}">Mis Favoritos</a></li>
                        @if(Auth()->user()->tipo === "artista")
                            <li><a href="{{ route("panel.artista") }}">Panel de Artista</a></li>
                        @endif
                    </ul>
                </div>
            @endauth
            <div class="footer-column">
                <h3>Sobre Nosotros</h3>
                <ul class="footer-links">
                    <li><a href="{{ route("nuestraHistoria") }}">Nuestra Historia</a></li>
                    <li><a href="{{ route("equipo") }}">Equipo</a></li>
                    <li><a href="{{ route("contacto") }}">Contacto</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Síguenos</h3>
                <ul class="social-links">
                    <li><a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i>  Facebook</a></li>
                    <li><a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i>  Twitter</a></li>
                    <li><a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i>  Instagram</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p>&copy; 2025 Galeria Virtual. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</body>
</html>
