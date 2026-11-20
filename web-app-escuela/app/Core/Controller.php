<?php
declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    protected function view(string $vista, array $datos = []): void
    {
        $archivo = APP_PATH . '/Views/' . $vista . '.php';
        if (!is_file($archivo)) {
            throw new \RuntimeException('No existe la vista: ' . $archivo);
        }
        extract($datos, EXTR_SKIP);
        require $archivo;
    }

    protected function redirect(string $ruta): void
    {
        if (str_starts_with($ruta, 'http://') || str_starts_with($ruta, 'https://') || str_starts_with($ruta, '//')) {
            $location = $ruta;
        } else {
            $base = defined('BASE_PATH') ? BASE_PATH : '/TP-PROG-WEB-ESCUELA/web-app-escuela';
            $location = rtrim($base, '/') . '/' . ltrim($ruta, '/');
        }
        header('Location: ' . $location, true, 302);
        exit;
    }
}