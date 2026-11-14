<?php
declare(strict_types=1);

function appRequireRoleAccess(string $permission): array
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $roles = require __DIR__ . '/../config/roles.php';
    $role = $_SESSION['rol'] ?? null;

    if (!is_string($role) || !isset($roles[$role])) {
        $_SESSION = [];
        session_destroy();
        header('Location: login.php');
        exit;
    }

    $user = $roles[$role];

    if (!in_array($permission, $user['permissions'], true)) {
        http_response_code(403);
        exit('No tenés permiso para acceder a esta sección.');
    }

    $user['role'] = $role;

    return $user;
}

function appHasPermission(array $user, string $permission): bool
{
    return in_array($permission, $user['permissions'] ?? [], true);
}
