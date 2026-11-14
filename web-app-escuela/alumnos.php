<?php
// Configuración y variables de entorno
require_once __DIR__ . '/config/env.php';

// Título dinámico SSR exigido por el TP4
$titulo_pagina = "Alumnos y Matrícula - Colegio Horizonte";

// Inclusión del encabezado modular (SSI)
require_once __DIR__ . '/includes/header.php';
?>

<div class="d-flex min-vh-100 bg-light">
    
    <!-- 1. BARRA LATERAL (SSI) - Detecta automáticamente la página activa -->
    <?php require_once __DIR__ . '/includes/nav.php'; ?>

    <!-- 2. CONTENIDO PRINCIPAL DE ALUMNOS Y MATRÍCULA -->
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

        <!-- Título de la sección y botón de Matricular Alumno -->
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h1 class="fw-bold text-dark m-0" style="font-size: 2rem;">Alumnos y matrícula</h1>
                <p class="text-muted m-0" style="font-size: 0.9rem;">Gestioná estudiantes, familias y vínculos.</p>
            </div>
            <button class="btn text-white px-4 py-2 rounded-3 fw-semibold shadow-sm d-flex align-items-center gap-2" style="background-color: #2D5A3F;">
                <i class="bi bi-person-plus-fill"></i> Matricular alumno
            </button>
        </div>

        <!-- Tarjeta principal que contiene filtros y la tabla de alumnos -->
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            
            <!-- Barra de Filtros y Búsqueda interna -->
            <div class="row g-3 mb-4 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control bg-light border-start-0 py-2" placeholder="Buscar por nombre o DNI...">
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
                <div class="col-md-2">
                    <select class="form-select bg-light py-2 text-secondary">
                        <option selected>Todos los estados</option>
                        <option value="activo">Activo</option>
                        <option value="pendiente">Pendiente</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-light w-100 border py-2 text-dark fw-semibold d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-filter"></i> Filtros
                    </button>
                </div>
            </div>

            <!-- Tabla de Alumnos y Matrícula -->
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr class="text-muted text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                            <th class="border-0 pb-3">Alumno</th>
                            <th class="border-0 pb-3">Curso</th>
                            <th class="border-0 pb-3">Vínculos Familiares</th>
                            <th class="border-0 pb-3">Estado</th>
                            <th class="border-0 pb-3">Última actualización</th>
                            <th class="border-0 pb-3 text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Alumno 1 -->
                        <tr class="border-bottom">
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light text-success fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-size: 0.8rem;">EC</div>
                                    <div>
                                        <span class="d-block fw-bold text-dark" style="font-size: 0.9rem;">Emma Costa</span>
                                        <span class="text-muted" style="font-size: 0.75rem;">DNI 49.284.102</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="fw-semibold text-dark">3.º A • Primario</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-person text-muted"></i>
                                    <div>
                                        <span class="d-block fw-semibold text-dark" style="font-size: 0.85rem;">Lucía Costa</span>
                                        <span class="text-muted" style="font-size: 0.7rem;">Tomás • hermano</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-medium" style="font-size: 0.75rem;">Activo</span></td>
                            <td class="text-muted" style="font-size: 0.85rem;">Hoy, 09:42</td>
                            <td class="text-end text-muted"><i class="bi bi-three-dots-vertical cursor-pointer"></i></td>
                        </tr>

                        <!-- Alumno 2 -->
                        <tr class="border-bottom">
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light text-success fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-size: 0.8rem;">TC</div>
                                    <div>
                                        <span class="d-block fw-bold text-dark" style="font-size: 0.9rem;">Tomás Costa</span>
                                        <span class="text-muted" style="font-size: 0.75rem;">DNI 46.102.881</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="fw-semibold text-dark">1.º B • Secundario</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-person text-muted"></i>
                                    <div>
                                        <span class="d-block fw-semibold text-dark" style="font-size: 0.85rem;">Lucía Costa</span>
                                        <span class="text-muted" style="font-size: 0.7rem;">Emma • hermana</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-medium" style="font-size: 0.75rem;">Activo</span></td>
                            <td class="text-muted" style="font-size: 0.85rem;">Ayer, 16:20</td>
                            <td class="text-end text-muted"><i class="bi bi-three-dots-vertical cursor-pointer"></i></td>
                        </tr>

                        <!-- Alumno 3 -->
                        <tr class="border-bottom">
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light text-success fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-size: 0.8rem;">LM</div>
                                    <div>
                                        <span class="d-block fw-bold text-dark" style="font-size: 0.9rem;">Lucía Molina</span>
                                        <span class="text-muted" style="font-size: 0.75rem;">DNI 50.338.912</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="fw-semibold text-dark">1.º A • Primario</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-person text-muted"></i>
                                    <div>
                                        <span class="d-block fw-semibold text-dark" style="font-size: 0.85rem;">Pablo Molina</span>
                                        <span class="text-muted" style="font-size: 0.7rem;">Sin hermanos</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-1 rounded-pill fw-medium" style="font-size: 0.75rem;">Pendiente</span></td>
                            <td class="text-muted" style="font-size: 0.85rem;">Hoy, 08:15</td>
                            <td class="text-end text-muted"><i class="bi bi-three-dots-vertical cursor-pointer"></i></td>
                        </tr>

                        <!-- Alumno 4 -->
                        <tr class="border-bottom">
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light text-success fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-size: 0.8rem;">VR</div>
                                    <div>
                                        <span class="d-block fw-bold text-dark" style="font-size: 0.9rem;">Valentina Ruiz</span>
                                        <span class="text-muted" style="font-size: 0.75rem;">DNI 47.920.341</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="fw-semibold text-dark">5.º B • Secundario</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-person text-muted"></i>
                                    <div>
                                        <span class="d-block fw-semibold text-dark" style="font-size: 0.85rem;">Ana Fernández</span>
                                        <span class="text-muted" style="font-size: 0.7rem;">Mateo • hermano</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-medium" style="font-size: 0.75rem;">Activo</span></td>
                            <td class="text-muted" style="font-size: 0.85rem;">12 abr, 11:30</td>
                            <td class="text-end text-muted"><i class="bi bi-three-dots-vertical cursor-pointer"></i></td>
                        </tr>

                        <!-- Alumno 5 -->
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light text-success fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-size: 0.8rem;">BL</div>
                                    <div>
                                        <span class="d-block fw-bold text-dark" style="font-size: 0.9rem;">Benjamín López</span>
                                        <span class="text-muted" style="font-size: 0.75rem;">DNI 51.102.741</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="fw-semibold text-dark">Sala 5 • Inicial</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-person text-muted"></i>
                                    <div>
                                        <span class="d-block fw-semibold text-dark" style="font-size: 0.85rem;">María López</span>
                                        <span class="text-muted" style="font-size: 0.7rem;">Sin hermanos</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-medium" style="font-size: 0.75rem;">Activo</span></td>
                            <td class="text-muted" style="font-size: 0.85rem;">10 abr, 14:05</td>
                            <td class="text-end text-muted"><i class="bi bi-three-dots-vertical cursor-pointer"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Paginación inferior -->
            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <span class="text-muted" style="font-size: 0.85rem;">Mostrando 1–5 de 1.284 alumnos</span>
                <nav aria-label="Paginación de alumnos">
                    <ul class="pagination pagination-sm mb-0 gap-1">
                        <li class="page-item disabled"><a class="page-link rounded-2 text-secondary" href="#"><i class="bi bi-chevron-left"></i></a></li>
                        <li class="page-item active"><a class="page-link rounded-2 bg-success border-success text-white" href="#">1</a></li>
                        <li class="page-item"><a class="page-link rounded-2 text-secondary" href="#">2</a></li>
                        <li class="page-item"><a class="page-link rounded-2 text-secondary" href="#">3</a></li>
                        <li class="page-item"><a class="page-link rounded-2 text-secondary" href="#"><i class="bi bi-chevron-right"></i></a></li>
                    </ul>
                </nav>
            </div>

        </div>

    </div>

</div>

<?php 
// Inclusión del pie de página modular (SSI)
require_once __DIR__ . '/includes/footer.php'; 
?>