<?php
$currentScript = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$current_page = basename($currentScript);
$currentDirectory = basename(dirname($currentScript));
$baseUrl = (defined('APP_BASE_URL') && APP_BASE_URL !== '') ? rtrim(APP_BASE_URL, '/') : '';

if ($baseUrl === '') {
    $scriptDirectory = dirname($currentScript);
    if (in_array(basename($scriptDirectory), ['admin', 'clase5'], true)) {
        $scriptDirectory = dirname($scriptDirectory);
    }

    $baseUrl = rtrim($scriptDirectory, '/.');
}

$dashboardUrl = $baseUrl === '' ? 'dashboard.php' : $baseUrl . '/dashboard.php';
$navigationItems = [
    ['page' => 'dashboard', 'file' => 'dashboard.php', 'label' => 'Inicio', 'icon' => 'bi-house-door'],
    ['page' => 'niveles', 'file' => 'niveles.php', 'label' => 'Niveles y cursos', 'icon' => 'bi-layers'],
    ['page' => 'alumnos', 'file' => 'admin/index.php', 'label' => 'Alumnos y matrícula', 'icon' => 'bi-people'],
    ['page' => 'materias', 'file' => 'materias.php', 'label' => 'Materias', 'icon' => 'bi-book'],
    ['page' => 'hijos', 'file' => 'hijos.php', 'label' => 'Mis Hijos', 'icon' => 'bi-people'],
];
?>
<div class="d-lg-none p-3 bg-white border-bottom">
    <button class="btn btn-outline-success d-flex align-items-center gap-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#appSidebar" aria-controls="appSidebar">
        <i class="bi bi-list" aria-hidden="true"></i>
        <span>Menú</span>
    </button>
</div>

<div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="appSidebar" aria-labelledby="appSidebarLabel">
    <div class="offcanvas-header border-bottom">
        <a href="<?= htmlspecialchars($dashboardUrl, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" class="d-flex align-items-center text-decoration-none gap-2" id="appSidebarLabel">
            <div class="bg-success text-white p-2 rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <span class="fw-bold text-success">Colegio Horizonte</span>
        </a>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar menú"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
        <span class="text-uppercase text-muted fw-bold px-2 mb-2" style="font-size: 0.65rem; letter-spacing: 1px;">Gestión</span>
        <ul class="nav nav-pills flex-column gap-1">
            <?php foreach ($navigationItems as $item): ?>
                <?php if (!appHasPermission($currentUser, $item['page'])) { continue; } ?>
                <?php $isActive = $item['file'] === 'admin/index.php'
                    ? $current_page === basename($item['file']) && $currentDirectory === 'admin'
                    : $current_page === basename($item['file']); ?>
                <?php $href = $baseUrl === '' ? $item['file'] : $baseUrl . '/' . $item['file']; ?>
                <li class="nav-item">
                    <a href="<?= htmlspecialchars($href, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" class="nav-link <?= $isActive ? 'active text-white' : 'link-dark'; ?>"<?= $isActive ? ' style="background-color: #2D5A3F;" aria-current="page"' : ''; ?>>
                        <i class="bi <?= htmlspecialchars($item['icon'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?> me-2" aria-hidden="true"></i> <?= htmlspecialchars($item['label'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="card bg-light border-0 p-3 rounded-4 mt-auto">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; min-width: 32px;">
                    <i class="bi bi-question-lg" aria-hidden="true"></i>
                </div>
                <div>
                    <span class="d-block fw-bold text-dark" style="font-size: 0.85rem;">Centro de ayuda</span>
                    <span class="d-block text-muted" style="font-size: 0.7rem;">Guías y soporte</span>
                </div>
            </div>
        </div>
    </div>
</div>

<aside class="d-none d-lg-flex flex-column flex-shrink-0 p-3 bg-white border-end" style="width: 280px; min-height: 100vh;">
    <a href="<?= htmlspecialchars($dashboardUrl, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" class="d-flex align-items-center mb-3 me-md-auto text-decoration-none gap-2 px-2">
        <div class="bg-success text-white p-2 rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
            <i class="bi bi-mortarboard-fill"></i>
        </div>
        <div>
            <span class="d-block fw-bold text-dark" style="font-size: 0.75rem; letter-spacing: 0.5px;">COLEGIO</span>
            <span class="d-block fw-bold text-success" style="font-size: 1rem; line-height: 1;">Horizonte</span>
        </div>
    </a>
    <hr class="text-muted opacity-25">

    <span class="text-uppercase text-muted fw-bold px-2 mb-2" style="font-size: 0.65rem; letter-spacing: 1px;">Gestión</span>
    <ul class="nav nav-pills flex-column mb-auto gap-1">
        <?php foreach ($navigationItems as $item): ?>
            <?php if (!appHasPermission($currentUser, $item['page'])) { continue; } ?>
            <?php $isActive = $item['file'] === 'admin/index.php'
                ? $current_page === basename($item['file']) && $currentDirectory === 'admin'
                : $current_page === basename($item['file']); ?>
            <?php $href = $baseUrl === '' ? $item['file'] : $baseUrl . '/' . $item['file']; ?>
            <li class="nav-item">
                <a href="<?= htmlspecialchars($href, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" class="nav-link <?= $isActive ? 'active text-white' : 'link-dark'; ?>"<?= $isActive ? ' style="background-color: #2D5A3F;" aria-current="page"' : ''; ?>>
                    <i class="bi <?= htmlspecialchars($item['icon'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?> me-2" aria-hidden="true"></i> <?= htmlspecialchars($item['label'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="card bg-light border-0 p-3 rounded-4 mt-auto">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; min-width: 32px;">
                <i class="bi bi-question-lg" aria-hidden="true"></i>
            </div>
            <div>
                <span class="d-block fw-bold text-dark" style="font-size: 0.85rem;">Centro de ayuda</span>
                <span class="d-block text-muted" style="font-size: 0.7rem;">Guías y soporte</span>
            </div>
        </div>
    </div>
</aside>
