<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Financiero</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('https://cdn.jsdelivr.net/npm/dejavu-fonts-ttf@2.37/ttf/DejaVuSans.ttf') format('truetype');
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 20px;
        }
        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        .section {
            margin: 20px 0;
        }
        .total {
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="title">Balance Financiero</div>

    <div class="section">
        <p><strong>Ingresos Totales:</strong> ${{ utf8_decode(number_format($data['ingresos'], 2)) }}</p>
    </div>
    <div class="section">
        <p><strong>Egresos Totales:</strong> ${{ utf8_decode(number_format($data['egresos'], 2)) }}</p>
    </div>
    <div class="section total">
        <p><strong>Saldo Total:</strong> ${{ utf8_decode(number_format($data['saldo'], 2)) }}</p>
    </div>
</body>
</html>

