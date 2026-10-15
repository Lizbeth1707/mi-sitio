
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

// Honeypot: si está rellenado, no guardar el mensaje
$web = trim((string) ($_POST['web'] ?? ''));

if ($web !== '') {
    header('Location: gracias.php');
    exit;
}

$nombre  = trim((string) ($_POST['nombre'] ?? ''));
$email   = trim((string) ($_POST['email'] ?? ''));
$asunto  = trim((string) ($_POST['asunto'] ?? ''));
$mensaje = trim((string) ($_POST['mensaje'] ?? ''));

if (
    $nombre === '' ||
    mb_strlen($nombre) > 100 ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    mb_strlen($email) > 150 ||
    $asunto === '' ||
    mb_strlen($asunto) > 150 ||
    $mensaje === ''
) {
    http_response_code(422);
    exit('Revisa los datos ingresados y vuelve a intentarlo.');
}

// Limitar a 3 envíos cada 10 minutos por sesión
$ahora = time();

if (!isset($_SESSION['envios_contacto'])) {
    $_SESSION['envios_contacto'] = [];
}

// Conservar solo los envíos de los últimos 10 minutos
$_SESSION['envios_contacto'] = array_filter(
    $_SESSION['envios_contacto'],
    function ($tiempo) use ($ahora) {
        return $tiempo > $ahora - 600;
    }
);

if (count($_SESSION['envios_contacto']) >= 3) {
    http_response_code(429);
    exit('Has enviado demasiados mensajes; espera unos minutos');
}

try {
    $pdo = conectarBD();

    $sql = 'INSERT INTO mensajes (nombre, email, asunto, mensaje)
            VALUES (:nombre, :email, :asunto, :mensaje)';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nombre'  => $nombre,
        ':email'   => $email,
        ':asunto'  => $asunto,
        ':mensaje' => $mensaje
    ]);

    // Contar el envío solo después de guardarlo correctamente
    $_SESSION['envios_contacto'][] = $ahora;

    unset($_SESSION['csrf_token']);

    header('Location: gracias.php');
    exit;

} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    exit('No se pudo guardar el mensaje. Revisa la conexión a la base de datos.');
}
