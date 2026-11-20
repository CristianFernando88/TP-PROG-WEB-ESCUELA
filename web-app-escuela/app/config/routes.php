<?php
declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\HomeController;

return [
    'GET /'          => [HomeController::class, 'index'],
    'GET /login'     => [AuthController::class, 'showLogin'],
    'POST /login'    => [AuthController::class, 'login'],
    'GET /registro'  => [AuthController::class, 'showRegister'],
    'POST /registro' => [AuthController::class, 'register'],
    'GET /logout'    => [AuthController::class, 'logout'],
    'POST /logout'   => [AuthController::class, 'logout'],
];
