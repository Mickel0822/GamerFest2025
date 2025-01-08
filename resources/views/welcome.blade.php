<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GAMERFEST</title>
    <link rel="icon" href="{{ asset('images/LOGO.png') }}" type="image/png">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            overflow-x: hidden;
            position: relative;
        }
        /* Fondo exclusivo para el contenido principal */
.content-with-bg {
    background: url('https://media.istockphoto.com/id/1420927953/es/v%C3%ADdeo/abstract-motion-fondo.jpg?s=640x640&k=20&c=MXaexTmjL5zdKA8TugAmX46vIi7fmxENlZWEjzzW1oo=') no-repeat center center fixed; /* Fondo fijo */
    background-size: cover; /* Cubre todo el contenedor */
    padding: 2rem 0; /* Espaciado interno */
}

/* Header */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco semitransparente */
    padding: 0.5rem 2rem;
    color: #172857;
    font-family: 'Rockwell', cursive;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Título de las secciones */
    h1.section-title {
            text-align: center; /* Centra el texto */
            font-family: 'Rockwell', cursive;
            font-size: 2.5rem;
            color: #111933;
            margin-bottom: 1.5rem;
        }

        .footer {
    background-color: #ffffff; /* Fondo blanco */
    display: flex;
    flex-direction: row; /* Coloca las secciones en fila */
    justify-content: space-between; /* Espacio uniforme entre secciones */
    align-items: center; /* Centra verticalmente */
    padding: 2rem; /* Espaciado interno */
}

/* Redes sociales */
.footer .social-media {
    font-family: 'Rockwell', cursive;
    text-align: center;
    color: #304470;
    margin-right: -50px; /* Ajusta la distancia desde el borde derecho */
    display: flex;
    gap: 1rem; /* Espaciado entre iconos */
    font-size: 1.4rem;
    
}

.footer .social-media img {
    width: 60px;
    height: 60px;
    transition: transform 0.3s ease; /* Efecto de hover */
}

.footer .social-media img:hover {
    transform: scale(1.2); /* Aumenta ligeramente al pasar el cursor */
}

/* Derechos de autor */
.footer-text {
    font-size: 1.2rem;
            font-family: 'Rockwell', cursive;
            text-align: center;
            color: #304470;
            margin-right: -50px; /* Ajusta la distancia desde el borde derecho */
}

