<?php

declare(strict_types=1);

require_once 'flight/Flight.php';
// require 'flight/autoload.php';

Flight::register('db', 'PDO', array('mysql::host=localhost;dbname=db_gamerfest2025', 'root', ''));

Flight::route('GET /games', function () {
    $sentencia= Flight::db()->prepare("SELECT * FROM `games`");
    $sentencia->execute();
    $datos=$sentencia->fetchAll();
    flight::json($datos);
});

Flight::start();
