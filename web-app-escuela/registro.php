<?php
declare(strict_types=1);

require_once __DIR__ . '/config/env.php';
require_once __DIR__ . '/config/conexion.php'; // Acceso a $pdo

session_start();

// Redirigir si el usuario ya está logueado
// Aunque no tenemos un sistema de sesión completo, si 'rol' está definido, asumimos que está logueado
// y debería ir al dashboard. Esto evita que usuarios logueados accedan a registro.
$rolEnSesion = $_SESSION['rol'] ?? null;
if (is_string($rolEnSesion)) {
    header('Location: dashboard.php');
    exit;
}

$titulo_pagina = 'Registro de Usuario - Colegio Horizonte';
$errorRegistro = '';

// Variables para el "Sticky Form"
$nombre = '';
$apellido = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Sanear los datos
    $nombre = isset($_POST['nombre']) && is_string($_POST['nombre']) ? trim(htmlspecialchars($_POST['nombre'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) : '';
    $apellido = isset($_POST['apellido']) && is_string($_POST['apellido']) ? trim(htmlspecialchars($_POST['apellido'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) : '';
    $email = isset($_POST['email']) && is_string($_POST['email']) ? trim(htmlspecialchars($_POST['email'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')) : '';
    $password = isset($_POST['password']) && is_string($_POST['password']) ? $_POST['password'] : '';
    $confirmar_password = isset($_POST['confirmar_password']) && is_string($_POST['confirmar_password']) ? $_POST['confirmar_password'] : '';

    // 2. Validar
    if (empty($nombre) || empty($apellido) || empty($email) || empty($password) || empty($confirmar_password)) {
        $errorRegistro = 'Todos los campos son obligatorios.';
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errorRegistro = 'Por favor, ingresa un correo electrónico válido.';
    } elseif ($password !== $confirmar_password) {
        $errorRegistro = 'Las contraseñas no coinciden.';
    } elseif (strlen($password) < 6) { // Validación de longitud mínima para la contraseña
        $errorRegistro = 'La contraseña debe tener al menos 6 caracteres.';
    } else {
        // Verificar si el email ya existe en la base de datos
        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $emailExiste = $stmt->fetchColumn();

            if ($emailExiste > 0) {
                $errorRegistro = 'Este correo electrónico ya está registrado. Por favor, intenta iniciar sesión o usa otro correo.';
            } else {
                // Si todas las validaciones son exitosas:
                // Generar hash de la contraseña
                $password_hash = password_hash($password, PASSWORD_BCRYPT);
                
                // Asignar id_rol = 3 como valor por defecto (asumiendo 'Tutor/Usuario')
                $id_rol_default = 3; 

                // Insertar el nuevo usuario en la tabla `usuarios`
                $stmt = $pdo->prepare("INSERT INTO usuarios (id_rol, nombre, apellido, email, password_hash) VALUES (:id_rol, :nombre, :apellido, :email, :password_hash)");
                $stmt->execute([
                    ':id_rol' => $id_rol_default,
                    ':nombre' => $nombre,
                    ':apellido' => $apellido,
                    ':email' => $email,
                    ':password_hash' => $password_hash
                ]);

                // Redirigir a login.php con un mensaje de éxito
                header('Location: login.php?registro=exitoso');
                exit;
            }
        } catch (PDOException $e) {
            // En un entorno de producción, registrar el error y mostrar un mensaje genérico.
            // error_log("Error al registrar usuario: " . $e->getMessage());
            $errorRegistro = 'Ocurrió un error inesperado al intentar registrar el usuario. Por favor, inténtalo de nuevo más tarde.';
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<main class="d-flex align-items-center justify-content-center min-vh-100 bg-light py-4">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-xl-10">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-lg-6 d-none d-lg-flex p-5 flex-column justify-content-between" style="background-color: #E8F0EC;">
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
                                    Registra tus datos y únete a nuestra comunidad educativa.
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

                        <div class="col-12 col-lg-6 p-4 p-md-5 bg-white d-flex flex-column justify-content-center">
                            <div class="mb-4">
                                <span class="text-uppercase text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">Portal institucional</span>
                                <h2 class="fw-bold text-dark mt-1" style="font-size: 1.8rem;">Crea tu cuenta</h2>
                                <p class="text-muted" style="font-size: 0.9rem;">Completa tus datos para registrarte.</p>
                            </div>

                            <?php if ($errorRegistro !== ''): ?>
                                <div class="alert alert-danger py-2 small" role="alert">
                                    <?= htmlspecialchars($errorRegistro, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>
                                </div>
                            <?php endif; ?>

                            <form action="registro.php" method="POST">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">Nombre</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control bg-light border-start-0 py-2" id="nombre" name="nombre" value="<?= htmlspecialchars($nombre, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="apellido" class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">Apellido</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control bg-light border-start-0 py-2" id="apellido" name="apellido" value="<?= htmlspecialchars($apellido, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">Correo electrónico</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control bg-light border-start-0 py-2" id="email" name="email" autocomplete="username" value="<?= htmlspecialchars($email, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">Contraseña</label>
                                    <div class="input-group mt-1">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control bg-light border-start-0 py-2" id="password" name="password" autocomplete="new-password" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="confirmar_password" class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">Confirmar Contraseña</label>
                                    <div class="input-group mt-1">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock-fill"></i></span>
                                        <input type="password" class="form-control bg-light border-start-0 py-2" id="confirmar_password" name="confirmar_password" autocomplete="new-password" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn text-white w-100 py-3 fw-semibold rounded-3 mt-3 shadow-sm d-flex align-items-center justify-content-center gap-2" style="background-color: #2D5A3F; transition: background 0.2s;">
                                    Registrarse
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </form>

                            <div class="text-center mt-4">
                                <span class="text-muted small">¿Ya tenés una cuenta? <a href="login.php" class="text-success text-decoration-none fw-semibold">Iniciar sesión</a></span>
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
