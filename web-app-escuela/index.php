<?php
// Configuración y variables de entorno
require_once __DIR__ . '/config/env.php';

// Título dinámico (SSR) requerido por la cátedra
$titulo_pagina = "Acceso Institucional - Colegio Horizonte";

// Inclusión del encabezado modular (SSI)
require_once __DIR__ . '/includes/header.php';
?>

<!-- Contenedor principal de la aplicación con la estética de Figma -->
<main class="d-flex align-items-center justify-content-center min-vh-100 bg-light py-4">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-xl-10">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="row g-0">
                        
                        <!-- COLUMNA IZQUIERDA: Panel institucional decorativo -->
                        <div class="col-lg-6 p-5 d-flex flex-column justify-content-between" style="background-color: #E8F0EC;">
                            <div>
                                <!-- Logo y Ciclo Lectivo -->
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-success text-white p-2 rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="bi bi-mortarboard-fill"></i>
                                        </div>
                                        <div>
                                            <span class="d-block fw-bold text-dark" style="font-size: 0.85rem; letter-spacing: 0.5px;">COLEGIO</span>
                                            <span class="d-block fw-bold text-success" style="font-size: 1.1rem; line-height: 1;">Horizonte</span>
                                        </div>
                                    </div>
                                    <span class="badge bg-white text-success fw-semibold px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.75rem;">
                                        CICLO LECTIVO 2025
                                    </span>
                                </div>
                                <span class="text-muted fw-medium" style="font-size: 0.85rem;">Comunidad educativa</span>

                                <!-- Textos principales -->
                                <h1 class="fw-bold text-dark mt-3 mb-3" style="font-size: 2.2rem; line-height: 1.2;">
                                    Un espacio para crecer, aprender y acompañar.
                                </h1>
                                <p class="text-muted mb-4" style="font-size: 0.95rem;">
                                    Gestionamos cada etapa escolar con cercanía, claridad y una mirada puesta en el futuro.
                                </p>
                            </div>

                            <!-- Gráfico central decorativo (Iconos flotantes simulados) -->
                            <div class="position-relative py-4 text-center my-auto">
                                <div class="mx-auto rounded-4 d-flex align-items-center justify-content-center shadow" style="width: 90px; height: 90px; background-color: #2D5A3F;">
                                    <i class="bi bi-mortarboard text-white" style="font-size: 2.5rem;"></i>
                                </div>
                                <!-- Elementos flotantes simulados como en el diseño -->
                                <span class="position-absolute top-0 start-25 translate-middle badge bg-white text-dark shadow-sm px-3 py-2 rounded-3 fw-bold">Aa</span>
                                <span class="position-absolute bottom-0 end-25 translate-middle badge bg-white text-dark shadow-sm px-3 py-2 rounded-3 fw-bold">123</span>
                            </div>

                            <!-- Footer institucional inferior -->
                            <div class="text-muted pt-3 border-top border-opacity-25 border-success" style="font-size: 0.8rem;">
                                <?= htmlspecialchars($nombre_sitio ?? 'Educación con propósito desde 1998'); ?>
                            </div>
                        </div>

                        <!-- COLUMNA DERECHA: Formulario de Login -->
                        <div class="col-lg-6 p-5 bg-white d-flex flex-column justify-content-center">
                            <div class="mb-4">
                                <span class="text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Portal institucional</span>
                                <h2 class="fw-bold text-dark mt-1" style="font-size: 1.8rem;">Bienvenido de nuevo</h2>
                                <p class="text-muted" style="font-size: 0.9rem;">Ingresá tus datos para acceder a tu espacio.</p>
                            </div>

                            <!-- Formulario de acceso -->
                            <form action="dashboard.php" method="POST">
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">Correo electrónico</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control bg-light border-start-0 py-2" id="email" name="email" value="admin@horizonte.edu.ar" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label for="password" class="form-label fw-semibold text-dark mb-0" style="font-size: 0.85rem;">Contraseña</label>
                                        <a href="#" class="text-success text-decoration-none small fw-semibold">¿Olvidaste tu contraseña?</a>
                                    </div>
                                    <div class="input-group mt-1">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control bg-light border-start-0 border-end-0 py-2" id="password" name="password" value="********" required>
                                        <span class="input-group-text bg-light border-start-0 text-muted" style="cursor: pointer;"><i class="bi bi-eye"></i></span>
                                    </div>
                                </div>

                                <!-- Botón de ingreso principal -->
                                <button type="submit" class="btn text-white w-100 py-3 fw-semibold rounded-3 mt-3 shadow-sm d-flex align-items-center justify-content-center gap-2" style="background-color: #2D5A3F; transition: background 0.2s;">
                                    Ingresar al portal 
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </form>

                            <!-- Sección de Vista Previa por Rol (muy útil para la defensa y desarrollo) -->
                            <div class="mt-4 pt-4 border-top text-center">
                                <span class="d-block text-uppercase text-muted fw-bold mb-3" style="font-size: 0.7rem; letter-spacing: 0.8px;">Vista previa por rol</span>
                                <div class="d-flex flex-wrap justify-content-center gap-2">
                                    <a href="dashboard.php?rol=admin" class="btn btn-outline-success btn-sm px-3 rounded-pill active">Admin</a>
                                    <a href="dashboard.php?rol=directivo" class="btn btn-outline-secondary btn-sm px-3 rounded-pill">Directivo</a>
                                    <a href="dashboard.php?rol=preceptor" class="btn btn-outline-secondary btn-sm px-3 rounded-pill">Preceptor</a>
                                    <a href="dashboard.php?rol=profesor" class="btn btn-outline-secondary btn-sm px-3 rounded-pill">Profesor</a>
                                    <a href="dashboard.php?rol=tutor" class="btn btn-outline-secondary btn-sm px-3 rounded-pill">Tutor</a>
                                </div>
                            </div>

                            <!-- Soporte técnico -->
                            <div class="text-center mt-4">
                                <span class="text-muted small">¿Necesitás ayuda? <a href="mailto:<?= htmlspecialchars($email_soporte ?? 'soporte@horizonte.edu.ar'); ?>" class="text-success text-decoration-none fw-semibold">Contactar a soporte</a></span>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php 
// Inclusión del pie de página modular (SSI)
require_once __DIR__ . '/includes/footer.php'; 
?>