/* Creadores */
.footer .creators {
    font-size: 1.0rem;
    font-family: 'Rockwell', cursive;
    text-align: right;
    color: #304470;
    text-align: left; /* Alinea el texto hacia la izquierda */
    margin-right: 100px; /* Ajusta la distancia desde el borde derecho */
}

    /* Header estático */
    .header {
        background-color: #0b2261; /* Fondo azul oscuro */
        text-align: center; /* Centrar el texto */
        padding: 1rem; /* Espaciado interno */
        font-family: 'Rockwell', cursive; /* Tipo de letra personalizada */
        font-size: 2.5rem; /* Tamaño del texto */
        position: static; /* Header estático (por defecto) */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra opcional */
    }
    /* Título del Header */
    .header h1 {
        font-size: 2.0rem;
        margin: 0;
        color: #f0f0f0; /* Texto blanco */
    }
    .header img {
            width: 80px; /* Tamaño más grande del logo */
            height: 80px; /* Asegura proporción */
    }

        /* Botón Login */
        .cta-buttonss {
            font-family: 'Rockwell', cursive;
            font-size: 0.9rem;
            font-weight: bold;
            text-transform: uppercase;
            color: #061925;
            text-decoration: none;
            transition: all 0.29s ease;
            background-color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 3px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            position: relative;
            /* Ajusta la distancia desde el borde derecho */
        }

        /* Fondo difuminado */
        .background-image {

        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        justify-content: center;
        background: url('/images/LOGO.png') no-repeat center center;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        z-index: 0;
    }


        /* Títulos personalizados */
        h1 {
            font-family: 'Rockwell', cursive; /* Fuente personalizada */
            font-size: 2.5rem; /* Tamaño del texto */
            color: #111933; /* Color del texto */
            margin-bottom: 1rem;
        }
        /* Sección de Juegos y Patrocinadores */
        .games-section,
        .sponsors-section {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 2rem;
            margin: 3rem 1rem;
            padding: 2rem;
            border-radius: 10px;
        }

        .box {
            width: 200px; /* Ajusta el tamaño de las tarjetas */
            background: rgba(38, 56, 73, 0.95); /* Fondo ligeramente oscuro */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.7); /* Sombra para dar profundidad */
            text-align: center;
            padding: 1rem; /* Espacio interno */
            color: #ffffff;
            transition: transform 0.3s ease;
        }

        .box:hover {
            transform: scale(1.05); /* Efecto de zoom al pasar el cursor */
        }

        .game-card img,
        .box img {
            width: 100%;
            height: 120px; /* Ajusta la altura de la imagen */
            object-fit: cover; /* Mantiene la proporción de la imagen */
            border-radius: 10px 10px 0 0;
        }

        .game-card h3, .game-card p {
            margin: 10px 0;
            font-size: 1rem;
        }

        .game-buttons {
            margin-top: 10px;
        }

        .game-buttons a {
            display: inline-block;
            margin: 5px;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            color: #fff;
            background-color: #7d93cf;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .game-buttons a:hover {
            background-color: #5991b6;
        }

        /* Redes sociales en una fila */
        .social-media {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-media img {
            width: 50px;
            height: 50px;
            transition: transform 0.3s ease;
        }

        .social-media img:hover {
            transform: scale(1.2);
        }

        /* Contador */
        .contador {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 250px;
    background: rgba(20, 63, 83, 0.9);
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(243, 242, 242, 0.87);
    text-align: center;
    animation: fadeIn 2s ease;
    font-family: 'Rockwell', cursive;
    z-index: 2; /* Por encima del fondo difuminado */
    transition: bottom 0.3s ease; /* Transición suave al ajustar la posición */
}


        .contador h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        #countdown {
            font-size: 2rem;
            font-weight: bold;
            color: #f3f1f5;
        }
        .logo{
            width: 1px;
            height: 1px;
            transition: transorm 0.3s ease;
        }
                /* Menú principal */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #0b2261; /* Color de fondo del menú */
            padding: 0.5rem 1rem;
            color: white;
            position: relative;
            font-family: 'Indie Flower', cursive; /* Tipo de letra personalizada */
            font-size: 2.5rem; /* Tamaño del texto */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra opcional */
        }

        .navbar h1 {
            margin: 0;
            font-size: 1.5rem;
            color: #f0f0f0; /* Texto blanco */
        }
        .navbar img {
            width: 80px; /* Tamaño más grande del logo */
            height: 80px; /* Asegura proporción */
        }

        /* Menú de enlaces */
        .nav-links {
            display: flex;
            gap: 1rem;
        }

        .nav-links a {
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-family: 'Rockwell', cursive;
            font-size: 1.4rem;
            font-weight: bold;
            text-transform: uppercase;
            color: #061925;
            background-color: #ffffff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .nav-links a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Estilos para el menú hamburguesa */
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 5px;
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background-color: white;
            border-radius: 3px;
        }

        /* Menú desplegable (por defecto oculto) */
        .nav-links-mobile {
            display: none;
            flex-direction: column;
            gap: 1rem;
            background-color: #0b2261;
            position: absolute;
            top: 100%;
            right: 0;
            left: 0;
            padding: 1rem;
        }
        /* Mostrar el menú desplegable cuando esté activo */
        .nav-links-mobile.active {
            display: flex;
        }

        /* Menú en pantallas grandes (768px en adelante) */
        @media (min-width: 768px) {
            .nav-links {
                display: flex; /* Menú principal visible en pantallas grandes */
            }

            .nav-links-mobile {
                display: none; /* Oculta el menú móvil completamente */
            }
        }

        .nav-links-mobile a {
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-family: 'Rockwell', cursive;
            font-size: 1.2rem;
            font-weight: bold;
            text-transform: uppercase;
            color: white; /* Cambiar color del texto a blanco para mejor visibilidad */
            background-color: transparent; /* Elimina el fondo blanco */
            transition: background-color 0.3s ease;
            text-align: center;
        }

        .nav-links-mobile a:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Efecto hover más limpio */
        }

        /* Responsividad */
        @media (max-width: 768px) {
            .nav-links {
                display: none; /* Oculta los enlaces en dispositivos pequeños */
            }

            .hamburger {
                display: flex; /* Muestra el botón de hamburguesa */
            }
        }



        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

    </style>
</head>
<body>
    <!-- Header -->
    <div class="navbar">
        <img src="/images/LOGO.png" alt="logo de la pagina">
        <h1>GAMERFEST 2025</h1>
        <div  class="nav-links">
            @if(Auth::check())
                <!-- Usuario autenticado: Mostrar botón al panel -->
                <a href="/admin" class="cta-buttonss">Panel</a>
            @else
                <!-- Usuario no autenticado: Mostrar botones de registro y login -->
                <a href="/register" class="cta-buttonss">Registrarse</a>
                <a href="/admin/login" class="cta-buttonss">Iniciar Sesion</a>
            @endif
        </div>
        <!-- Botón de menú hamburguesa -->
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <!-- Menú móvil -->
        <div class="nav-links-mobile">
            @if(Auth::check())
            <!-- Usuario autenticado: Mostrar botón al panel -->
            <a href="/admin" class="cta-buttonss">Panel</a>
            @else
            <!-- Usuario no autenticado: Mostrar botones de registro y login -->
            <a href="/register" class="cta-buttonss">Registrarse</a>
            <a href="/admin/login" class="cta-buttonss">Iniciar Sesion</a>
            @endif
        </div>
    </div>

    <!-- Mostrar mensajes de éxito -->
