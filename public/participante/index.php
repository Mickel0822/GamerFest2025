<?php

declare(strict_types=1);

require_once 'flight/Flight.php';

// Configuración de la conexión a la base de datos (puerto ajustable)
Flight::register('db', 'PDO', array('mysql:host=localhost;port=3307;dbname=db_gamerfest2025;charset=utf8', 'root', ''));

/**
 * Middleware para manejar errores en Flight
 */
Flight::map('error', function (Throwable $ex) {
    Flight::json([
        "error" => $ex->getMessage(),
        "code" => $ex->getCode()
    ], 500); // Devuelve error 500
});

/**
 * Obtener todos los usuarios
 */
Flight::route('GET /users', function () {
    try {
        $query = Flight::db()->prepare("SELECT * FROM users");
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_ASSOC);

        // Enviar respuesta JSON
        Flight::json($users);
    } catch (PDOException $e) {
        Flight::json(["error" => "Error al obtener usuarios: " . $e->getMessage()], 500);
    }
});

/**
 * Obtener un usuario por email
 */
Flight::route('GET /users/@email', function ($email) {
    try {
        $query = Flight::db()->prepare("SELECT * FROM users WHERE email = :email");
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            Flight::json($user);
        } else {
            Flight::json(["message" => "Usuario no encontrado"], 404);
        }
    } catch (PDOException $e) {
        Flight::json(["error" => "Error al obtener el usuario: " . $e->getMessage()], 500);
    }
});

// Iniciar la aplicación Flight
Flight::start();
