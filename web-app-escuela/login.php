<?php
declare(strict_types=1);

require_once __DIR__ . '/config/env.php';

session_start();

$roles = require __DIR__ . '/config/roles.php';
$rolesPermitidos = array_keys($roles);
$rolEnSesion = $_SESSION['rol'] ?? null;

if (is_string($rolEnSesion) && isset($roles[$rolEnSesion])) {
    header('Location: dashboard.php');
    exit;
}

unset($_SESSION['rol']);
$rolSeleccionado = 'admin';
$errorLogin = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) && is_string($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) && is_string($_POST['password']) ? $_POST['password'] : '';
    $rolRecibido = isset($_POST['rol']) && is_string($_POST['rol']) ? $_POST['rol'] : '';

    if (
        filter_var($email, FILTER_VALIDATE_EMAIL) === false
        || trim($password) === ''
        || !in_array($rolRecibido, $rolesPermitidos, true)
    ) {
        $errorLogin = 'Ingresá un correo válido, una contraseña y un rol permitido.';
        $rolSeleccionado = in_array($rolRecibido, $rolesPermitidos, true) ? $rolRecibido : 'admin';
    } else {
        session_regenerate_id(true);
        $_SESSION['rol'] = $rolRecibido;
        $_SESSION['email'] = $email;

        header('Location: dashboard.php');
        exit;
    }
}

$titulo_pagina = 'Acceso Institucional - Colegio Horizonte';
require_once __DIR__ . '/includes/header.php';
?>

<main class="d-flex align-items-center justify-content-center min-vh-100 bg-light py-4">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-xl-10">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-lg-6 p-5 d-flex flex-column justify-content-between" style="background-color: #E8F0EC;">
                            <div>
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
                                <h1 class="fw-bold text-dark mt-3 mb-3" style="font-size: 2.2rem; line-height: 1.2;">
                                    Un espacio para crecer, aprender y acompañar.
                                </h1>
                                <p class="text-muted mb-4" style="font-size: 0.95rem;">
                                    Gestionamos cada etapa escolar con cercanía, claridad y una mirada puesta en el futuro.
                                </p>
                            </div>

                            <div class="position-relative py-4 text-center my-auto">
                                <div class="mx-auto rounded-4 d-flex align-items-center justify-content-center shadow" style="width: 90px; height: 90px; background-color: #2D5A3F;">
                                    <i class="bi bi-mortarboard text-white" style="font-size: 2.5rem;"></i>
                                </div>
                                <span class="position-absolute top-0 start-25 translate-middle badge bg-white text-dark shadow-sm px-3 py-2 rounded-3 fw-bold">Aa</span>
                                <span class="position-absolute bottom-0 end-25 translate-middle badge bg-white text-dark shadow-sm px-3 py-2 rounded-3 fw-bold">123</span>
                            </div>

                            <div class="text-muted pt-3 border-top border-opacity-25 border-success" style="font-size: 0.8rem;">
                                <?= htmlspecialchars(APP_NAME, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>
                            </div>
                        </div>

                        <div class="col-lg-6 p-5 bg-white d-flex flex-column justify-content-center">
                            <div class="mb-4">
                                <span class="text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Portal institucional</span>
                                <h2 class="fw-bold text-dark mt-1" style="font-size: 1.8rem;">Bienvenido de nuevo</h2>
                                <p class="text-muted" style="font-size: 0.9rem;">Ingresá tus datos para acceder a tu espacio.</p>
                            </div>

                            <div class="alert alert-info py-2 small" role="status">
                                Acceso simulado para pruebas: cualquier correo válido y contraseña no vacía.
                            </div>

                            <?php if ($errorLogin !== ''): ?>
                                <div class="alert alert-danger py-2 small" role="alert">
                                    <?= htmlspecialchars($errorLogin, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>
                                </div>
                            <?php endif; ?>

                            <form action="login.php" method="POST">
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">Correo electrónico</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control bg-light border-start-0 py-2" id="email" name="email" autocomplete="username" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">Contraseña</label>
                                    <div class="input-group mt-1">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control bg-light border-start-0 py-2" id="password" name="password" autocomplete="current-password" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="rol" class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">Rol de prueba</label>
                                    <select class="form-select bg-light py-2" id="rol" name="rol" required>
                                        <option value="admin" <?= $rolSeleccionado === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                        <option value="directivo" <?= $rolSeleccionado === 'directivo' ? 'selected' : ''; ?>>Directivo</option>
                                        <option value="preceptor" <?= $rolSeleccionado === 'preceptor' ? 'selected' : ''; ?>>Preceptor</option>
                                        <option value="profesor" <?= $rolSeleccionado === 'profesor' ? 'selected' : ''; ?>>Profesor</option>
                                        <option value="tutor" <?= $rolSeleccionado === 'tutor' ? 'selected' : ''; ?>>Tutor</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn text-white w-100 py-3 fw-semibold rounded-3 mt-3 shadow-sm d-flex align-items-center justify-content-center gap-2" style="background-color: #2D5A3F; transition: background 0.2s;">
                                    Ingresar al portal
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </form>

                            <div class="text-center mt-4">
                                <span class="text-muted small">¿Necesitás ayuda? <a href="mailto:<?= htmlspecialchars(SUPPORT_EMAIL, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" class="text-success text-decoration-none fw-semibold">Contactar a soporte</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
