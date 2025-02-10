<!DOCTYPE html>
<html>

<head>
    <title>Estado de Inscripción Actualizado</title>
</head>

<body>
    <h1>Hola, {{ $userName }}</h1>
    <p>Tu inscripción para el juego <strong>{{ $gameName }}</strong> ha sido actualizada.</p>
    <p>Nuevo estado: <strong>{{ ucfirst($status) }}</strong></p>
    <p>Gracias por participar.</p>
</body>

</html>
