<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
$currentUser = appRequireRoleAccess('hijos');
require_once __DIR__ . '/config/env.php';

$titulo_pagina = 'Mis Hijos - Colegio Horizonte';
$children = $currentUser['children'];

require_once __DIR__ . '/includes/header.php';
?>

<div class="d-flex flex-column flex-lg-row min-vh-100 bg-light">
    <?php require_once __DIR__ . '/includes/nav.php'; ?>

    <main class="flex-grow-1 p-4 overflow-auto">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 bg-white p-3 rounded-4 shadow-sm">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-success text-white fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                    <?= htmlspecialchars($currentUser['initials'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>
                </div>
                <div>
                    <span class="d-block fw-bold text-dark" style="font-size: 0.85rem; line-height: 1.1;"><?= htmlspecialchars($currentUser['name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                    <span class="d-block text-muted" style="font-size: 0.7rem;"><?= htmlspecialchars($currentUser['title'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                </div>
            </div>
            <a href="logout.php" class="btn btn-outline-success btn-sm d-flex align-items-center gap-2 ms-auto" aria-label="Cerrar sesión">
                <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
                <span>Cerrar sesión</span>
            </a>
        </div>

        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
            <div>
                <h1 class="fw-bold text-dark m-0">Mis Hijos</h1>
                <p class="text-muted m-0">Información académica de tus estudiantes vinculados.</p>
            </div>
            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-2">
                Datos de demostración
            </span>
        </div>

        <div class="row g-4">
            <?php foreach ($children as $child): ?>
                <div class="col-12 col-xl-6">
                    <article class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="bg-success-subtle text-success fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                                <?= htmlspecialchars($child['initials'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>
                            </div>
                            <div>
                                <h2 class="h5 fw-bold text-dark mb-1"><?= htmlspecialchars($child['name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></h2>
                                <span class="text-muted small"><?= htmlspecialchars($child['course'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-3 h-100">
                                    <span class="d-block text-muted small mb-1">Asistencia</span>
                                    <span class="fw-bold text-dark"><?= htmlspecialchars($child['attendance'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-light rounded-3 p-3 h-100">
                                    <span class="d-block text-muted small mb-1">Promedio</span>
                                    <span class="fw-bold text-dark"><?= htmlspecialchars($child['average'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-3 mt-auto">
                            <span class="text-muted small"><i class="bi bi-info-circle me-1" aria-hidden="true"></i><?= htmlspecialchars($child['updates'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
