<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

/**
 * HomeController — antes, la lógica que vivía directo en index.php (TP10, Fase 0).
 *
 * Sólo redirige según el estado de la sesión: si el rol es válido va al
 * dashboard, si no va al login.
 */
final class HomeController extends Controller
{
    public function index(): void
    {
        global $roles; // matriz cargada en app/bootstrap.php

        $rol = $_SESSION['rol'] ?? null;

        // Fase 0: todavía apuntamos a los archivos viejos (.php). En la Fase 1
        // esto pasa a ser '/dashboard' y '/login' mediante las rutas del Router.
        if (is_string($rol) && isset($roles[$rol])) {
            $this->redirect('dashboard.php');
            return;
        }

        $this->redirect('login.php');
    }
}
