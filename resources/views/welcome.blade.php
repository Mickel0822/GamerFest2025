<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GAMERFEST</title>
    <link rel="icon" href="{{ asset('images/LOGO.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
/* Variables Globales */
:root {
    --primary-color: #0b2261;
    --secondary-color: #ffcc00;
    --text-light: #ffffff;
    --text-dark: #061925;
    --background-dark: rgba(11, 34, 97, 0.95);
    --background-light: rgba(255, 255, 255, 0.8);
    --font-primary: 'Rockwell', cursive;
    --font-secondary: 'Roboto', sans-serif;
}

/* Reset Básico */
body {
    margin: 0;
    font-family: var(--font-secondary);
    overflow-x: hidden;
    background: url('https://media.istockphoto.com/id/1420927953/es/v%C3%ADdeo/abstract-motion-fondo.jpg?s=640x640&k=20&c=MXaexTmjL5zdKA8TugAmX46vIi7fmxENlZWEjzzW1oo=') no-repeat center center fixed;
    background-size: cover;
    color: var(--text-light);
}

/* Navbar */
/* Estilos generales del navbar */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #0b2261;
    padding: 10px 20px;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.navbar .logo img {
    height: 40px;
    transition: transform 0.3s ease;
}

.navbar .logo img:hover {
    transform: scale(1.1);
}

.nav-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}

.nav-links {
    display: flex;
    gap: 18px; /* Aumenta la separación entre los botones */
    justify-content: center;
    margin-left: -40px; /* Mueve las secciones un poco a la izquierda */
    flex-grow: 1;
}

.nav-links a {
    text-decoration: none;
    font-size: 1rem;
    font-weight: bold;
    color: var(--text-light);
    padding: 0.6rem 1.2rem; /* Ajusta el tamaño del padding */
    border-radius: 5px;
    background-color: rgba(255, 255, 255, 0.2);
    transition: background 0.3s, transform 0.3s ease;
}

.nav-links a:hover {
    background: var(--secondary-color);
    color: black;
    transform: scale(1.05);
}

/* Botón "Iniciar Sesión" más grande y más a la izquierda */
.navbar-buttons {
    display: flex;
    justify-content: flex-end; /* Mantiene alineado a la derecha */
    gap: 0.5rem;
    align-items: center;
    margin-right: 50px;
}

.navbar-buttons a {
    text-decoration: none;
    font-size: 1.2rem; /* Aumentado el tamaño */
    padding: 0.8rem 1.8rem; /* Hacerlo más visible */
    background: var(--secondary-color);
    border-radius: 5px;
    font-weight: bold;
    color: black;
    text-transform: uppercase;
    transition: background 0.3s, transform 0.3s ease;
    position: relative;
    left: -60px; /* Mueve el botón más a la izquierda */
}

.navbar-buttons a:hover {
    background: white;
    color: var(--primary-color);
    transform: scale(1.05);
}


/* Contador dentro del navbar */
.counter-container {
    background: var(--background-dark);
    padding: 0.6rem 1rem;
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: bold;
    text-align: center;
    color: var(--text-light);
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-width: 180px;
    min-height: 60px;
    border: 3px solid white;
    margin-left: 1rem;
}

.counter-container h2 {
    font-size: 0.9rem;
    margin: 0;
}

#countdown {
    font-size: 1rem;
    font-weight: bold;
    color: var(--secondary-color);
}

/* Menú hamburguesa */
.hamburger {
    display: none;
    flex-direction: column;
    cursor: pointer;
    gap: 6px;
    padding: 10px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 5px;
}

.hamburger span {
    width: 25px;
    height: 3px;
    background: var(--text-light);
    border-radius: 3px;
}

/* Hero Section */
/* Agregar margen superior al body para compensar el navbar */
body {
    padding-top: 4rem;
}

.hero-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 4rem 4rem; /* Ajustado el espaciado */
    max-width: 1200px;
    margin: auto;
}

.hero-text {
    max-width: 50%;
}

.hero-text h1 {
    font-size: 2.8rem; /* Reducido ligeramente */
    font-family: var(--font-primary);
    color: var(--primary-color);
}

.hero-text p {
    color: var(--primary-color);
    font-size: 1.8rem;
    margin: 1rem 0; /* Más espacio entre el texto */
}

.hero-button {
    display: inline-block;
    font-size: 1.6rem; /* Reducido un poco más */
    font-weight: bold;
    text-transform: uppercase;
    padding: 1rem 2rem; /* Ajustado el tamaño */
    background-color: var(--secondary-color);
    color: black;
    border: none;
    border-radius: 10px;
    text-decoration: none;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-top: 1.6rem;
}

.hero-button:hover {
    transform: scale(1.1);
    box-shadow: 0 0 35px rgba(255, 204, 0, 1);
}

.hero-image {
    width: 450px;
    height: auto;
    border-radius: 15px;
    box-shadow: 0 0 25px rgba(0, 123, 255, 0.8);
    margin-top: 3rem; /* Ajustado para subir un poco */
}

