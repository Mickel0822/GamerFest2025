<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GAMERFEST</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        
        <!-- Styles -->
        <style>
            body {
                margin: 0;
                font-family: 'Roboto', sans-serif;
                background-color: #00274D;
                color: #ffffff;
            }

            /* Header */
            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                background-color: #001f3f;
                padding: 1rem 2rem;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
            }

            /* Logo */
            .header-left .logo {
                font-size: 2rem;
                font-weight: bold;
                color: #4C99E3;
                text-transform: uppercase;
                letter-spacing: 2px;
            }

            /* Login Button */
            .header-right .login-button {
                display: flex;
                align-items: center;
                text-decoration: none;
                background-color: #4C99E3;
                padding: 0.5rem 1rem;
                border-radius: 8px;
                transition: background-color 0.3s, transform 0.2s;
            }

            .header-right .login-button:hover {
                background-color: #3779b1;
                transform: scale(1.05);
            }

            /* Login Image */
            .header-right .login-image {
                width: 24px;
                height: 24px;
                margin-right: 8px;
            }

            .header-right span {
                color: #ffffff;
                font-weight: bold;
                font-size: 1rem;
            }

            .center-logo {
                text-align: center;
                margin: 2rem 0;
            }
            .center-logo img {
                max-width: 200px;
            }
            .games-section, .sponsors-section {
                display: flex;
                justify-content: center;
                gap: 2rem;
                margin: 2rem 0;
            }
            .box {
                width: 150px;
                height: 200px;
                background-color: #0d88bf;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .box.large {
                width: 250px;
                height: 200px;
            }
            .footer {
                text-align: center;
                padding: 2rem 0;
                background-color: #c4cdd6;
            }
            .footer a {
                margin: 0 1rem;
                color: #ffffff;
                text-decoration: none;
                font-size: 1.5rem;
            }
            .contador {
                width: 350px;
                height: 220px;
                background-color: #4C99E3;
                border-radius: 12px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
                font-family: 'Poppins', Georgia, 'Times New Roman', Times, serif;
                color: #ffffff;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
                padding: 20px; 
            }
        </style>
    </head>
    <body>
        <!-- Header -->
        <div class="header">
            <!-- Logo a la izquierda -->
            <div class="header-left">
                <span class="logo">GAMERFEST</span>
            </div>

            <!-- Login con imagen a la derecha -->
            <div class="header-right">
                <a href="/admin" class="login-button">
                    <img src="/images/login-icon.png" alt="Login" class="login-image">
                    <span>LOGIN</span>
                </a>
            </div>
        </div>

        <!-- Center Logo -->
        <div class="center-logo">
            <img src="/images/LOGO.png" alt="GAMERFEST 2025">
        </div>

        <!-- Games Section -->
        <div class="games-section">
            <div class="box">Juego 9</div>
            <div class="box">Juego 5</div>
            <div class="box">Juego 1</div>
        </div>

        <!-- Sponsors Section -->
        <div class="sponsors-section">
            <div class="box">EXAMPLE</div>
            <div class="box">EXAMPLE</div>
            <div class="box">EXAMPLE</div>
            <div class="box">EXAMPLE</div>
            <div class="contador fixed bottom-4 right-4 p-6 mb-4 text-white rounded-lg shadow-lg" role="alert">
                <div class="text-lg font-medium">¡Gamerfest está a punto de comenzar!</div>
                <p class="mt-2 text-lg font-semibold">Tiempo restante:</p>
                <div id="countdown" class="text-2xl font-bold">00:00:00</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <a href="#"><img src="/images/tuich.png" alt="Twitch" width="70" height="40"></a>
            <a href="#"><img src="/images/feibu.png" alt="Facebook" width="40" height="40"></a>
            <a href="#"><img src="/images/ig.png" alt="Instagram" width="40" height="40"></a>
        </div>

        <!-- Script -->
        <script>
            // Configura la fecha y hora del evento (Gamerfest)
            const eventDate = new Date("2024-12-20T10:00:00").getTime(); 
        
            // Actualiza el contador cada segundo
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
