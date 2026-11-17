<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
$currentUser = appRequireRoleAccess('materias');
require_once __DIR__ . '/config/env.php';

// Título dinámico SSR exigido por el TP4
$titulo_pagina = "Materias y Asignaciones - Colegio Horizonte";

$allCatedras = [
    ['subject' => 'Matemática', 'level' => 'Secundario', 'course' => '1.º A', 'teacher' => 'Federico Gómez', 'initials' => 'FG', 'hours' => 6],
    ['subject' => 'Matemática', 'level' => 'Secundario', 'course' => '1.º B', 'teacher' => 'Federico Gómez', 'initials' => 'FG', 'hours' => 6],
    ['subject' => 'Matemática', 'level' => 'Secundario', 'course' => '2.º A', 'teacher' => 'Federico Gómez', 'initials' => 'FG', 'hours' => 6],
    ['subject' => 'Biología', 'level' => 'Secundario', 'course' => '2.º A', 'teacher' => 'Martín Ríos', 'initials' => 'MR', 'hours' => 4],
    ['subject' => 'Biología', 'level' => 'Secundario', 'course' => '3.º A', 'teacher' => 'Martín Ríos', 'initials' => 'MR', 'hours' => 4],
    ['subject' => 'Lengua y Literatura', 'level' => 'Secundario', 'course' => '1.º A', 'teacher' => 'Carolina Vega', 'initials' => 'CV', 'hours' => 5],
    ['subject' => 'Lengua y Literatura', 'level' => 'Secundario', 'course' => '2.º B', 'teacher' => 'Carolina Vega', 'initials' => 'CV', 'hours' => 5],
    ['subject' => 'Ciencias Naturales', 'level' => 'Primario', 'course' => '4.º A', 'teacher' => 'Paula Acosta', 'initials' => 'PA', 'hours' => 3],
    ['subject' => 'Ciencias Naturales', 'level' => 'Primario', 'course' => '5.º A', 'teacher' => 'Paula Acosta', 'initials' => 'PA', 'hours' => 3],
    ['subject' => 'Inglés', 'level' => 'Todos los niveles', 'course' => '1.º A', 'teacher' => 'Equipo de idiomas', 'initials' => 'EI', 'hours' => 4],
    ['subject' => 'Inglés', 'level' => 'Todos los niveles', 'course' => '1.º B', 'teacher' => 'Equipo de idiomas', 'initials' => 'EI', 'hours' => 4],
    ['subject' => 'Inglés', 'level' => 'Todos los niveles', 'course' => '2.º A', 'teacher' => 'Equipo de idiomas', 'initials' => 'EI', 'hours' => 4],
    ['subject' => 'Historia', 'level' => 'Secundario', 'course' => '4.º B', 'teacher' => '', 'initials' => '', 'hours' => 3],
    ['subject' => 'Física', 'level' => 'Secundario', 'course' => '5.º A', 'teacher' => '', 'initials' => '', 'hours' => 4],
    ['subject' => 'Tecnología', 'level' => 'Primario', 'course' => '2.º B', 'teacher' => '', 'initials' => '', 'hours' => 2],
];

if ($currentUser['role'] === 'profesor') {
    $allCatedras = array_values(array_filter(
        $allCatedras,
        static fn (array $catedra): bool => $catedra['teacher'] === $currentUser['name']
    ));
}

$assignedTeachers = array_unique(array_filter(array_column($allCatedras, 'teacher')));
$unassignedCatedras = count(array_filter(
    $allCatedras,
    static fn (array $catedra): bool => $catedra['teacher'] === ''
));

// Inclusión del encabezado modular (SSI)
require_once __DIR__ . '/includes/header.php';
?>

