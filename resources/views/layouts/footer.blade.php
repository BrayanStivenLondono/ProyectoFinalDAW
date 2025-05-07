<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        a {
            color: inherit;
            text-decoration: none;
        }

        .main-footer {
            font-family: "Outfit", sans-serif;
            font-optical-sizing: auto;
            font-weight: lighter;
            font-style: normal;
            background-color: rgba(255, 255, 255, 0.8);
            color: #222;
            padding: 15px 0;
            border-top: 1px solid #eee;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .footer-left p {
            font-size: 0.9em;
            margin: 0;
        }

        .footer-right ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .footer-right li {
            margin-left: 20px;
        }

        .footer-right li:first-child {
            margin-left: 0;
        }

        .footer-right a {
            font-size: 1em;
            color: #555;
            position: relative;
        }

        .footer-right a::after {
            content: "";
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 1px;
            background-color: #222;
            transition: width 0.3s ease-in-out;
        }

        .footer-right a:hover::after {
            width: 100%;
        }

    </style>
</head>
<body>
    <footer class="main-footer complex-footer">
        <div class="footer-top container">
            <div class="footer-column">
                <h3>Descubre</h3>
                <ul class="footer-links">
                    <li><a href="#">Artistas</a></li>
                    <li><a href="#">Obras Destacadas</a></li>
                    <li><a href="#">Colecciones</a></li>
                    <li><a href="#">Exposiciones Virtuales</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Mi Cuenta</h3>
                <ul class="footer-links">
                    <li><a href="#">Perfil</a></li>
                    <li><a href="#">Mis Favoritos</a></li>
                    <li><a href="#">Historial de Vistas</a></li>
                    <li><a href="#">Alertas de Artistas</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Sobre Nosotros</h3>
                <ul class="footer-links">
                    <li><a href="#">Nuestra Historia</a></li>
                    <li><a href="#">Equipo</a></li>
                    <li><a href="#">Contacto</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Síguenos</h3>
                <ul class="social-links">
                    <li><a href="#" aria-label="Facebook">📘 Facebook</a></li>
                    <li><a href="#" aria-label="Twitter">🐦 Twitter</a></li>
                    <li><a href="#" aria-label="Instagram">📸 Instagram</a></li>
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
