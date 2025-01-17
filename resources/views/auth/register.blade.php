<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | GamerFest2025</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/LOGO.png') }}" type="image/png">

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

        .card{
            position: relative; /* Para que los elementos dentro no se vean afectados */
            background-color:rgb(234, 244, 255)!important; /* Fondo blanco con opacidad del 80% */
            padding: 20px!important;
            border-radius: 8px!important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            color:rgb(0, 39, 78) !important;
        }

        /* Hover sobre los botones */
        .form button:hover {
            box-shadow: 0 0 15px 5px rgba(0, 1, 2, 0.8) !important; /* Haz de luz azul */
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

        #form input {
            font-size: 0.1rem;
        }

    </style>
</head>
<body>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" autocomplete="off">
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
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <!-- Usuario -->
                            <div class="mb-3">
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Apellido" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <!-- Universidad -->
                            <div class="mb-3">
                                <label for="university" class="form-label">Universidad</label>
                                <select name="university" id="university" class="form-control" required>
                                    <option value="" disabled selected>Seleccione su universidad</option>
                                    <option value="Universidad Técnica de Cotopaxi">Universidad Técnica de Cotopaxi</option>
                                    <option value="Universidad Técnica Particular de Loja">Universidad Técnica Particular de Loja</option>
                                    <option value="Universidad Estatal de Bolívar">Universidad Estatal de Bolívar</option>
                                    <option value="Universidad de las Fuerzas Armadas ESPE Latacunga">Universidad de las Fuerzas Armadas ESPE Latacunga</option>
                                    <option value="Universidad Politécnica Salesiana">Universidad Politécnica Salesiana</option>
                                    <!-- Agrega más universidades si es necesario -->
                                </select>
                                @error('university')
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
                            <!-- Imagen de Perfil -->
                            <div class="mb-3">
                                <label for="profile_photo" class="form-label">Foto de Perfil (Opcional)</label>
                                <input type="file" name="profile_photo" id="profile_photo" class="form-control" accept="image/*">
                                @error('profile_photo')
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
               

                <!-- Derechos Reservados -->
                <div class="footer-text mt-3">
                    <p>© 2025 GamerFest. Todos los derechos reservados.</p>
                    <p><a href="#" class="text-decoration-none">Política de Privacidad</a> | <a href="#" class="text-decoration-none">Términos y Condiciones</a></p>
                </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>
