<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | GamerFest2025</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Incluir la fuente Adventure ReQuest -->
    <link href="https://db.onlinewebfonts.com/c/1bdf0533e00276037a4d0e492b42afcd?family=Adventure+ReQuest" rel="stylesheet">

    <style>
        /* Establecer el fondo de la página */
        body {
            background-color: #dff2f9;
            font-family: 'Adventure Request'; /* Usar la fuente Adventure ReQuest */
        }

        /* Estilos del logo */
        .logo {
            width: 100%;
            /*max-width: 200px; /* Puedes ajustar el tamaño según lo necesites */
            display: block;
                margin: 0 auto 20px; /* Centrado y espacio abajo */
            height: auto; /* Mantiene las proporciones de la imagen */
            object-fit: contain; /* Ajusta la imagen para que se ajuste al contenedor sin distorsionarse */
        }
        .sponsors img {
            max-width: 100px;
            margin: 10px;
        }

        .footer-text {
            font-size: 0.9rem;
            font-family: 'Adventure Request', cursive; 
            text-align: center;
            color: #666;
        }

        /* Estilo de los inputs con el placeholder */
        input::placeholder {
            color: rgba(169, 169, 169, 0.5) !important;  /* Gris Claro*/
            font-size: 0.8rem; /* Reducir el tamaño de la fuente */
        }
    </style>
</head>
<body>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-header text-center">
                    <!-- Logo aquí -->
                    <img src="images/logoGamerFest1.png" alt="Logo de GamerFest2025" class="logo">
                </div>
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Registro</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" autocomplete="off">
                            @csrf
                            <!-- Usuario -->
                            <div class="mb-3">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Usuario" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <!-- Institución -->
                            <div class="mb-3">
                                <input type="text" name="institution" id="institution" class="form-control" placeholder="Institución" value="{{ old('institution') }}" required>
                                @error('institution')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <!-- Correo -->
                            <div class="mb-3">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Correo Electrónico" value="{{ old('email') }}" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <!-- Contraseña -->
                            <div class="mb-3">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" autocomplete="new-password" required>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <!-- Repetir Contraseña -->
                            <div class="mb-3">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Repetir Contraseña" required>
                            </div>
                            <!-- Botón -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Registrarse</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Sección de leyendas -->
                <div class="text-center mt-4">
                    <h5>Nuestros Patrocinadores</h5>
                    <div class="sponsors d-flex justify-content-center flex-wrap">
                        <img src="/images/sponsorFake1.png" alt="Patrocinador 1">
                        <img src="/images/sponsorFake2.png" alt="Patrocinador 2">
                        <img src="/images/sponsorFake3.png" alt="Patrocinador 3">
                    </div>
                </div>

                <!-- Derechos Reservados -->
                <div class="footer-text mt-3">
                    <p>© 2025 GamerFest. Todos los derechos reservados.</p>
                    <p><a href="#" class="text-decoration-none">Política de Privacidad</a> | <a href="#" class="text-decoration-none">Términos y Condiciones</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
