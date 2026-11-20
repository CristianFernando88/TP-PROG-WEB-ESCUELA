<?php
declare(strict_types=1);

/**
 * bootstrap.php — arranque único de la aplicación MVC (TP10, Fase 0).
 *
 * Debe incluirse desde el Front Controller (index.php) antes de enrutar. Deja:
 *
 *   1. Constantes BASE_PATH (raíz de web-app-escuela/) y APP_PATH (app/).
 *   2. Autoload básico de las clases App\* (App\Controllers\X → app/Controllers/X.php).
 *   3. La sesión iniciada una sola vez por petición.
 *   4. La configuración y la conexión a la BD: $pdo y $roles en el ámbito global
 *      (mismo contrato que tenían config/conexion.php y config/roles.php).
 */

if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}

if (!defined('APP_PATH')) {
    define('APP_PATH', __DIR__);
}

// 1) Autoload de clases del espacio de nombres App\
spl_autoload_register(static function (string $clase): void {
    $prefijo = 'App\\';

    if (!str_starts_with($clase, $prefijo)) {
        return;
    }

    $relativo = str_replace('\\', '/', substr($clase, strlen($prefijo)));
    $archivo  = APP_PATH . '/' . $relativo . '.php';

    if (is_file($archivo)) {
        require $archivo;
    }
});

// 2) Sesión: si ya está activa no se vuelve a iniciar (evita "headers already sent")
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 3) Configuración y conexión a la BD
require_once BASE_PATH . '/config/conexion.php';   // trae env.php y define $pdo
$roles = require BASE_PATH . '/config/roles.php';  // matriz de roles y permisos
