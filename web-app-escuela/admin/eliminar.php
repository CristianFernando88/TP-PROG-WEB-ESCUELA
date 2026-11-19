<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../includes/auth.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$roles = require __DIR__ . '/../config/roles.php';
$sessionRole = $_SESSION['rol'] ?? null;

if (!is_string($sessionRole) || !isset($roles[$sessionRole])) {
    $_SESSION = [];
    session_destroy();
    header('Location: ../login.php');
    exit;
}

appRequireRoleAccess('alumnos');

$idInput = $_GET['id'] ?? null;
$id = is_string($idInput) ? filter_var($idInput, FILTER_VALIDATE_INT) : false;

if ($id === false || $id < 1) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('DELETE FROM alumnos WHERE id_alumno = :id');
$stmt->execute([':id' => $id]);

header('Location: index.php?status=deleted');
exit;
