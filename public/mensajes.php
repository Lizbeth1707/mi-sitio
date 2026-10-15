<?php

require_once dirname(__DIR__) . '/includes/funciones.php';
require_once dirname(__DIR__) . '/config/database.php';

try {
    $pdo = conectarBD();

    $sql = 'SELECT id, nombre, email, mensaje, creado_en
            FROM mensajes
            ORDER BY creado_en DESC
            LIMIT 20';

    $stmt = $pdo->query($sql);
    $mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    error_log($e->getMessage());
    exit('No se pudieron cargar los mensajes.');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de mensajes</title>
</head>
<body>

<h1>Mensajes recibidos</h1>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Mensaje</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($mensajes as $mensaje): ?>
            <tr>
                <td><?= e($mensaje['id']) ?></td>
                <td><?= e($mensaje['nombre']) ?></td>
                <td><?= e($mensaje['email']) ?></td>
                <td><?= e($mensaje['mensaje']) ?></td>
                <td><?= e($mensaje['creado_en']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
