<?php

require_once __DIR__ . '/env.php';

function conectarBD(): PDO
{
    $host = env('DB_HOST', '127.0.0.1');
    $puerto = env('DB_PORT', '5432');
    $baseDatos = env('DB_NAME', 'sitio_db');
    $usuario = env('DB_USER', 'sitio_user');
    $clave = env('DB_PASS');

    $dsn = "pgsql:host=$host;port=$puerto;dbname=$baseDatos";

    return new PDO($dsn, $usuario, $clave, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
}