.games-section, .sponsors-section {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 2rem;
            margin-top: 3rem;
            padding: 2rem;
        }

        .box {
            width: 250px;
            background: rgba(38, 56, 73, 0.95);
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.5);
            text-align: center;
            padding: 1.5rem;
            color: #ffffff;
            transition: transform 0.3s ease;
        }

        .box:hover {
            transform: scale(1.1);
        }

        .footer {
    background: var(--background-dark);
    color: var(--text-light);
    padding: 2rem;
    text-align: center;
    font-size: 1rem;
    margin-top: 2rem;
}

.social-media {
    margin-bottom: 1rem;
}

.social-icon {
    font-size: 1.8rem;
    color: var(--secondary-color);
    margin: 0 10px;
    transition: transform 0.3s ease, color 0.3s ease;
}

.social-icon:hover {
    color: white;
    transform: scale(1.2);
}

.footer-text p, .credits p {
    margin: 0.5rem 0;
}

.text-link {
    color: var(--secondary-color);
    text-decoration: none;
    transition: color 0.3s ease;
}

.text-link:hover {
    color: white;
}

/* Usuario autenticado */
.user-menu {
    position: relative;
    display: flex;
    align-items: center;
    cursor: pointer;
    gap: 12px; /* Antes era menos, ahora hay más separación */
    padding: 8px 14px; /* Agregar padding alrededor para no verse tan pegado */
    border-radius: 8px;
    transition: background 0.3s ease;
}

/* Info del usuario (imagen + nombre) */
.user-info {
    display: flex;
    align-items: center;
    gap: 8px; /* Separa el icono del nombre */
}

.user-info:hover {
    background: rgba(255, 255, 255, 0.2);
}

/* Imagen del usuario */
.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid white;
}

/* Nombre del usuario */
.user-name {
    font-weight: bold;
    color: white;
    margin-right: 5px;
}

/* Flecha desplegable */
.dropdown-icon {
    font-size: 14px;
    color: white;
    transition: transform 0.3s ease;
}

/* Cuando el menú está activo, la flecha gira */
.user-menu.active .dropdown-icon {
    transform: rotate(180deg);
}

/* Menú desplegable */
.dropdown-menu-user {
    display: none;
    position: absolute;
    top: 50px; /* Ajustado para no estar pegado al perfil */
    right: 0px; /* Lo mantiene alineado con el icono */
    background: rgba(11, 34, 97, 0.95);
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    min-width: 180px; /* Se ajusta para evitar que el texto se desborde */
    text-align: left;
}
/* Asegurar que los textos no se salgan del cuadro */
.dropdown-item {
    display: flex;
    align-items: center;
    white-space: nowrap; /* Evita que el texto se rompa */
    padding: 10px 12px;
    font-size: 14px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 5px;
    transition: background 0.3s ease;
}

/* Icono en los botones del menú */
.dropdown-item i {
    margin-right: 8px;
}

/* Efecto hover */
.dropdown-item:hover {
    background: rgba(255, 255, 255, 0.3);
}

/* Mostrar el menú cuando esté activo */
.user-menu.active .dropdown-menu-user {
    display: block;
}

/* Estilos del dropdown */
.dropdown-menu-user a,
.dropdown-menu-user button {
    display: flex;
    align-items: center;
    padding: 10px;
    text-decoration: none;
    color: white;
    font-size: 14px;
    background: none;
    border: none;
    cursor: pointer;
    width: 100%;
    text-align: left;
}

/* Iconos dentro del dropdown */
.dropdown-menu-user a i,
.dropdown-menu-user button i {
    margin-right: 8px;
}

/* Efecto hover */
.dropdown-menu-user a:hover,
.dropdown-menu-user button:hover {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 5px;
}

/* Botón de iniciar sesión */
.btn-login {
    text-decoration: none;
    font-size: 1rem;
    padding: 10px 20px;
    background: #ffcc00;
    color: black;
    font-weight: bold;
    border-radius: 5px;
    transition: background 0.3s ease;
}

.btn-login:hover {
    background: white;
    color: #0b2261;
}
        .section-title {
            font-size: 2.5rem;
            text-transform: uppercase;
            font-weight: bold;
            color: var(--primary-color);
            text-align: center;
            margin: 15vh 0 2rem;
        }

@media (max-width: 768px) {
    .hero-section {
        flex-direction: column;
        text-align: center;
    }
    .hero-text {
        max-width: 100%;
    }
    .hero-image {
        margin-top: 2rem;
        width: 80%;
    }
    .hero-button {
        font-size: 1.8rem;
        padding: 1.2rem 2.5rem;
    }
}

    </style>
