<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reglas - {{ $game->name }}</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: #abc9f0;
        }
        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center; /* Centrar contenido dentro del contenedor */
        }
        h1 {
            font-family: 'Rockwell', cursive;
            margin-bottom: 2rem;
        }
        p {
            font-size: 1rem;
            line-height: 1.5;
        }
        a {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            background: #1e2d55;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-family: 'Rockwell', cursive;
            font-weight: bold;
        }
        a:hover {
            background: #1c3f91;
        }
        .logo {
            max-width: 250px; /* Ajusta el tamaño máximo del logo */
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="/images/LOGO.png" alt="Logo" class="logo"> 
        <h1>Reglas para {{ $game->name }}</h1>
        <p>{{ $game->rules }}</p>
        <a href="/">Volver a la página principal</a>
    </div>
</body>
</html>
