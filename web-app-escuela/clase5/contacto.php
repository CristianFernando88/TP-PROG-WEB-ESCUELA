<?php
declare(strict_types=1);

require_once __DIR__ . '/_bootstrap.php';

$titulo_pagina = 'Contacto - Clase 5';

require_once __DIR__ . '/../includes/header.php';
?>
<div class="d-flex flex-column flex-lg-row min-vh-100 bg-light">
    <?php require_once __DIR__ . '/../includes/nav.php'; ?>
    <div class="flex-grow-1 p-4 overflow-auto">
<main class="container my-5">
    <h1>Contacto / Consulta</h1>
    <p>Formulario POST. Todos los campos con asterisco son obligatorios.</p>

    <form method="post" action="<?= htmlspecialchars(c5_url('contacto.php'), ENT_QUOTES, 'UTF-8') ?>" novalidate class="row g-3">
        <div class="col-md-6">
            <label for="nombre" class="form-label">Nombre *</label>
            <input type="text" name="nombre" required class="form-control" id="nombre">
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Email *</label>
            <input type="email" name="email" required class="form-control" id="email">
        </div>
        <div class="col-md-6">
            <label for="asunto" class="form-label">Asunto *</label>
            <select name="asunto" required class="form-select" id="asunto">
                <option value="" disabled selected>Seleccionar...</option>
                <option value="consulta_general">Consulta general</option>
                <option value="admision">Admisión</option>
                <option value="documentacion">Documentación</option>
                <option value="otro">Otro</option>
            </select>
        </div>
        <div class="col-12">
            <label for="mensaje" class="form-label">Mensaje *</label>
            <textarea name="mensaje" rows="5" required class="form-control" id="mensaje" maxlength="1000"></textarea>
        </div>
        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Enviar consulta</button>
            <a class="btn btn-outline-secondary" href="<?= htmlspecialchars(c5_url('index.php'), ENT_QUOTES, 'UTF-8') ?>">Volver</a>
        </div>
    </form>
</main>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
