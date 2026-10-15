<?php
require_once dirname(__DIR__) . '/includes/funciones.php';

$titulo = 'Inicio';
require_once dirname(__DIR__) . '/includes/header.php';
?>

<section class="tarjeta">
    <h2>Bienvenido a Mi Sitio</h2>
    <p>Este sitio utiliza PHP y PostgreSQL para guardar los mensajes de contacto.</p>
    <a class="boton" href="contacto.php">Enviar un mensaje</a>
</section>

<?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>