<?php

require_once dirname(__DIR__) . '/includes/funciones.php';
require_once dirname(__DIR__) . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contacto.php');
    exit;
}

if (!verificarToken($_POST['csrf_token'] ?? null)) {
    http_response_code(403);
    exit('Formulario inválido. Vuelve a intentarlo.');
}

$nombre = trim($_POST['nombre'] ?? '');
$email = trim($_POST['email'] ?? '');
$mensaje = trim($_POST['mensaje'] ?? '');

if (
    $nombre === '' ||
    strlen($nombre) > 100 ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    strlen($email) > 150 ||
    $mensaje === ''
) {
    http_response_code(422);
    exit('Revisa los datos ingresados y vuelve a intentarlo.');
}

try {
    $pdo = conectarBD();

    $sql = 'INSERT INTO mensajes (nombre, email, mensaje)
            VALUES (:nombre, :email, :mensaje)';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nombre' => $nombre,
        ':email' => $email,
        ':mensaje' => $mensaje
    ]);

    unset($_SESSION['csrf_token']);

    header('Location: gracias.php');
    exit;

} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    exit('No se pudo guardar el mensaje. Revisa la conexión a la base de datos.');
}