<?php
declare(strict_types=1);

/**
 * includes/auth.php — helpers de permisos (TP8)
 *
 * La protección de rutas vive en web-app-escuela/auth_guard.php, que debe
 * incluirse en cada vista protegida. Este archivo sólo expone
 * appHasPermission(), que usan includes/nav.php y dashboard.php para
 * mostrar u ocultar elementos según el rol activo.
 */

function appHasPermission(array $user, string $permission): bool
{
    return in_array($permission, $user['permissions'] ?? [], true);
}
