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

                    <!-- Título -->
                    <tr>
                        <td align="center" style="padding: 10px 20px;">
                            <h1 style="margin: 0; font-size: 26px; color: #ffffff;">
                                SOLICITUD DE CÓDIGO DE VERIFICACIÓN
                            </h1>
                        </td>
                    </tr>

                    <!-- Texto de bienvenida -->
                    <tr>
                        <td style="padding: 10px 40px; text-align: center;">
                            <p style="margin: 0; font-size: 16px;">
                                Hola <strong>{{ $name }}</strong>, hemos recibido una solicitud de verificación
                                para tu cuenta.
                            </p>
                        </td>
                    </tr>

                    <!-- Código destacado -->
                    <tr>
                        <td align="center" style="padding: 20px;">
                            <p style="font-size: 24px; font-weight: bold; margin: 0; color: #0bd9f4;">
                                {{ $code }}
                            </p>
                        </td>
                    </tr>

                    <!-- Texto adicional e Instrucciones -->
                    <tr>
                        <td style="padding: 0 40px 20px; text-align: center;">
                            <p style="margin: 0; font-size: 16px;">
                                Si no solicitaste este código, puedes ignorar este correo. De lo contrario, haz clic en
                                el siguiente enlace para continuar con el proceso:
                            </p>
                        </td>
                    </tr>

                    <!-- Enlace a tu página -->
                    <tr>
                        <td align="center" style="padding: 10px 0 30px;">
                            <a href="http://grupo2.gamerfest2025.com/admin/two-factor-auth"
                                style="display: inline-block; text-decoration: none; background-color: #0dc6df; color: #ffffff; padding: 12px 24px; border-radius: 4px; font-size: 16px;">
                                Ir a la página
                            </a>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
