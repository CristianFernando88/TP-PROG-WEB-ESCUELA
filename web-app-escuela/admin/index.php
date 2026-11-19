<?php
declare(strict_types=1);

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

$currentUser = appRequireRoleAccess('alumnos');
require_once __DIR__ . '/../config/conexion.php';

$titulo_pagina = 'Gestión de Alumnos - Admin';

$stmt = $pdo->query(
    "SELECT a.id_alumno, a.nombre, a.apellido, a.estado,
            CONCAT_WS(' ', c.grado_sala, NULLIF(c.division, '')) AS curso
     FROM alumnos AS a
     LEFT JOIN cursos AS c ON a.id_curso = c.id_curso
     ORDER BY a.apellido ASC"
);
$alumnos = $stmt->fetchAll();

require_once __DIR__ . '/../includes/header.php';
?>
<div class="d-flex flex-column flex-lg-row min-vh-100 bg-light">
    <?php require_once __DIR__ . '/../includes/nav.php'; ?>

    <div class="flex-grow-1 p-4 overflow-auto">
        <main class="container-fluid">
            <h2 class="mb-4">Gestión de Alumnos</h2>

            <a href="crear.php" class="btn btn-primary mb-3">Agregar Nuevo Alumno</a>

            <?php if ($alumnos === []): ?>
                <div class="alert alert-info">No hay alumnos registrados en el sistema.</div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered align-middle">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Curso</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($alumnos as $alumno): ?>
                                <?php $alumnoId = (int) $alumno['id_alumno']; ?>
                                <tr>
                                    <td><?= htmlspecialchars((string) $alumnoId, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($alumno['apellido'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($alumno['nombre'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($alumno['curso'] !== '' ? $alumno['curso'] : 'Sin curso asignado', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($alumno['estado'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></td>
                                    <td class="text-nowrap">
                                        <a href="editar.php?id=<?= $alumnoId ?>" class="btn btn-sm btn-warning">Editar</a>
                                        <a href="eliminar.php?id=<?= $alumnoId ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que desea eliminar a este alumno?')">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </main>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
