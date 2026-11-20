<?php
declare(strict_types=1);

$requerirPermiso = 'alumnos';
require_once __DIR__ . '/../auth_guard.php';
require_once __DIR__ . '/../config/conexion.php';

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
