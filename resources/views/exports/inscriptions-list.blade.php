<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Inscritos</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 10px; text-align: center; font-size: 12px; }
        .header { margin-bottom: 5px; }
        .logo { width: 100px; margin-top: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 10px; }
        th, td { border: 1px solid black; padding: 4px; text-align: center; }
        th { background-color: #f2f2f2; }
        .signature-container { margin-top: 40px; text-align: center; }
        .signature { width: 150px; height: auto; }
        .representative-name { margin-top: 5px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h3 style="margin-bottom: 2px;">Universidad de las Fuerzas Armadas ESPE - Sede Latacunga</h3>
        <h4 style="margin-bottom: 2px;">Presenta: Gamer Fest 2025</h4>
        <img src="{{ public_path('images/LOGO.png') }}" alt="Logo" class="logo">
        <h2 style="margin-top: 5px;">Lista de Inscritos</h2>


    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 15%;">Apellido</th>
                <th style="width: 15%;">Nombre</th>
                <th style="width: 25%;">Correo Electrónico</th>
                <th style="width: 15%;">Juegos Inscritos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inscriptions as $inscription)
                <tr>
                    <td>{{ $inscription->last_name }}</td>
                    <td>{{ $inscription->name }}</td>
                    <td>{{ $inscription->email }}</td>
                    <td>{{ $inscription->juegos }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature-container">
        <img src="{{ public_path('images/firma.png') }}" alt="Firma" class="signature">
        <div class="representative-name">Coordinador<br>Representante Designado</div>
    </div>
</body>
</html>
