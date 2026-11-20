<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Router — enrutador del MVC nativo (TP10, Fase 0).
 *
 * Reglas de ruteo (app/config/routes.php):
 *
 *     'GET /login'  => [AuthController::class, 'showLogin'],
 *     'POST /login' => [AuthController::class, 'login'],
 *
 * dispatch() recibe el método HTTP y la ruta ya limpia (sin el prefijo del
 * subdirectorio donde corre la app) y termina llamando al controlador.
 */
final class Router
{
    /** @var array<string, array{0: string, 1: string}> Clave "METODO /ruta" => [controlador, acción] */
    private array $rutas = [];

    /**
     * @param array<string, array{0: string, 1: string}> $rutas
     */
    public function __construct(array $rutas)
    {
        foreach ($rutas as $clave => $handler) {
            if (!is_string($clave) || !is_array($handler) || count($handler) !== 2) {
                throw new \RuntimeException('Ruta mal formada. Uso esperado: \'GET /login\' => [Controlador::class, "accion"].');
            }

            $partes = explode(' ', trim($clave), 2);
            if (count($partes) !== 2 || $partes[0] === '' || $partes[1] === '') {
                throw new \RuntimeException('La ruta debe declarar método y path: ' . $clave);
            }

            [$controlador, $accion] = [$handler[0], $handler[1]];

            if (!is_string($controlador) || !is_string($accion) || $accion === '') {
                throw new \RuntimeException('Handler inválido para la ruta: ' . $clave);
            }

            $metodo = strtoupper($partes[0]);
            $ruta   = $this->normalizarRuta($partes[1]);

            $this->rutas[$metodo . ' ' . $ruta] = [$controlador, $accion];
        }
    }

    /** Resuelve la petición y ejecuta el controlador correspondiente. */
    public function dispatch(string $metodo, string $ruta): void
    {
        $metodo = strtoupper($metodo);
        $ruta   = $this->normalizarRuta($ruta);
        $clave  = $metodo . ' ' . $ruta;

        // HEAD se responde con la misma lógica que GET
        if ($metodo === 'HEAD' && !isset($this->rutas[$clave])) {
            $clave = 'GET ' . $ruta;
        }

        if (!isset($this->rutas[$clave])) {
            $this->responderError($this->codigoDeError($metodo, $ruta), $metodo, $ruta);
            return;
        }

        [$clase, $accion] = $this->rutas[$clave];

        if (!class_exists($clase)) {
            $this->responderError(500, $metodo, $ruta, sprintf(
                'Falta el controlador "%s". Se crea en la Fase 1 del refactor MVC.',
                $clase
            ));
            return;
        }

        if (!method_exists($clase, $accion)) {
            $this->responderError(500, $metodo, $ruta, sprintf(
                'El controlador "%s" no tiene el método "%s".',
                $clase,
                $accion
            ));
            return;
        }

        $controlador = new $clase();
        $controlador->{$accion}();
    }

    /** 405 si la ruta existe con otro método; 404 en cualquier otro caso. */
    private function codigoDeError(string $metodo, string $ruta): int
    {
        foreach (array_keys($this->rutas) as $clave) {
            [$m, $r] = explode(' ', $clave, 2);
            if ($r === $ruta && $m !== $metodo) {
                return 405;
            }
        }

        return 404;
    }

    private function normalizarRuta(string $ruta): string
    {
        // Quitar extensión .php si viene en la URL (compatibilidad con enlaces viejos)
        $ruta = preg_replace('/\.php$/i', '', $ruta);
        $ruta = '/' . trim($ruta, '/');

        return $ruta === '' ? '/' : $ruta;
    }

    private function responderError(int $codigo, string $metodo, string $ruta, ?string $mensaje = null): void
    {
        http_response_code($codigo);
        header('Content-Type: text/html; charset=utf-8');

        $titulo   = match ($codigo) {
            405    => 'Método no permitido',
            500    => 'Error de la aplicación',
            default => 'Página no encontrada',
        };
        $detalle  = htmlspecialchars($metodo . ' ' . $ruta, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

        if ($mensaje !== null) {
            // Se registra el detalle para depurar; la página muestra un texto legible
            error_log('Router: ' . $mensaje . ' [' . $metodo . ' ' . $ruta . ']');
            $sugerencia = htmlspecialchars($mensaje, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        } else {
            $sugerencia = $codigo === 405
                ? 'Esa ruta existe, pero no con ese método HTTP.'
                : 'Revisá la dirección o <a href="./">volvé al inicio</a>.';
        }

        echo '<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>' . $titulo . ' - Colegio Horizonte</title>
<style>
    body{font-family:system-ui,-apple-system,"Segoe UI",sans-serif;background:#f5f6f7;color:#1f2933;display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0}
    main{max-width:34rem;padding:2rem;text-align:center}
    code{background:#e4e7eb;padding:.15rem .4rem;border-radius:.3rem}
    a{color:#2d5a3f}
</style>
</head>
<body>
<main>
    <h1 style="font-size:1.4rem;margin-bottom:.5rem">' . $titulo . '</h1>
    <p>Ruta <code>' . $detalle . '</code></p>
    <p style="color:#616e7c;font-size:.9rem">' . $sugerencia . '</p>
</main>
</body>
</html>';
        exit;
    }
}
