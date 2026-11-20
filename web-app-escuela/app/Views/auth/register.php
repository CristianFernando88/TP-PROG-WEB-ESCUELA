<?php
// Las variables como $titulo_pagina, $errorRegistro, $nombre, $apellido, $email, $base_path
// son pasadas desde el controlador AuthController::showRegister()
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($titulo_pagina ?? 'Registro - Colegio Horizonte', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></title>
    <!-- Incluye Bootstrap CSS y Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 1rem; }
        .form-control:focus, .form-select:focus {
            border-color: #2D5A3F;
            box-shadow: 0 0 0 0.25rem rgba(45, 90, 63, 0.25);
        }
        .btn {
            background-color: #2D5A3F;
            border-color: #2D5A3F;
        }
        .btn:hover {
            background-color: #21412e;
            border-color: #21412e;
        }
        a { color: #2D5A3F; }
        a:hover { color: #21412e; }
    </style>
</head>
<body>

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

                            <?php if (!empty($errorRegistro)): ?>
                                <div class="alert alert-danger py-2 small" role="alert">
                                    <?= htmlspecialchars($errorRegistro, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>
                                </div>
                            <?php endif; ?>

                            <form action="<?= htmlspecialchars($base_path . '/registro', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" method="POST">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">Nombre</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control bg-light border-start-0 py-2" id="nombre" name="nombre" value="<?= htmlspecialchars($nombre ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="apellido" class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">Apellido</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control bg-light border-start-0 py-2" id="apellido" name="apellido" value="<?= htmlspecialchars($apellido ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold text-dark" style="font-size: 0.85rem;">Correo electrónico</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control bg-light border-start-0 py-2" id="email" name="email" autocomplete="username" value="<?= htmlspecialchars($email ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" required>
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
                                <span class="text-muted small">¿Ya tenés una cuenta? <a href="<?= htmlspecialchars($base_path . '/login', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" class="text-success text-decoration-none fw-semibold">Iniciar sesión</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>