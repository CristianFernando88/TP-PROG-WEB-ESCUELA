<?php
declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\HomeController;

/**
 * Rutas de la aplicación (TP10, Fase 0).
 *
 * Formato: 'METODO /ruta' => [Controlador::class, 'accion'].
 * La ruta se compara sin el prefijo del subdirectorio donde corre la app
 * (http://localhost/TP-PROG-WEB-ESCUELA/web-app-escuela/ → "/login").
 *
 * OJO: AuthController todavía no existe (se crea en la Fase 1). Mientras
 * tanto, las URLs viejas con extensión (.php) siguen funcionando porque el
 * .htaccess sólo deriva al Front Controller los pedidos que no son archivos
 * reales.
 */
return [
    // Reemplaza al index.php viejo (redirigía por rol)
    'GET /' => [HomeController::class, 'index'],

    // Autenticación — se migra en la Fase 1
    'GET /login'     => [AuthController::class, 'showLogin'],
    'POST /login'    => [AuthController::class, 'login'],
    'GET /registro'  => [AuthController::class, 'showRegister'],
    'POST /registro' => [AuthController::class, 'register'],
    'POST /logout'   => [AuthController::class, 'logout'],
];