</head>
<body>
    <!-- Header -->
    <div class="navbar">
    <!-- Contador a la izquierda -->
    <div class="counter-container">
        <h2>GAMERFEST está a punto de empezar</h2>
        <div id="countdown">314d 23h 28m 45s</div>
    </div>

    <!-- Botones de navegación en el centro -->
    <div class="nav-links">
        <a href="#juegos">Juegos Individuales</a>
        <a href="#grupales">Juegos Grupales</a>
        <a href="#patrocinadores">Patrocinadores</a>
    </div>

    <!-- Menú de usuario a la derecha -->
    <div class="navbar-buttons">
        @if(Auth::check())
            <div class="user-menu" onclick="toggleUserDropdown()">
                <div class="user-info">
                    <img src="{{ Auth::user()->avatar_url ?? '/images/default-avatar.png' }}" alt="Foto de perfil" class="user-avatar">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </div>
                <div class="dropdown-menu-user">
                <button onclick="window.location.href='/admin/dashboard-participante'" class="dropdown-item">
                    <i class="fas fa-user"></i> Revisar mi perfil
                </button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</button>
                    </form>
                </div>
            </div>
        @else
            <a href="/admin/login" class="btn-login">Iniciar Sesión</a>
        @endif
    </div>
</div>
    <!-- Botón de menú hamburguesa -->
    <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>

<!-- Hero Section -->
<div class="hero-section">
    <div class="hero-text">
        <h1>BIENVENIDO A GAMER FEST</h1>
        <p>El evento mas grande del centro del pais</p>
        <p>Belisario Quevedo - Latacunga</p>
        <a href="{{ route('register') }}" class="hero-button">Inscríbete Ya!</a>
    </div>
    <img src="/images/LOGO.png" alt="Gamer Fest Logo" class="hero-image">
</div>

    <!-- Mostrar mensajes de éxito -->
    @if(session('success'))
        <div class="alert alert-success" style="text-align: center; margin: 1rem auto; max-width: 800px; background-color: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            {{ session('success') }}
        </div>
    @endif

    <!-- Contenido principal -->
    <div class="content-with-bg">
        <h1 class="section-title" id="juegos">Juegos Individuales</h1>
        <div class="games-section">
            @foreach($games as $game)
                @if ($game->type === 'individual')
                    <div class="box">
                        <div class="game-card">
                            <img src="{{ $game->image_url }}" alt="{{ $game->name }}">
                            <h3>{{ $game->name }}</h3>
                            <p>Precio: $3.00</p>
                            <div class="game-buttons">
                                <a href="/admin/inscriptions/create?game_id={{ $game->id }}">Inscribirse</a>
                                <a href="{{ route('rules.show') }}?game_id={{ $game->id }}" class="cta-buttonss">Reglas</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <h1 class="section-title" id="grupales">Juegos Grupales</h1>
        <div class="games-section">
            @foreach($games as $game)
                @if ($game->type === 'group')
                    <div class="box">
                        <div class="game-card">
                            <img src="{{ $game->image_url }}" alt="{{ $game->name }}">
                            <h3>{{ $game->name }}</h3>
                            <p>Precio: $25.00</p>
                            <div class="game-buttons">
                                <a href="/admin/inscriptions/create?game_id={{ $game->id }}">Inscribirse</a>
                                <a href="{{ route('rules.show') }}?game_id={{ $game->id }}" class="cta-buttonss">Reglas</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <h1 class="section-title" id="patrocinadores">Patrocinadores</h1>
        <div class="sponsors-section">
            @foreach($sponsors as $sponsor)
                <div class="box">
                    <div>
                        <img src="{{ $sponsor->image_url }}" alt="{{ $sponsor->name }}">
                        <h3>{{ $sponsor->name }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
    <div class="social-media">
        <p>Síguenos en nuestras redes:</p>
        <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
    </div>

    <div class="footer-text">
        <p>© 2025 GamerFest. Todos los derechos reservados.</p>
        <p><a href="#" class="text-link">Política de Privacidad</a> | <a href="#" class="text-link">Términos y Condiciones</a></p>
    </div>

    <div class="credits">
        <p>Desarrollado por estudiantes de quinto semestre de la ESPE sede Latacunga</p>
    </div>
</div>

    <!-- Script del Contador -->
    <script>
        const eventDate = new Date("2025-12-20T10:00:00").getTime();
        setInterval(function () {
            const now = new Date().getTime();
            const distance = eventDate - now;
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("countdown").innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
        }, 1000);

        document.querySelectorAll('.nav-links a').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 50, // Ajusta según el tamaño de tu navbar
                    behavior: 'smooth'
                });
            }
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
        const userMenu = document.querySelector(".user-menu");
        const dropdown = document.querySelector(".dropdown-menu-user");

        if (userMenu && dropdown) {
            userMenu.addEventListener("click", function (event) {
                event.stopPropagation(); // Evita que el evento se propague y se cierre inmediatamente
                userMenu.classList.toggle("active");
            });

            // Cerrar el menú si se hace clic fuera de él
            document.addEventListener("click", function (event) {
                if (!userMenu.contains(event.target)) {
                    userMenu.classList.remove("active");
                }
            });
        }
    });
    </script>
</body>
</html>
