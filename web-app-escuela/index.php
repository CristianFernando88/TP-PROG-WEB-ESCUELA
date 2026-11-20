<?php
declare(strict_types=1);

/**
 * index.php — Front Controller (TP10).
 */

use App\Core\Router;

require __DIR__ . '/app/bootstrap.php';                    
$rutas = require __DIR__ . '/app/config/routes.php';       

$metodo = (string) ($_SERVER['REQUEST_METHOD'] ?? 'GET');
$ruta   = (string) (parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');

// Calcula la ruta web base (ej: /TP-PROG-WEB-ESCUELA/web-app-escuela)
$base = rtrim(str_replace('\\', '/', dirname((string) ($_SERVER['SCRIPT_NAME'] ?? '/index.php'))), '/');

if ($base !== '' && ($ruta === $base || str_starts_with($ruta, $base . '/'))) {
    $ruta = substr($ruta, strlen($base));

    if ($ruta === '' || $ruta[0] !== '/') {
        $ruta = '/' . $ruta;
    }
}

// Define BASE_PATH globalmente para armar URLs y redirecciones
if (!defined('BASE_PATH')) {
    define('BASE_PATH', $base); 
}

(new Router($rutas))->dispatch($metodo, $ruta);