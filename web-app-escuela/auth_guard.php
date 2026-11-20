<?php
declare(strict_types=1);

/**
 * auth_guard.php — Script reutilizable de protección de rutas (TP8)
 *
 * Uso en cada vista protegida, siempre antes de cualquier salida HTML:
 *
 *     $requerirPermiso = 'alumnos';                  // opcional: control por rol
 *     require_once __DIR__ . '/auth_guard.php';      // o '/../auth_guard.php' desde admin/
 *
 * Qué hace al ser incluido:
 *   1. Inicia la sesión si no estaba iniciada.
 *   2. Valida que $_SESSION['rol'] exista en config/roles.php.
 *      Si no es válida: vacía $_SESSION, ejecuta session_destroy() y
 *      redirige a login.php con la ruta correcta aunque la página
 *      esté en una subcarpeta (admin/, clase5/).
 *   3. Si se definió $requerirPermiso, responde 403 cuando el rol no lo tiene.
 *   4. Deja disponible $currentUser (rol + permisos) para la vista y nav.php.
 */

require_once __DIR__ . '/includes/auth.php'; // appHasPermission() la necesitan nav.php y dashboard.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$rolesGuard = require __DIR__ . '/config/roles.php';
$rolGuard = $_SESSION['rol'] ?? null;

if (!is_string($rolGuard) || !isset($rolesGuard[$rolGuard])) {
    $_SESSION = [];
    session_destroy();

    // Ruta absoluta al login: un 'Location: login.php' suelto daría 404 desde admin/ o clase5/
    $baseGuard = str_replace('\\', '/', dirname((string) ($_SERVER['SCRIPT_NAME'] ?? '/index.php')));
    if (in_array(basename($baseGuard), ['admin', 'clase5'], true)) {
        $baseGuard = dirname($baseGuard);
    }

    header('Location: ' . rtrim($baseGuard, '/') . '/login.php');
    exit;
}

$currentUser = $rolesGuard[$rolGuard];
$currentUser['role'] = $rolGuard;

// Control de acceso por roles
if (
    isset($requerirPermiso)
    && is_string($requerirPermiso)
    && $requerirPermiso !== ''
    && !in_array($requerirPermiso, $currentUser['permissions'] ?? [], true)
) {
    http_response_code(403);
    exit('No tenés permiso para acceder a esta sección.');
}
