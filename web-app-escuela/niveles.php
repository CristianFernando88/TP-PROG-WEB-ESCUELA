<?php
declare(strict_types=1);

$requerirPermiso = 'niveles';
require_once __DIR__ . '/auth_guard.php';
require_once __DIR__ . '/config/env.php';

// Título dinámico SSR exigido por el TP4
$titulo_pagina = "Niveles y Cursos - Colegio Horizonte";

// Inclusión del encabezado modular (SSI)
require_once __DIR__ . '/includes/header.php';
?>

<div class="d-flex flex-column flex-lg-row min-vh-100 bg-light">
    
    <!-- 1. BARRA LATERAL (SSI) - Aquí se marcará "Niveles y cursos" como activo automáticamente -->
    <?php require_once __DIR__ . '/includes/nav.php'; ?>

    <!-- 2. CONTENIDO PRINCIPAL DE NIVELES Y CURSOS -->
    <div class="flex-grow-1 p-4 overflow-auto">
        
        <!-- Barra superior (Header superior con buscador y perfil) -->
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

        <!-- Título de la sección y botón de acción -->
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h1 class="fw-bold text-dark m-0" style="font-size: 2rem;">Niveles, cursos y aulas</h1>
                <p class="text-muted m-0" style="font-size: 0.9rem;">Organizá la estructura académica del colegio.</p>
            </div>
            <button class="btn text-white px-4 py-2 rounded-3 fw-semibold shadow-sm d-flex align-items-center gap-2" style="background-color: #2D5A3F;">
                <i class="bi bi-plus-lg"></i> Nuevo curso
            </button>
        </div>

        <!-- Contenido principal a dos columnas: Selector de Niveles (Izq) y Detalle de Cursos (Der) -->
        <div class="row g-4">
            
            <!-- Columna Izquierda: Tarjetas de Niveles y Capacidad Institucional -->
            <div class="col-lg-4 d-flex flex-column gap-3">
                
                <!-- Nivel Inicial -->
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white text-dark cursor-pointer transition hover-shadow">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-3 rounded-3 text-secondary" style="background-color: #F4F6F4;">
                                <i class="bi bi-layers" style="font-size: 1.4rem;"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold m-0" style="font-size: 1rem;">Nivel Inicial</h5>
                                <span class="text-muted" style="font-size: 0.75rem;">Salas de 3, 4 y 5 años</span>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="d-block fw-bold fs-5">8</span>
                            <span class="text-muted" style="font-size: 0.7rem;">cursos</span>
                        </div>
                    </div>
                </div>

                <!-- Nivel Primario (Activo / Seleccionado) -->
                <div class="card border-0 shadow-sm rounded-4 p-3 text-dark position-relative border-success border-2" style="background-color: #F3F8F5;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-success text-white p-3 rounded-3">
                                <i class="bi bi-layers" style="font-size: 1.4rem;"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-success m-0" style="font-size: 1rem;">Nivel Primario</h5>
                                <span class="text-muted" style="font-size: 0.75rem;">1.º a 6.º grado</span>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="d-block fw-bold fs-5 text-success">18</span>
                            <span class="text-muted" style="font-size: 0.7rem;">cursos</span>
                        </div>
                    </div>
                </div>

                <!-- Nivel Secundario -->
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-white text-dark cursor-pointer transition hover-shadow">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-3 rounded-3 text-secondary" style="background-color: #F4F6F4;">
                                <i class="bi bi-layers" style="font-size: 1.4rem;"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold m-0" style="font-size: 1rem;">Nivel Secundario</h5>
                                <span class="text-muted" style="font-size: 0.75rem;">1.º a 5.º año</span>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="d-block fw-bold fs-5">16</span>
                            <span class="text-muted" style="font-size: 0.7rem;">cursos</span>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta de Capacidad Institucional -->
                <div class="card border-0 shadow-sm rounded-4 p-4 text-white mt-2" style="background-color: #1A3024;">
                    <span class="text-uppercase fw-semibold text-success-emphasis mb-1" style="font-size: 0.7rem; letter-spacing: 0.5px;">Capacidad institucional</span>
                    <div class="d-flex align-baseline gap-2 mb-3">
                        <h2 class="fw-bold m-0" style="font-size: 2rem;">1.156</h2>
                        <span class="text-muted small">/ 1.320 alumnos</span>
                    </div>
                    <!-- Barra de progreso -->
                    <div class="progress rounded-pill mb-2" style="height: 6px; background-color: rgba(255,255,255,0.2);">
                        <div class="progress-bar bg-success rounded-pill" role="progressbar" style="width: 87%;" aria-valuenow="87" aria-valuemin="0" aria-valuemorax="100"></div>
                    </div>
                    <span class="text-muted" style="font-size: 0.75rem;">87% de ocupación total</span>
                </div>

            </div>

            <!-- Columna Derecha: Detalle de Cursos del Nivel Seleccionado (Tabla) -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                    
                    <!-- Encabezado de la tabla -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="fw-bold text-dark m-0">Nivel Primario</h4>
                            <span class="text-muted small">18 cursos • Ciclo lectivo 2025</span>
                        </div>
                        <button class="btn btn-light border rounded-circle p-2" style="width: 36px; height: 36px;"><i class="bi bi-three-dots"></i></button>
                    </div>

                    <!-- Tabla de Cursos -->
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr class="text-muted text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                                    <th class="border-0 pb-3">Curso</th>
                                    <th class="border-0 pb-3">Turno</th>
                                    <th class="border-0 pb-3">Aula</th>
                                    <th class="border-0 pb-3">Alumnos</th>
                                    <th class="border-0 pb-3">Preceptor/a</th>
                                    <th class="border-0 pb-3 text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Fila 1 -->
                                <tr class="border-bottom">
                                    <td class="fw-bold text-dark">1.º A</td>
                                    <td><span class="badge bg-light text-success border px-3 py-1 rounded-pill fw-medium">Mañana</span></td>
                                    <td class="text-muted">Aula 01</td>
                                    <td class="fw-semibold">31 / 32</td>
                                    <td>Carla Núñez</td>
                                    <td class="text-end text-muted"><i class="bi bi-three-dots-vertical cursor-pointer"></i></td>
                                </tr>
                                <!-- Fila 2 -->
                                <tr class="border-bottom">
                                    <td class="fw-bold text-dark">1.º B</td>
                                    <td><span class="badge bg-light text-secondary border px-3 py-1 rounded-pill fw-medium">Tarde</span></td>
                                    <td class="text-muted">Aula 07</td>
                                    <td class="fw-semibold">29 / 32</td>
                                    <td>Diego Paz</td>
                                    <td class="text-end text-muted"><i class="bi bi-three-dots-vertical cursor-pointer"></i></td>
                                </tr>
                                <!-- Fila 3 -->
                                <tr class="border-bottom">
                                    <td class="fw-bold text-dark">2.º A</td>
                                    <td><span class="badge bg-light text-success border px-3 py-1 rounded-pill fw-medium">Mañana</span></td>
                                    <td class="text-muted">Aula 02</td>
                                    <td class="fw-semibold">30 / 32</td>
                                    <td>Carla Núñez</td>
                                    <td class="text-end text-muted"><i class="bi bi-three-dots-vertical cursor-pointer"></i></td>
                                </tr>
                                <!-- Fila 4 -->
                                <tr class="border-bottom">
                                    <td class="fw-bold text-dark">2.º B</td>
                                    <td><span class="badge bg-light text-secondary border px-3 py-1 rounded-pill fw-medium">Tarde</span></td>
                                    <td class="text-muted">Aula 08</td>
                                    <td class="fw-semibold">28 / 32</td>
                                    <td>Diego Paz</td>
                                    <td class="text-end text-muted"><i class="bi bi-three-dots-vertical cursor-pointer"></i></td>
                                </tr>
                                <!-- Fila 5 -->
                                <tr>
                                    <td class="fw-bold text-dark">3.º A</td>
                                    <td><span class="badge bg-light text-success border px-3 py-1 rounded-pill fw-medium">Mañana</span></td>
                                    <td class="text-muted">Aula 03</td>
                                    <td class="fw-semibold">32 / 32</td>
                                    <td>Marina Solís</td>
                                    <td class="text-end text-muted"><i class="bi bi-three-dots-vertical cursor-pointer"></i></td>
                                </tr>
                            </tbody>
                        </table>
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