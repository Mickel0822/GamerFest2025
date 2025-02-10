<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas del Jugador</title>
</head>
<body>
    <h1>Bienvenido</h1>
    <div>
        <h2>Estadísticas del Jugador</h2>
        <ul>
            <li>Juegos Jugados: {{ $playerStats['games_played'] }}</li>
            <li>Victorias/Derrotas: {{ $playerStats['wins'] }} / {{ $playerStats['losses'] }}</li>
            <li>Puntuación Total: {{ $playerStats['total_score'] }}</li>
            <li>Porcentaje de Asistencia: {{ $playerStats['attendance_percentage'] }}%</li>
        </ul>
    </div>
</body>
</html>