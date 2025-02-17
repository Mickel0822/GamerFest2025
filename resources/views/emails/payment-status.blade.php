<body style="margin: 0; padding: 0; background-color: #1c1c1c; font-family: Arial, sans-serif; color: #ffffff;">
    <!-- Contenedor principal (tabla) -->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin: 0; padding: 0;">
        <tr>
            <td align="center" style="padding: 20px;">
                <!-- Tabla interior centrada -->
                <table width="600" border="0" cellspacing="0" cellpadding="0"
                    style="background-color: #094052; border-radius: 8px; overflow: hidden;">

                    <!-- Encabezado con Logo -->
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <img src="https://gamerfest2025-receipts.s3.us-east-2.amazonaws.com/imagenesUsoGeneral/LOGO.png"
                                alt="LOGO" style="width: 150px; height: auto;">
                        </td>
                    </tr>

                    <!-- Título principal -->
                    <tr>
                        <td align="center" style="padding: 10px 20px;">
                            <h1 style="margin: 0; font-size: 26px; color: #ffffff;">
                                ACTUALIZACIÓN DE INSCRIPCIÓN
                            </h1>
                        </td>
                    </tr>

                    <!-- Contenido -->
                    <tr>
                        <td style="padding: 10px 40px; text-align: center;">
                            <p style="margin: 0; font-size: 16px;">
                                Hola, <strong>{{ $userLastName }}</strong> <strong>{{ $userName }}</strong>
                            </p>
                            <p style="margin: 0; font-size: 16px;">
                                Tu inscripción para el juego <strong>{{ $gameName }}</strong> ha sido
                                actualizada a:
                            </p>
                        </td>
                    </tr>

                    <!-- Estado de inscripción grande y centrado -->
                    @php
                        $color = match (strtolower($status)) {
                            'pendiente' => '#0bd9f4',
                            'rechazado' => '#f87171',
                            'verificado' => '#4ade80',
                            default => '#000000', // color por defecto en caso de otros estados
                        };
                    @endphp

                    <tr>
                        <td align="center" style="padding: 20px;">
                            <p style="margin: 0; font-size: 24px; font-weight: bold; color: {{ $color }};">
                                {{ ucfirst($status) }}
                            </p>
                        </td>
                    </tr>

                    <!-- Mensaje de contacto -->
                    <tr>
                        <td style="padding: 10px 40px 20px; text-align: center;">
                            <p style="margin: 0; font-size: 16px;">
                                Si necesitas más información, por favor revisa tu cuenta o contáctanos.
                            </p>
                        </td>
                    </tr>
                    <!-- Mensaje de agradecimiento -->
                    <tr>
                        <td style="padding: 10px 40px 20px; text-align: center;">
                            <p style="margin: 0; font-size: 16px;">
                                ¡Gracias por participar!
                            </p>
                        </td>
                    </tr>

                    <!-- Botón (opcional, si deseas agregar un enlace) -->
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <a href="http://gamerfest2025.com/"
                                style="display: inline-block; text-decoration: none; background-color: #0dc6df; color: #ffffff; padding: 12px 24px; border-radius: 4px; font-size: 16px;">
                                Ir a GamerFest
                            </a>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
