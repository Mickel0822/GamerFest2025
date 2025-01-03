<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GAMERFEST</title>
    @livewireStyles
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: url('/images/fonde.png') no-repeat center center fixed;
            background-size: cover;
            text-align: center;
            overflow-x: hidden;
        }

        /* Contenedor principal del logo y botones */
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            margin-top: 2rem;
        }

        /* Logo central */
        .header-logo {
            flex: 10;
            text-align: center;
        }
        .header-logo img {
            max-width: 500px;
            animation: fadeIn 6s ease;
        }

        /* Botones Inscribete y Reglamentos */
        .cta-buttons {
            font-family: 'Indie Flower', cursive;
            font-size: 2.5rem;
            font-weight: bold;
            text-transform: uppercase;
            color: #3c1f4d;
            text-decoration: none;
            transition: all 0.29s ease;
            position: relative;
        }

        .cta-buttons:hover {
            color: #ffffff;
            text-shadow: 0 0 50px #440f37, 0 0 20px #752f7e;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Contador */
        .contador {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 250px;
            background: rgba(42, 20, 83, 0.9);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(243, 242, 242, 0.87);
            text-align: center;
            animation: fadeIn 2s ease;
            font-family: 'Indie Flower', cursive;
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

        /* Juegos y Patrocinadores */
        .games-section, .sponsors-section {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1.0rem;
            margin: 3.5rem 0;
        }

        .box {
            width: 150px;
            height: 150px;
            background: rgba(0, 51, 102, 0.8);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #fff;
            box-shadow: 0 4px 8px rgba(253, 253, 253, 0.911);
        }

        /* Footer */
        .footer img {
            margin: 0.5rem;
            transition: transform 0.3s ease;
        }

        .footer img:hover {
            transform: scale(1.2);
        }
    </style>
</head>
<body>
    @livewireScripts
    <!-- Header con botones y logo -->
    <div class="header-container">
        <a href="/inscribete" class="cta-buttons">Inscríbete</a>
        <div class="header-logo">
            <img src="/images/LOGO.png" alt="GAMERFEST">
        </div>
        <a href="/reglamentos" class="cta-buttons">Reglamentos</a>
    </div>

    <!-- Sección de Juegos -->
    <div class="games-section">
        <div class="box">Juego 1</div>
        <div class="box">Juego 2</div>
        <div class="box">Juego 3</div>
        <div class="box">Juego 4</div>
        <div class="box">Juego 5</div>
        <div class="box">Juego 6</div>
    </div>

    <!-- Sección de Patrocinadores -->
    <div class="sponsors-section">
        <div class="box">Patrocinador 1</div>
        <div class="box">Patrocinador 2</div>
        <div class="box">Patrocinador 3</div>
        <div class="box">Patrocinador 4</div>
    </div>

    <!-- Contador -->
    <div class="contador">
        <h2>¡Gamerfest está a punto de comenzar!</h2>
        <div id="countdown">00d 00h 00m 00s</div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <a href="#"><img src="/images/tuich.png" alt="Twitch" width="70" height="40"></a>
        <a href="#"><img src="/images/feibu.png" alt="Facebook" width="40" height="40"></a>
        <a href="#"><img src="/images/ig.png" alt="Instagram" width="40" height="40"></a>
    </div>

    <!-- Script del Contador -->
    <script>
        const eventDate = new Date("2024-12-20T10:00:00").getTime();
        const countdownFunction = setInterval(function() {
            const now = new Date().getTime();
            const distance = eventDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("countdown").innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;

            if (distance < 0) {
                clearInterval(countdownFunction);
                document.getElementById("countdown").innerHTML = "¡El evento ha comenzado!";
            }
        }, 1000);
    </script>
</body>
</html>
