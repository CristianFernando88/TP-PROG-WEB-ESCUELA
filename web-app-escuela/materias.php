<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/auth.php';
$currentUser = appRequireRoleAccess('materias');
require_once __DIR__ . '/config/env.php';

// Título dinámico SSR exigido por el TP4
$titulo_pagina = "Materias y Asignaciones - Colegio Horizonte";

// Inclusión del encabezado modular (SSI)
require_once __DIR__ . '/includes/header.php';
?>

<div class="d-flex min-vh-100 bg-light">
    
    <!-- 1. BARRA LATERAL (SSI) - Detecta automáticamente la página activa -->
    <?php require_once __DIR__ . '/includes/nav.php'; ?>

    <!-- 2. CONTENIDO PRINCIPAL DE MATERIAS Y ASIGNACIONES -->
    <div class="flex-grow-1 p-4 overflow-auto">
        
        <!-- Barra superior (Buscador y perfil de usuario) -->
        <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded-4 shadow-sm">
            <div class="input-group" style="max-width: 400px;">
                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control bg-light border-start-0" placeholder="Buscar alumno, curso o materia...">
                <span class="input-group-text bg-light text-muted small">⌘K</span>
            </div>
            <div class="d-flex align-items-center gap-3">
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
                        <span style="font-size: 0.85rem;">Materias activas</span>
                    </div>
                    <h2 class="fw-bold text-dark m-0" style="font-size: 1.8rem;">64</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-white">
                    <div class="d-flex align-items-center gap-2 mb-2 text-muted">
                        <div class="bg-light p-2 rounded-3 text-success"><i class="bi bi-mortarboard" style="font-size: 1.2rem;"></i></div>
                        <span style="font-size: 0.85rem;">Profesores titulares</span>
                    </div>
                    <h2 class="fw-bold text-dark m-0" style="font-size: 1.8rem;">78</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-white">
                    <div class="d-flex align-items-center gap-2 mb-2 text-muted">
                        <div class="bg-light p-2 rounded-3 text-warning"><i class="bi bi-clock" style="font-size: 1.2rem;"></i></div>
                        <span style="font-size: 0.85rem;">Sin asignar</span>
                    </div>
                    <h2 class="fw-bold text-dark m-0" style="font-size: 1.8rem;">3</h2>
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
                            <th class="border-0 pb-3">Materia</th>
                            <th class="border-0 pb-3">Nivel</th>
                            <th class="border-0 pb-3">Cursos asignados</th>
                            <th class="border-0 pb-3">Profesor titular</th>
                            <th class="border-0 pb-3">Carga horaria</th>
                            <th class="border-0 pb-3 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Materia 1 -->
                        <tr class="border-bottom">
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light text-success p-2 rounded-3"><i class="bi bi-book"></i></div>
                                    <span class="fw-bold text-dark" style="font-size: 0.9rem;">Matemática</span>
                                </div>
                            </td>
                            <td><span class="badge bg-light text-secondary border px-3 py-1 rounded-pill fw-medium" style="font-size: 0.75rem;">Secundario</span></td>
                            <td><span class="text-dark fw-semibold" style="font-size: 0.85rem;">1.º A, 1.º B, 2.º A</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-light text-success fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 0.75rem;">FG</div>
                                    <span class="fw-semibold text-dark" style="font-size: 0.85rem;">Federico Gómez</span>
                                </div>
                            </td>
                            <td class="text-muted" style="font-size: 0.85rem;">6 h semanales</td>
                            <td class="text-end text-muted"><i class="bi bi-three-dots-vertical cursor-pointer"></i></td>
                        </tr>

                        <!-- Materia 2 -->
                        <tr class="border-bottom">
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light text-success p-2 rounded-3"><i class="bi bi-book"></i></div>
                                    <span class="fw-bold text-dark" style="font-size: 0.9rem;">Biología</span>
                                </div>
                            </td>
                            <td><span class="badge bg-light text-secondary border px-3 py-1 rounded-pill fw-medium" style="font-size: 0.75rem;">Secundario</span></td>
                            <td><span class="text-dark fw-semibold" style="font-size: 0.85rem;">2.º A, 3.º A, 4.º B</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-light text-success fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 0.75rem;">MR</div>
                                    <span class="fw-semibold text-dark" style="font-size: 0.85rem;">Martín Ríos</span>
                                </div>
                            </td>
                            <td class="text-muted" style="font-size: 0.85rem;">4 h semanales</td>
                            <td class="text-end text-muted"><i class="bi bi-three-dots-vertical cursor-pointer"></i></td>
                        </tr>

                        <!-- Materia 3 -->
                        <tr class="border-bottom">
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light text-success p-2 rounded-3"><i class="bi bi-book"></i></div>
                                    <span class="fw-bold text-dark" style="font-size: 0.9rem;">Lengua y Literatura</span>
                                </div>
                            </td>
                            <td><span class="badge bg-light text-secondary border px-3 py-1 rounded-pill fw-medium" style="font-size: 0.75rem;">Secundario</span></td>
                            <td><span class="text-dark fw-semibold" style="font-size: 0.85rem;">1.º A, 2.º B, 5.º A</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-light text-success fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 0.75rem;">CV</div>
                                    <span class="fw-semibold text-dark" style="font-size: 0.85rem;">Carolina Vega</span>
                                </div>
                            </td>
                            <td class="text-muted" style="font-size: 0.85rem;">5 h semanales</td>
                            <td class="text-end text-muted"><i class="bi bi-three-dots-vertical cursor-pointer"></i></td>
                        </tr>

                        <!-- Materia 4 -->
                        <tr class="border-bottom">
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light text-success p-2 rounded-3"><i class="bi bi-book"></i></div>
                                    <span class="fw-bold text-dark" style="font-size: 0.9rem;">Ciencias Naturales</span>
                                </div>
                            </td>
                            <td><span class="badge bg-light text-secondary border px-3 py-1 rounded-pill fw-medium" style="font-size: 0.75rem;">Primario</span></td>
                            <td><span class="text-dark fw-semibold" style="font-size: 0.85rem;">4.º A, 4.º B, 5.º A</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-light text-success fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 0.75rem;">PA</div>
                                    <span class="fw-semibold text-dark" style="font-size: 0.85rem;">Paula Acosta</span>
                                </div>
                            </td>
                            <td class="text-muted" style="font-size: 0.85rem;">3 h semanales</td>
                            <td class="text-end text-muted"><i class="bi bi-three-dots-vertical cursor-pointer"></i></td>
                        </tr>

                        <!-- Materia 5 -->
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light text-success p-2 rounded-3"><i class="bi bi-book"></i></div>
                                    <span class="fw-bold text-dark" style="font-size: 0.9rem;">Inglés</span>
                                </div>
                            </td>
                            <td><span class="badge bg-light text-secondary border px-3 py-1 rounded-pill fw-medium" style="font-size: 0.75rem;">Todos los niveles</span></td>
                            <td><span class="text-dark fw-semibold" style="font-size: 0.85rem;">12 cursos</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-light text-success fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 0.75rem;">EI</div>
                                    <span class="fw-semibold text-dark" style="font-size: 0.85rem;">Equipo de idiomas</span>
                                </div>
                            </td>
                            <td class="text-muted" style="font-size: 0.85rem;">4 h semanales</td>
                            <td class="text-end text-muted"><i class="bi bi-three-dots-vertical cursor-pointer"></i></td>
                        </tr>
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