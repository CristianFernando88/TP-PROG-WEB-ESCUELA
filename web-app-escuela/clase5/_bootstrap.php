<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/env.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/auth.php';

if (!defined('C5_BASE_URL')) {
    define(
        'C5_BASE_URL',
        defined('APP_BASE_URL') && APP_BASE_URL !== '' ? rtrim(APP_BASE_URL, '/') : ''
    );
}

$roles = require __DIR__ . '/../config/roles.php';
$sessionRole = $_SESSION['rol'] ?? null;
$currentUser = is_string($sessionRole) && isset($roles[$sessionRole])
    ? $roles[$sessionRole]
    : ['permissions' => []];

function c5_url(string $path = ''): string
{
    $path = ltrim($path, '/');
    $relativePath = 'clase5' . ($path === '' ? '/' : '/' . $path);

    return C5_BASE_URL === '' ? $relativePath : C5_BASE_URL . '/' . $relativePath;
}