@if(session('success'))
    <div class="alert alert-success" style="text-align: center; margin: 1rem auto; max-width: 800px; background-color: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        {{ session('success') }}
    </div>
@endif


    <!-- Fondo difuminado -->

    <!-- Contenido principal -->
    <div class="content-with-bg">
        <!-- Juegos Individuales -->
        <h1 class="section-title">Juegos Individuales</h1>
            <div class="games-section">
                @foreach($games as $game)
                    @if ($game->type === 'individual')
                    <div class="box">
                        <div class="game-card">
                            <img src="{{ $game->image_url }}" alt="{{ $game->name }}">
                            <h3>{{ $game->name }}</h3>
                            <p>Precio: $3.00</p>
                            <div class="game-buttons">
                                <a href="/inscribirse/{{ $game->id }}">Inscribirse</a>
                                <a href="#">Reglas</a>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

        <!-- Juegos Grupales -->
        <h1 class="section-title">Juegos Grupales</h1>
        <div class="games-section">
            @foreach($games as $game)
                @if ($game->type === 'group')
                <div class="box">
                    <div class="game-card">
                        <img src="{{ $game->image_url }}" alt="{{ $game->name }}">
                        <h3>{{ $game->name }}</h3>
                        <p>Precio: $25.00</p>
                        <div class="game-buttons">
                            <a href="/inscribirse/{{ $game->id }}">Inscribirse</a>
                            <a href="#">Reglas</a>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        <!-- Patrocinadores -->
        <h1 class="section-title">Patrocinadores</h1>
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
    </div>
    <!-- Contador -->
    <div class="contador">
        <h2>¡Gamerfest está a punto de comenzar!</h2>
        <div id="countdown">00d 00h 00m 00s</div>
    </div>

    <!-- Footer -->
<div class="footer">
    <!-- Redes sociales -->
    <div class="social-media">
        <p>Síguenos</p>
        <a href="#"><img src="/images/feibu.png" alt="Facebook"></a>
        <a href="#"><img src="/images/ig.png" alt="Instagram"></a>
    </div>

    <!-- Derechos de autor -->
        <div class="footer-text mt-3">
        <p>© 2025 GamerFest. Todos los derechos reservados.</p>
        <p><a href="#" class="text-decoration-none">Política de Privacidad</a> | <a href="#" class="text-decoration-none">Términos y Condiciones</a></p>
    </div>

    <!-- Creadores -->
    <div class="creators">
        <a href="#">Creador por:</a>
        
        <p>Mickel Aragón </p>
        <p>Cristian Bayas </p>
        <p>Nayely Camalli  </p>
        <p>Damarys León  </p>
    </div>
</div>

    
    </div>
      <!-- Script del Contador -->
<script>
    const eventDate = new Date("2025-12-20T10:00:00").getTime();
    const countdownFunction = setInterval(function () {
        const now = new Date().getTime();
        const distance = eventDate - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Actualizar el contenido del contador
        document.getElementById("countdown").innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;

        // Verificar si la cuenta regresiva ha terminado
        if (distance < 0) {
            clearInterval(countdownFunction);
            document.getElementById("countdown").innerHTML = "¡El evento ha comenzado!";
        }
    }, 1000);
</script>
<script>
    const hamburger = document.querySelector('.hamburger');
    const mobileMenu = document.querySelector('.nav-links-mobile');

    // Alternar el menú desplegable al hacer clic en el ícono de hamburguesa
    hamburger.addEventListener('click', () => {
        mobileMenu.classList.toggle('active');
    });

    // Ocultar el menú móvil si la pantalla es grande
    window.addEventListener('resize', () => {
        if (window.innerWidth > 768) {
            mobileMenu.classList.remove('active');
        }
    });

    // Asegurar que el menú móvil esté oculto al cargar la página en pantallas grandes
    window.addEventListener('load', () => {
        if (window.innerWidth > 768) {
            mobileMenu.classList.remove('active');
        }
    });
</script>
<script>
    // Función para ajustar la posición del contador
    function adjustCounterPosition() {
        const footer = document.querySelector('.footer');
        const contador = document.querySelector('.contador');

        if (footer && contador) {
            const footerRect = footer.getBoundingClientRect();
            const contadorRect = contador.getBoundingClientRect();

            // Si el contador se superpone al footer
            if (contadorRect.bottom > footerRect.top) {
                const overlap = contadorRect.bottom - footerRect.top;
                contador.style.bottom = `${20 + overlap}px`; // Ajusta la posición del contador
            } else {
                contador.style.bottom = '20px'; // Posición normal del contador
            }
        }
    }

    // Ajustar posición del contador al cargar y al cambiar tamaño/scroll
    window.addEventListener('load', adjustCounterPosition);
    window.addEventListener('resize', adjustCounterPosition);
    window.addEventListener('scroll', adjustCounterPosition);
</script>


</body>
</html>
