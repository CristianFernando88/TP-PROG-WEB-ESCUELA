<?php
declare(strict_types=1);

$requerirPermiso = 'dashboard';
require_once __DIR__ . '/auth_guard.php';
require_once __DIR__ . '/config/env.php';

$titulo_pagina = 'Inicio - Panel de Gestión | Colegio Horizonte';
$dashboardData = $currentUser;
$hour = (int) date('G');
$greeting = $hour < 12 ? 'Buen día' : ($hour < 19 ? 'Buenas tardes' : 'Buenas noches');
require_once __DIR__ . '/includes/header.php';
?>

<div class="d-flex flex-column flex-lg-row min-vh-100 bg-light">
    
    <!-- 1. BARRA LATERAL (SSI) -->
    <?php require_once __DIR__ . '/includes/nav.php'; ?>

    <!-- 2. CONTENIDO PRINCIPAL DEL DASHBOARD -->
    <div class="flex-grow-1 p-4 overflow-auto">
        
        <!-- Barra superior (Header superior con buscador y perfil de usuario) -->
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 bg-white p-3 rounded-4 shadow-sm">
            <div class="input-group flex-grow-1" style="max-width: 400px;">
                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control bg-light border-start-0" placeholder="Buscar alumno, curso o materia...">
                <span class="input-group-text bg-light text-muted small">⌘K</span>
            </div>
            <div class="d-flex align-items-center justify-content-end gap-2 ms-auto">
                <button class="btn btn-light position-relative rounded-circle p-2" style="width: 40px; height: 40px;">
                    <i class="bi bi-bell"></i>
                </button>
                <div class="d-flex align-items-center gap-2 border-start ps-3">
                    <div class="bg-success text-white fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                        <?= htmlspecialchars($currentUser['initials'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>
                    </div>
                    <div class="text-start">
                        <span class="d-block fw-bold text-dark" style="font-size: 0.85rem; line-height: 1.1;"><?= htmlspecialchars($currentUser['name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                        <span class="d-block text-muted" style="font-size: 0.7rem;"><?= htmlspecialchars($currentUser['title'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                    </div>
                    <i class="bi bi-chevron-down text-muted small ms-1"></i>
                </div>
                <a href="logout.php" class="btn btn-outline-success btn-sm d-flex align-items-center gap-2" aria-label="Cerrar sesión">
                    <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
                    <span class="d-none d-sm-inline">Cerrar sesión</span>
                </a>
            </div>
        </div>

        <!-- Bienvenida y botón de acción principal -->
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <span class="text-muted fw-semibold" style="font-size: 0.85rem;"><?= htmlspecialchars(date('d/m/Y'), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                <h1 class="fw-bold text-dark m-0" style="font-size: 2rem;"><?= htmlspecialchars($greeting, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>, <?= htmlspecialchars(explode(' ', $currentUser['name'])[0], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></h1>
                <p class="text-muted m-0" style="font-size: 0.9rem;"><?= htmlspecialchars($dashboardData['summary'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></p>
            </div>
            <?php if (is_array($dashboardData['primary_action']) && appHasPermission($currentUser, $dashboardData['primary_action']['permission'])): ?>
                <a href="<?= htmlspecialchars($dashboardData['primary_action']['href'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" class="btn text-white px-4 py-2 rounded-3 fw-semibold shadow-sm d-flex align-items-center gap-2" style="background-color: #2D5A3F;">
                    <i class="bi bi-arrow-right-circle"></i> <?= htmlspecialchars($dashboardData['primary_action']['label'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>
                </a>
            <?php endif; ?>
        </div>

        <p class="text-muted small mb-2">Indicadores de demostración según tu perfil.</p>
        <div class="row g-3 mb-4">
            <?php foreach ($dashboardData['metrics'] as $metric): ?>
                <div class="col-md-<?= count($dashboardData['metrics']) === 4 ? '3' : '4'; ?>">
                    <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-white">
                        <div class="d-flex align-items-center gap-2 mb-2 text-muted">
                            <div class="bg-light p-2 rounded-3 text-success">
                                <i class="bi <?= htmlspecialchars($metric['icon'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" style="font-size: 1.2rem;"></i>
                            </div>
                            <span style="font-size: 0.85rem;"><?= htmlspecialchars($metric['label'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                        </div>
                        <h2 class="fw-bold text-dark m-0" style="font-size: 1.8rem;"><?= htmlspecialchars($metric['value'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></h2>
                        <span class="text-success small mt-1"><?= htmlspecialchars($metric['note'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Sección inferior: Actividad Reciente y Accesos Rápidos -->
        <div class="row g-4">
            
            <!-- Columna izquierda: Actividad reciente -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="fw-bold text-dark m-0"><?= htmlspecialchars($dashboardData['activity_title'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></h5>
                            <span class="text-muted small"><?= htmlspecialchars($dashboardData['activity_description'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                        </div>
                    </div>
                    
                    <div class="d-flex flex-column gap-3">
                        <?php foreach ($dashboardData['activity'] as $index => $activity): ?>
                            <div class="d-flex align-items-center justify-content-between p-2<?= $index < count($dashboardData['activity']) - 1 ? ' border-bottom' : ''; ?>">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light text-success fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-size: 0.85rem;"><?= htmlspecialchars($activity['initials'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></div>
                                <div>
                                    <span class="d-block fw-semibold text-dark" style="font-size: 0.9rem;"><?= htmlspecialchars($activity['title'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                                    <span class="text-muted" style="font-size: 0.75rem;"><?= htmlspecialchars($activity['context'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                                </div>
                            </div>
                            <span class="text-muted small"><?= htmlspecialchars($activity['time'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Columna derecha: Accesos rápidos -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                    <div class="mb-3">
                        <h5 class="fw-bold text-dark m-0">Accesos rápidos</h5>
                        <span class="text-muted small">Tareas frecuentes</span>
                    </div>

                    <div class="d-flex flex-column gap-2">
                        <?php foreach ($dashboardData['quick_links'] as $quickLink): ?>
                            <?php if (!appHasPermission($currentUser, $quickLink['permission'])) { continue; } ?>
                            <a href="<?= htmlspecialchars($quickLink['href'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" class="d-flex align-items-center justify-content-between p-3 rounded-3 bg-light text-decoration-none text-dark transition hover-bg">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-white p-2 rounded-2 text-success shadow-sm"><i class="bi <?= htmlspecialchars($quickLink['icon'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>"></i></div>
                                    <div>
                                        <span class="d-block fw-semibold" style="font-size: 0.9rem;"><?= htmlspecialchars($quickLink['title'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                                        <span class="text-muted" style="font-size: 0.7rem;"><?= htmlspecialchars($quickLink['description'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right text-muted small"></i>
                            </a>
                        <?php endforeach; ?>
                        <?php if ($dashboardData['quick_links'] === []): ?>
                            <p class="text-muted small mb-0">No hay accesos rápidos disponibles para este perfil.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<?php 
// Inclusión del pie de página modular (SSI)
require_once __DIR__ . '/includes/footer.php'; 
?>