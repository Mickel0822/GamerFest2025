<?php

declare(strict_types=1);

require_once 'flight/Flight.php';

// Configuración de la conexión a la base de datos
Flight::register('db', 'PDO', array('mysql::host=localhost;dbname=u808897717_gamerfest25', 'u808897717_gamer', 'GamerFest2025*'));

/**
 * Middleware para manejar errores globales en Flight
 */
Flight::map('error', function (Throwable $ex) {
    Flight::json([
        "error" => $ex->getMessage(),
        "code" => $ex->getCode()
    ], 500);
});

/**
 * Obtener todas las inscripciones con el nombre y correo del usuario y el nombre del juego
 */
Flight::route('GET /inscriptions', function () {
    try {
        $query = Flight::db()->prepare("
            SELECT i.id,
                   u.name AS participant_name,
                   u.email AS participant_email,
                   g.name AS game_name,
                   i.cost,
                   i.status,
                   i.team_name,
                   i.payment_method,
                   i.payment_receipt,
                   i.round,
                   i.created_at
            FROM inscriptions i
            JOIN users u ON i.user_id = u.id
            JOIN games g ON i.game_id = g.id
        ");
        $query->execute();
        $inscriptions = $query->fetchAll(PDO::FETCH_ASSOC);

        Flight::json($inscriptions);
    } catch (PDOException $e) {
        Flight::json(["error" => "Error al obtener inscripciones: " . $e->getMessage()], 500);
    }
});

/**
 * Obtener inscripciones por correo del participante
 */
Flight::route('GET /inscriptions/@email', function ($email) {
    try {
        $query = Flight::db()->prepare("
            SELECT i.id,
                   u.name AS participant_name,
                   u.email AS participant_email,
                   g.name AS game_name,
                   i.cost,
                   i.status,
                   i.team_name,
                   i.payment_method,
                   i.payment_receipt,
                   i.round,
                   i.created_at
            FROM inscriptions i
            JOIN users u ON i.user_id = u.id
            JOIN games g ON i.game_id = g.id
            WHERE u.email = :email
        ");
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $inscriptions = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($inscriptions) {
            Flight::json($inscriptions);
        } else {
            Flight::json(["message" => "No se encontraron inscripciones para este correo"], 404);
        }
    } catch (PDOException $e) {
        Flight::json(["error" => "Error al obtener la inscripción: " . $e->getMessage()], 500);
    }
});

// Iniciar la API de Flight
Flight::start();
