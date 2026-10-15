<?php
require_once dirname(__DIR__) . '/includes/funciones.php';

$titulo = 'Contacto';
require_once dirname(__DIR__) . '/includes/header.php';
?>

<section class="tarjeta">
    <h2>Formulario de contacto</h2>

    <form action="procesar.php" method="POST">
        <input type="hidden" name="csrf_token"
               value="<?= e(generarToken()) ?>">

        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre"
               maxlength="100" required>

        <label for="email">Correo electrónico</label>
        <input type="email" id="email" name="email"
               maxlength="150" required>

       <label for="asunto">Asunto</label>
       <input type="text" id="asunto" name="asunto" maxlength="150"
       value="<?= e($viejo['asunto'] ?? '') ?>" required>

        <label for="mensaje">Mensaje</label>
        <textarea id="mensaje" name="mensaje"
                  rows="5" required></textarea>

        <button type="submit">Enviar mensaje</button>
    </form>
</section>

<?php require_once dirname(__DIR__) . '/includes/footer.php'; ?>