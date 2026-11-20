<?php
declare(strict_types=1);

/**
 * index.php — Front Controller (TP10, Fase 0).
 *
 * Toda petición que no corresponda a un archivo o directorio real llega
 * acá (gracias a .htaccess) y se resuelve con app/config/routes.php.
 * La lógica de redirección por rol pasó a app/Controllers/HomeController.php.
 */

use App\Core\Router;

require __DIR__ . '/app/bootstrap.php';                    // sesión, autoload, $pdo, $roles
$rutas = require __DIR__ . '/app/config/routes.php';       // mapa de rutas

$metodo = (string) ($_SERVER['REQUEST_METHOD'] ?? 'GET');
$ruta   = (string) (parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');

// La app corre en un subdirectorio (http://localhost/TP-PROG-WEB-ESCUELA/web-app-escuela/...):
// al Router sólo le interesan las rutas relativas ("/login").
$base = rtrim(str_replace('\\', '/', dirname((string) ($_SERVER['SCRIPT_NAME'] ?? '/index.php'))), '/');

if ($base !== '' && ($ruta === $base || str_starts_with($ruta, $base . '/'))) {
    $ruta = substr($ruta, strlen($base));

    if ($ruta === '' || $ruta[0] !== '/') {
        $ruta = '/' . $ruta;
    }
}

(new Router($rutas))->dispatch($metodo, $ruta);
