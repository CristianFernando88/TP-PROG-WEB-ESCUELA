<?php
declare(strict_types=1);

/**
 * bootstrap.php — arranque único de la aplicación MVC (TP10).
 */

// 1) ROOT_PATH es la ruta física en el disco duro (C:\xampp\...)
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__));
}

// APP_PATH es la ruta física de la carpeta app/
if (!defined('APP_PATH')) {
    define('APP_PATH', __DIR__);
}

// 2) Autoload de clases del espacio de nombres App\
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

// 3) Sesión: si ya está activa no se vuelve a iniciar (evita "headers already sent")
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 4) Configuración y conexión a la BD usando ROOT_PATH
require_once ROOT_PATH . '/config/conexion.php';   // trae env.php y define $pdo
$roles = require ROOT_PATH . '/config/roles.php';  // matriz de roles y permisos