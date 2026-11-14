<?php
// Detectar la página actual para marcar el ítem activo en el menú (Requisito SSR del TP4)
$current_page = basename($_SERVER['SCRIPT_NAME']);
?>
<!-- Barra lateral de navegación institucional -->
<div class="d-flex flex-column flex-shrink-0 p-3 bg-white border-end" style="width: 280px; min-height: 100vh;">
    <!-- Logo y Título -->
    <a href="dashboard.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none gap-2 px-2">
        <div class="bg-success text-white p-2 rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
            <i class="bi bi-mortarboard-fill"></i>
        </div>
        <div>
            <span class="d-block fw-bold text-dark" style="font-size: 0.75rem; letter-spacing: 0.5px;">COLEGIO</span>
            <span class="d-block fw-bold text-success" style="font-size: 1rem; line-height: 1;">Horizonte</span>
        </div>
    </a>
    <hr class="text-muted opacity-25">

    <!-- Menú principal: Gestión -->
    <span class="text-uppercase text-muted fw-bold px-2 mb-2" style="font-size: 0.65rem; letter-spacing: 1px;">Gestión</span>
    <ul class="nav nav-pills flex-column mb-auto gap-1">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link <?= ($current_page == 'dashboard.php') ? 'active text-white' : 'link-dark'; ?>" style="<?= ($current_page == 'dashboard.php') ? 'background-color: #2D5A3F;' : ''; ?>">
                <i class="bi bi-house-door me-2"></i> Inicio
            </a>
        </li>
        <li>
            <a href="niveles.php" class="nav-link <?= ($current_page == 'niveles.php') ? 'active text-white' : 'link-dark'; ?>">
                <i class="bi bi-layers me-2"></i> Niveles y cursos
            </a>
        </li>
        <li>
            <a href="alumnos.php" class="nav-link <?= ($current_page == 'alumnos.php') ? 'active text-white' : 'link-dark'; ?>">
                <i class="bi bi-people me-2"></i> Alumnos y matrícula
            </a>
        </li>
        <li>
            <a href="materias.php" class="nav-link <?= ($current_page == 'materias.php') ? 'active text-white' : 'link-dark'; ?>">
                <i class="bi bi-book me-2"></i> Materias
            </a>
        </li>
    </ul>

    <!-- Menú secundario: Herramientas -->
    <span class="text-uppercase text-muted fw-bold px-2 mt-4 mb-2" style="font-size: 0.65rem; letter-spacing: 1px;">Herramientas</span>
    <ul class="nav nav-pills flex-column mb-4 gap-1">
        <li>
            <a href="calendario.php" class="nav-link link-dark">
                <i class="bi bi-calendar-event me-2"></i> Calendario
            </a>
        </li>
        <li>
            <a href="configuracion.php" class="nav-link link-dark">
                <i class="bi bi-gear me-2"></i> Configuración
            </a>
        </li>
    </ul>

    <!-- Centro de ayuda inferior -->
    <div class="card bg-light border-0 p-3 rounded-4 mt-auto">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; min-width: 32px;">
                <i class="bi bi-question-lg"></i>
            </div>
            <div>
                <span class="d-block fw-bold text-dark" style="font-size: 0.85rem;">Centro de ayuda</span>
                <span class="d-block text-muted" style="font-size: 0.7rem;">Guías y soporte</span>
            </div>
        </div>
    </div>
</div>