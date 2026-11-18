<?php
declare(strict_types=1);

require_once __DIR__ . '/_bootstrap.php';

$titulo_pagina = 'Clase 5 - Procesamiento de Formularios';
$dashboardUrl = defined('APP_BASE_URL') && APP_BASE_URL !== ''
    ? rtrim(APP_BASE_URL, '/') . '/dashboard.php'
    : 'dashboard.php';

require_once __DIR__ . '/../includes/header.php';
?>
<div class="d-flex flex-column flex-lg-row min-vh-100 bg-light">
    <?php require_once __DIR__ . '/../includes/nav.php'; ?>
    <div class="flex-grow-1 p-4 overflow-auto">
<main class="container my-5">
    <h1>Procesamiento de Formularios y Seguridad Web</h1>
    <p>Este módulo corresponde al Trabajo Práctico N.º 5.</p>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title h5">Contacto / Consulta (POST)</h2>
                    <p class="card-text">Formulario de contacto para enviar una consulta institucional.</p>
                    <a class="btn btn-primary" href="<?= htmlspecialchars(c5_url('contacto.php'), ENT_QUOTES, 'UTF-8') ?>">Ir al formulario</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title h5">Buscador de materias (GET)</h2>
                    <p class="card-text">Formulario para consultar materias mediante filtros en la URL.</p>
                    <a class="btn btn-primary" href="<?= htmlspecialchars(c5_url('buscar.php'), ENT_QUOTES, 'UTF-8') ?>">Ir al buscador</a>
                </div>
            </div>
        </div>
    </div>

    <a class="btn btn-outline-secondary mt-4" href="<?= htmlspecialchars($dashboardUrl, ENT_QUOTES, 'UTF-8') ?>">Volver al dashboard</a>
</main>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
