<?php
// Configuración y variables de entorno
require_once __DIR__ . '/config/env.php';

// Título dinámico SSR exigido por el TP4
$titulo_pagina = "Inicio - Panel de Gestión | Colegio Horizonte";

// Inclusión del encabezado modular
require_once __DIR__ . '/includes/header.php';
?>

<div class="d-flex min-vh-100 bg-light">
    
    <!-- 1. BARRA LATERAL (SSI) -->
    <?php require_once __DIR__ . '/includes/nav.php'; ?>

    <!-- 2. CONTENIDO PRINCIPAL DEL DASHBOARD -->
    <div class="flex-grow-1 p-4 overflow-auto">
        
        <!-- Barra superior (Header superior con buscador y perfil de usuario) -->
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
                        SM
                    </div>
                    <div class="text-start">
                        <span class="d-block fw-bold text-dark" style="font-size: 0.85rem; line-height: 1.1;">Sofía Méndez</span>
                        <span class="d-block text-muted" style="font-size: 0.7rem;">Administración general</span>
                    </div>
                    <i class="bi bi-chevron-down text-muted small ms-1"></i>
                </div>
            </div>
        </div>

        <!-- Bienvenida y botón de acción principal -->
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <span class="text-muted fw-semibold" style="font-size: 0.85rem;">LUNES, 14 DE ABRIL</span>
                <h1 class="fw-bold text-dark m-0" style="font-size: 2rem;">Buen día, Sofía</h1>
                <p class="text-muted m-0" style="font-size: 0.9rem;">Este es el resumen de la comunidad educativa hoy.</p>
            </div>
            <button class="btn text-white px-4 py-2 rounded-3 fw-semibold shadow-sm d-flex align-items-center gap-2" style="background-color: #2D5A3F;">
                <i class="bi bi-person-plus-fill"></i> Crear usuario
            </button>
        </div>

        <!-- Tarjetas de Métricas Principales (Grid superior) -->
        <div class="row g-3 mb-4">
            <!-- Alumnos activos -->
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-white">
                    <div class="d-flex align-items-center gap-2 mb-2 text-muted">
                        <div class="bg-light p-2 rounded-3 text-success"><i class="bi bi-people" style="font-size: 1.2rem;"></i></div>
                        <span style="font-size: 0.85rem;">Alumnos activos</span>
                    </div>
                    <h2 class="fw-bold text-dark m-0" style="font-size: 1.8rem;">1.284</h2>
                    <span class="text-success small mt-1"><i class="bi bi-arrow-up-right"></i> +32 este mes</span>
                </div>
            </div>
            <!-- Docentes -->
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-white">
                    <div class="d-flex align-items-center gap-2 mb-2 text-muted">
                        <div class="bg-light p-2 rounded-3 text-success"><i class="bi bi-mortarboard" style="font-size: 1.2rem;"></i></div>
                        <span style="font-size: 0.85rem;">Docentes</span>
                    </div>
                    <h2 class="fw-bold text-dark m-0" style="font-size: 1.8rem;">86</h2>
                    <span class="text-success small mt-1"><i class="bi bi-arrow-up-right"></i> +4 incorporaciones</span>
                </div>
            </div>
            <!-- Cursos activos -->
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-white">
                    <div class="d-flex align-items-center gap-2 mb-2 text-muted">
                        <div class="bg-light p-2 rounded-3 text-success"><i class="bi bi-layers" style="font-size: 1.2rem;"></i></div>
                        <span style="font-size: 0.85rem;">Cursos activos</span>
                    </div>
                    <h2 class="fw-bold text-dark m-0" style="font-size: 1.8rem;">42</h2>
                    <span class="text-success small mt-1"><i class="bi bi-arrow-up-right"></i> 3 niveles</span>
                </div>
            </div>
            <!-- Asistencia hoy -->
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-3 h-100 bg-white">
                    <div class="d-flex align-items-center gap-2 mb-2 text-muted">
                        <div class="bg-light p-2 rounded-3 text-success"><i class="bi bi-check2-circle" style="font-size: 1.2rem;"></i></div>
                        <span style="font-size: 0.85rem;">Asistencia hoy</span>
                    </div>
                    <h2 class="fw-bold text-dark m-0" style="font-size: 1.8rem;">94,8%</h2>
                    <span class="text-success small mt-1"><i class="bi bi-arrow-up-right"></i> +1,2% vs. ayer</span>
                </div>
            </div>
        </div>

        <!-- Sección inferior: Actividad Reciente y Accesos Rápidos -->
        <div class="row g-4">
            
            <!-- Columna izquierda: Actividad reciente -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="fw-bold text-dark m-0">Actividad reciente</h5>
                            <span class="text-muted small">Últimos movimientos del sistema</span>
                        </div>
                        <a href="#" class="text-success text-decoration-none fw-semibold small">Ver todo</a>
                    </div>
                    
                    <div class="d-flex flex-column gap-3">
                        <!-- Item 1 -->
                        <div class="d-flex align-items-center justify-content-between p-2 border-bottom">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light text-success fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-size: 0.85rem;">LM</div>
                                <div>
                                    <span class="d-block fw-semibold text-dark" style="font-size: 0.9rem;">Lucía Molina fue matriculada</span>
                                    <span class="text-muted" style="font-size: 0.75rem;">1.º A • Nivel Primario</span>
                                </div>
                            </div>
                            <span class="text-muted small">Hace 12 min</span>
                        </div>
                        <!-- Item 2 -->
                        <div class="d-flex align-items-center justify-content-between p-2 border-bottom">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light text-success fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-size: 0.85rem;">FG</div>
                                <div>
                                    <span class="d-block fw-semibold text-dark" style="font-size: 0.9rem;">Federico Gómez actualizó notas</span>
                                    <span class="text-muted" style="font-size: 0.75rem;">Matemática • 3.º B</span>
                                </div>
                            </div>
                            <span class="text-muted small">Hace 38 min</span>
                        </div>
                        <!-- Item 3 -->
                        <div class="d-flex align-items-center justify-content-between p-2">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light text-success fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-size: 0.85rem;">AR</div>
                                <div>
                                    <span class="d-block fw-semibold text-dark" style="font-size: 0.9rem;">Ana Ruiz creó un nuevo curso</span>
                                    <span class="text-muted" style="font-size: 0.75rem;">Sala de 4 • Turno tarde</span>
                                </div>
                            </div>
                            <span class="text-muted small">Hace 1 h</span>
                        </div>
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
                        <a href="#" class="d-flex align-items-center justify-content-between p-3 rounded-3 bg-light text-decoration-none text-dark transition hover-bg">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-white p-2 rounded-2 text-success shadow-sm"><i class="bi bi-person-plus"></i></div>
                                <div>
                                    <span class="d-block fw-semibold" style="font-size: 0.9rem;">Matricular alumno</span>
                                    <span class="text-muted" style="font-size: 0.7rem;">Registrar una nueva matrícula</span>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right text-muted small"></i>
                        </a>

                        <a href="#" class="d-flex align-items-center justify-content-between p-3 rounded-3 bg-light text-decoration-none text-dark transition hover-bg">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-white p-2 rounded-2 text-success shadow-sm"><i class="bi bi-shield-lock"></i></div>
                                <div>
                                    <span class="d-block fw-semibold" style="font-size: 0.9rem;">Crear usuario y rol</span>
                                    <span class="text-muted" style="font-size: 0.7rem;">Invitar a la comunidad</span>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right text-muted small"></i>
                        </a>

                        <a href="#" class="d-flex align-items-center justify-content-between p-3 rounded-3 bg-light text-decoration-none text-dark transition hover-bg">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-white p-2 rounded-2 text-success shadow-sm"><i class="bi bi-journal-check"></i></div>
                                <div>
                                    <span class="d-block fw-semibold" style="font-size: 0.9rem;">Asignar materia</span>
                                    <span class="text-muted" style="font-size: 0.7rem;">Vincular curso y profesor</span>
                                </div>
                            </div>
                            <i class="bi bi-chevron-right text-muted small"></i>
                        </a>
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