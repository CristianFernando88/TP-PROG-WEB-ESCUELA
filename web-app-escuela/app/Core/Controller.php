<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Controller — clase base de los controladores (TP10, Fase 0).
 *
 * Un controlador sólo decide QUÉ pasa: valida la petición, le pide datos al
 * modelo y elige entre redirigir o mostrar una vista. Nunca escribe SQL ni
 * HTML directamente.
 */
abstract class Controller
{
    /**
     * Renderiza una vista de app/Views/ pasándole sólo datos ya saneados.
     * Las vistas se encargan de escapar con htmlspecialchars() al imprimir.
     *
     * Ejemplo: $this->view('auth/login', ['error' => 'Correo o contraseña incorrectos.']);
     */
    protected function view(string $vista, array $datos = []): void
    {
        $archivo = APP_PATH . '/Views/' . $vista . '.php';

        if (!is_file($archivo)) {
            throw new \RuntimeException('No existe la vista: app/Views/' . $vista . '.php');
        }

        extract($datos, EXTR_SKIP);
        require $archivo;
    }

    /**
     * Redirección 302. Se usa con el patrón PRG (Post/Redirect/Get):
     * después de un POST exitoso nunca se renderiza una vista, sino que se
     * redirige para evitar el reenvío del formulario al recargar.
     */
    protected function redirect(string $ruta): void
    {
        header('Location: ' . $ruta, true, 302);
        exit;
    }
}
