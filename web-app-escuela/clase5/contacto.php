<?php
declare(strict_types=1);

require_once __DIR__ . '/_bootstrap.php';
require_once __DIR__ . '/_helpers.php';

$errores = [];
$datos = [
    'nombre' => '',
    'email' => '',
    'asunto' => '',
    'mensaje' => '',
];
$flash = c5_get_flash();

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $nombre = $_POST['nombre'] ?? null;
    $email = $_POST['email'] ?? null;
    $asunto = $_POST['asunto'] ?? null;
    $mensaje = $_POST['mensaje'] ?? null;

    $datos['nombre'] = c5_sanitizar_texto(is_string($nombre) ? $nombre : null);
    $datos['email'] = c5_sanitizar_email(is_string($email) ? $email : null);
    $datos['asunto'] = c5_sanitizar_texto(is_string($asunto) ? $asunto : null);
    $datos['mensaje'] = c5_sanitizar_texto(is_string($mensaje) ? $mensaje : null);

    if (empty($datos['nombre'])) {
        $errores['nombre'] = 'El nombre es obligatorio.';
    }

    if (empty($datos['email'])) {
        $errores['email'] = 'El email es obligatorio.';
    } elseif (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'El formato de email no es válido.';
    }

    if (empty($datos['asunto'])) {
        $errores['asunto'] = 'Seleccione un asunto.';
    }

    if (empty($datos['mensaje'])) {
        $errores['mensaje'] = 'El mensaje es obligatorio.';
    }

    if (empty($errores)) {
        c5_set_flash('success', '¡Consulta enviada con éxito! Nos comunicaremos a la brevedad.');
        header('Location: ' . c5_url('contacto.php'));
        exit;
    }
}

$titulo_pagina = 'Contacto - Clase 5';

require_once __DIR__ . '/../includes/header.php';
?>
<div class="d-flex flex-column flex-lg-row min-vh-100 bg-light">
    <?php require_once __DIR__ . '/../includes/nav.php'; ?>
    <div class="flex-grow-1 p-4 overflow-auto">
<main class="container my-5">
    <h1>Contacto / Consulta</h1>
    <p>Formulario POST. Todos los campos con asterisco son obligatorios.</p>

    <?php if (is_array($flash) && ($flash['tipo'] ?? '') === 'success' && is_string($flash['mensaje'] ?? null)): ?>
        <div class="alert alert-success" role="alert"><?= htmlspecialchars($flash['mensaje'], ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <?php if ($errores !== []): ?>
        <div class="alert alert-danger" role="alert">Corrija los errores debajo.</div>
    <?php endif; ?>

    <form method="post" action="<?= htmlspecialchars(c5_url('contacto.php'), ENT_QUOTES, 'UTF-8') ?>" novalidate class="row g-3">
        <div class="col-md-6">
            <label for="nombre" class="form-label">Nombre *</label>
            <input type="text" name="nombre" required class="form-control<?= isset($errores['nombre']) ? ' is-invalid' : '' ?>" id="nombre" value="<?= c5_repoblar('nombre', $datos) ?>">
            <?php if (isset($errores['nombre'])): ?>
                <div class="invalid-feedback"><?= htmlspecialchars($errores['nombre'], ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Email *</label>
            <input type="email" name="email" required class="form-control<?= isset($errores['email']) ? ' is-invalid' : '' ?>" id="email" value="<?= c5_repoblar('email', $datos) ?>">
            <?php if (isset($errores['email'])): ?>
                <div class="invalid-feedback"><?= htmlspecialchars($errores['email'], ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <label for="asunto" class="form-label">Asunto *</label>
            <select name="asunto" required class="form-select<?= isset($errores['asunto']) ? ' is-invalid' : '' ?>" id="asunto">
                <option value="" disabled<?= $datos['asunto'] === '' ? ' selected' : '' ?>>Seleccionar...</option>
                <option value="consulta_general"<?= $datos['asunto'] === 'consulta_general' ? ' selected' : '' ?>>Consulta general</option>
                <option value="admision"<?= $datos['asunto'] === 'admision' ? ' selected' : '' ?>>Admisión</option>
                <option value="documentacion"<?= $datos['asunto'] === 'documentacion' ? ' selected' : '' ?>>Documentación</option>
                <option value="otro"<?= $datos['asunto'] === 'otro' ? ' selected' : '' ?>>Otro</option>
            </select>
            <?php if (isset($errores['asunto'])): ?>
                <div class="invalid-feedback"><?= htmlspecialchars($errores['asunto'], ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>
        </div>
        <div class="col-12">
            <label for="mensaje" class="form-label">Mensaje *</label>
            <textarea name="mensaje" rows="5" required class="form-control<?= isset($errores['mensaje']) ? ' is-invalid' : '' ?>" id="mensaje" maxlength="1000"><?= c5_repoblar('mensaje', $datos) ?></textarea>
            <?php if (isset($errores['mensaje'])): ?>
                <div class="invalid-feedback"><?= htmlspecialchars($errores['mensaje'], ENT_QUOTES, 'UTF-8') ?></div>
            <?php endif; ?>
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
