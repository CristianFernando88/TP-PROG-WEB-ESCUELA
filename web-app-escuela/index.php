<?php
declare(strict_types=1);

session_start();

$roles = require __DIR__ . '/config/roles.php';
$role = $_SESSION['rol'] ?? null;

if (is_string($role) && isset($roles[$role])) {
    header('Location: dashboard.php');
    exit;
}

header('Location: login.php');
exit;