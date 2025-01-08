<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GAMERFEST</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Indie+Flower&display=swap" rel="stylesheet">
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
    font-family: 'Indie Flower', cursive;
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
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem; /* Ajusta el espaciado interno */
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1); /* Sombra opcional para destacar */
        }
    /* Header estático */
    .header {
        background-color: #0b2261; /* Fondo azul oscuro */
        text-align: center; /* Centrar el texto */
        padding: 1rem; /* Espaciado interno */
        font-family: 'Indie Flower', cursive; /* Tipo de letra personalizada */
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
            font-size: 1.4rem;
            font-weight: bold;
            text-transform: uppercase;
            color: #061925;
            text-decoration: none;
            transition: all 0.29s ease;
            background-color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 5px;
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


        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <img src="/images/LOGO.png" alt="logo de la pagina">
        <h1>GAMERFEST 2025</h1>
        <div>
            @if(Auth::check())
                <!-- Usuario autenticado: Mostrar botón al panel -->
                <a href="/admin" class="cta-buttonss">Panel</a>
            @else
                <!-- Usuario no autenticado: Mostrar botones de registro y login -->
                <a href="/register" class="cta-buttonss">Registrarse</a>
                <a href="/admin/login" class="cta-buttonss">Login</a>
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
        <h1>Síguenos</h1>
        <div class="social-media">
            <a href="#"><img src="/images/feibu.png" alt="Facebook"></a>
            <a href="#"><img src="/images/ig.png" alt="Instagram"></a>
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

</body>
</html>
