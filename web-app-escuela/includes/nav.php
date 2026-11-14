<?php
declare(strict_types=1);

$pagina_actual = basename((string) (parse_url($_SERVER['SCRIPT_NAME'] ?? 'index.php', PHP_URL_PATH) ?: 'index.php'));
$enlaces_navegacion = [
    'index.php' => ['Inicio', 'bi-house'],
    'estudiantes.php' => ['Estudiantes', 'bi-people'],
    'docentes.php' => ['Docentes', 'bi-person-workspace'],
    'cursos.php' => ['Cursos', 'bi-journal-bookmark'],
];
?>
<aside class="col-md-3 col-lg-2 sidebar-flotante p-3 rounded-4">
    <a class="d-flex align-items-center mb-4 px-2 text-decoration-none" href="index.php">
        <span class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center me-2 fw-bold" style="width: 40px; height: 40px;" aria-hidden="true">H</span>
        <span>
            <span class="d-block small text-muted lh-1">Colegio</span>
            <span class="fw-bold fs-6 text-dark"><?= htmlspecialchars(APP_NAME, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span>
        </span>
    </a>

    <nav aria-label="Navegación principal">
        <ul class="nav flex-column gap-1">
            <?php foreach ($enlaces_navegacion as $archivo => [$etiqueta, $icono]): ?>
                <?php $activo = $pagina_actual === $archivo; ?>
                <li class="nav-item">
                    <a
                        class="nav-link<?= $activo ? ' active bg-white rounded-3 shadow-sm fw-semibold text-dark' : '' ?>"
                        href="<?= htmlspecialchars($archivo, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>"
                        <?= $activo ? 'aria-current="page"' : '' ?>
                    >
                        <i class="bi <?= htmlspecialchars($icono, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?> me-2" aria-hidden="true"></i>
                        <?= htmlspecialchars($etiqueta, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <div class="mt-4 pt-3 border-top border-secondary border-opacity-10">
        <a class="small text-muted text-decoration-none" href="mailto:<?= htmlspecialchars(SUPPORT_EMAIL, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
            <i class="bi bi-envelope me-1" aria-hidden="true"></i>
            <?= htmlspecialchars(SUPPORT_EMAIL, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
        </a>
    </div>
</aside>
