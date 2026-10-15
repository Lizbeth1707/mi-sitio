<?php
$titulo = $titulo ?? 'Mi Sitio';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titulo) ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="cabecera">
    <h1>Mi Sitio</h1>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="contacto.php">Contacto</a>
    </nav>
</header>
<main class="contenedor"></main>