<div class="d-flex flex-column flex-lg-row min-vh-100 bg-light">
    
    <!-- 1. BARRA LATERAL (SSI) - Detecta automáticamente la página activa -->
    <?php require_once __DIR__ . '/includes/nav.php'; ?>

    <!-- 2. CONTENIDO PRINCIPAL DE MATERIAS Y ASIGNACIONES -->
    <div class="flex-grow-1 p-4 overflow-auto">
        
        <!-- Barra superior (Buscador y perfil de usuario) -->
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

        <!-- Título de la sección y botón de Nueva asignación -->
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h1 class="fw-bold text-dark m-0" style="font-size: 2rem;">Materias y asignaciones</h1>
                <p class="text-muted m-0" style="font-size: 0.9rem;">Creá materias y vinculalas con cursos y profesores.</p>
            </div>
            <button class="btn text-white px-4 py-2 rounded-3 fw-semibold shadow-sm d-flex align-items-center gap-2" style="background-color: #2D5A3F;">
                <i class="bi bi-plus-lg"></i> Nueva asignación
            </button>
        </div>

        <!-- Tarjetas de Métricas Superiores -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-white">
                    <div class="d-flex align-items-center gap-2 mb-2 text-muted">
                        <div class="bg-light p-2 rounded-3 text-success"><i class="bi bi-book" style="font-size: 1.2rem;"></i></div>
                        <span style="font-size: 0.85rem;">Cátedras activas</span>
                    </div>
                    <h2 class="fw-bold text-dark m-0" style="font-size: 1.8rem;"><?= count($allCatedras); ?></h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-white">
                    <div class="d-flex align-items-center gap-2 mb-2 text-muted">
                        <div class="bg-light p-2 rounded-3 text-success"><i class="bi bi-mortarboard" style="font-size: 1.2rem;"></i></div>
                        <span style="font-size: 0.85rem;">Profesores titulares</span>
                    </div>
                    <h2 class="fw-bold text-dark m-0" style="font-size: 1.8rem;"><?= count($assignedTeachers); ?></h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-white">
                    <div class="d-flex align-items-center gap-2 mb-2 text-muted">
                        <div class="bg-light p-2 rounded-3 text-warning"><i class="bi bi-clock" style="font-size: 1.2rem;"></i></div>
                        <span style="font-size: 0.85rem;">Sin asignar</span>
                    </div>
                    <h2 class="fw-bold text-dark m-0" style="font-size: 1.8rem;"><?= $unassignedCatedras; ?></h2>
                </div>
            </div>
        </div>

        <!-- Tarjeta principal contenedora de filtros y la tabla -->
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            
            <!-- Barra de Filtros y Búsqueda -->
            <div class="row g-3 mb-4 align-items-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control bg-light border-start-0 py-2" placeholder="Buscar materia o profesor...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select bg-light py-2 text-secondary">
                        <option selected>Todos los niveles</option>
                        <option value="inicial">Nivel Inicial</option>
                        <option value="primario">Nivel Primario</option>
                        <option value="secundario">Nivel Secundario</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select bg-light py-2 text-secondary">
                        <option selected>Todos los cursos</option>
                        <option value="1a">1.º A</option>
                        <option value="1b">1.º B</option>
                        <option value="2a">2.º A</option>
                    </select>
                </div>
            </div>

            <!-- Tabla de Materias y Asignaciones -->
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr class="text-muted text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                            <th class="border-0 pb-3">Cátedra</th>
                            <th class="border-0 pb-3">Nivel</th>
                            <th class="border-0 pb-3">Profesor titular</th>
                            <th class="border-0 pb-3">Carga horaria</th>
                            <th class="border-0 pb-3 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allCatedras as $index => $catedra): ?>
                            <tr<?= $index < count($allCatedras) - 1 ? ' class="border-bottom"' : ''; ?>>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-light text-success p-2 rounded-3"><i class="bi bi-book" aria-hidden="true"></i></div>
                                        <span class="fw-bold text-dark" style="font-size: 0.9rem;">
                                            <?= htmlspecialchars($catedra['subject'] . ' - ' . $catedra['course'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>
                                        </span>
                                    </div>
                                </td>
                                <td><span class="badge bg-light text-secondary border px-3 py-1 rounded-pill fw-medium" style="font-size: 0.75rem;"><?= htmlspecialchars($catedra['level'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span></td>
                                <td>
                                    <?php if ($catedra['teacher'] !== ''): ?>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="bg-light text-success fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 0.75rem;"><?= htmlspecialchars($catedra['initials'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></div>
                                            <span class="fw-semibold text-dark" style="font-size: 0.85rem;"><?= htmlspecialchars($catedra['teacher'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted small">Sin asignar</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-muted" style="font-size: 0.85rem;"><?= $catedra['hours']; ?> h semanales</td>
                                <td class="text-end text-muted"><i class="bi bi-three-dots-vertical cursor-pointer" aria-hidden="true"></i></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</div>

<?php 
// Inclusión del pie de página modular (SSI)
require_once __DIR__ . '/includes/footer.php'; 
?>