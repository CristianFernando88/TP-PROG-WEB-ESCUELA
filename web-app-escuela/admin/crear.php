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

$currentUser = appRequireRoleAccess('alumnos');
$titulo_pagina = 'Agregar Nuevo Alumno - Admin';
$errores = [];
$nombre = '';
$apellido = '';
$estado = 'activo';
$cursoId = '';

$stmtCursos = $pdo->query(
    "SELECT c.id_curso, c.grado_sala, c.division, c.turno, n.nombre AS nivel
     FROM cursos AS c
     INNER JOIN niveles AS n ON n.id_nivel = c.id_nivel
     ORDER BY c.grado_sala ASC, c.division ASC"
);
$cursos = $stmtCursos->fetchAll();
$cursosDisponibles = array_map(
    static fn (array $curso): int => (int) $curso['id_curso'],
    $cursos
);

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $nombrePost = $_POST['nombre'] ?? null;
    $apellidoPost = $_POST['apellido'] ?? null;
    $estadoPost = $_POST['estado'] ?? null;
    $cursoPost = $_POST['curso_id'] ?? null;

    $nombre = is_string($nombrePost) ? trim($nombrePost) : '';
    $apellido = is_string($apellidoPost) ? trim($apellidoPost) : '';
    $estado = is_string($estadoPost) ? trim($estadoPost) : '';
    $cursoIdPost = is_string($cursoPost) ? filter_var($cursoPost, FILTER_VALIDATE_INT) : false;
    $cursoId = $cursoIdPost !== false && $cursoIdPost > 0 ? (string) $cursoIdPost : '';

    if ($nombre === '') {
        $errores[] = 'El nombre es obligatorio.';
    }

    if ($apellido === '') {
        $errores[] = 'El apellido es obligatorio.';
    }

    if (!in_array($estado, ['activo', 'inactivo'], true)) {
        $errores[] = 'Seleccione un estado válido.';
        $estado = 'activo';
    }

    if ($cursoId === '' || !in_array((int) $cursoId, $cursosDisponibles, true)) {
        $errores[] = 'Seleccione un curso válido.';
        $cursoId = '';
    }

    if ($errores === []) {
        $stmt = $pdo->prepare(
            'INSERT INTO alumnos (nombre, apellido, estado, id_curso)
             VALUES (:nombre, :apellido, :estado, :id_curso)'
        );
        $stmt->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':estado' => $estado,
            ':id_curso' => (int) $cursoId,
        ]);

        header('Location: index.php?status=created');
        exit;
    }
}

require_once __DIR__ . '/../includes/header.php';
?>
<div class="d-flex flex-column flex-lg-row min-vh-100 bg-light">
    <?php require_once __DIR__ . '/../includes/nav.php'; ?>

    <div class="flex-grow-1 p-4 overflow-auto">
        <main class="container-fluid">
            <h2 class="mb-4">Agregar Nuevo Alumno</h2>

            <?php if ($errores !== []): ?>
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0">
                        <?php foreach ($errores as $error): ?>
                            <li><?= htmlspecialchars($error, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ($cursos === []): ?>
                <div class="alert alert-warning" role="alert">No hay cursos disponibles para asignar.</div>
            <?php endif; ?>

            <form method="POST" action="crear.php" class="row g-3">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input
                        type="text"
                        name="nombre"
                        id="nombre"
                        required
                        class="form-control"
                        value="<?= htmlspecialchars($nombre, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>"
                    >
                </div>
                <div class="col-md-6">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input
                        type="text"
                        name="apellido"
                        id="apellido"
                        required
                        class="form-control"
                        value="<?= htmlspecialchars($apellido, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>"
                    >
                </div>
                <div class="col-md-6">
                    <label for="estado" class="form-label">Estado</label>
                    <select name="estado" id="estado" class="form-select">
                        <option value="activo"<?= $estado === 'activo' ? ' selected' : '' ?>>Activo</option>
                        <option value="inactivo"<?= $estado === 'inactivo' ? ' selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="curso_id" class="form-label">Curso</label>
                    <select name="curso_id" id="curso_id" class="form-select" required>
                        <option value="">Seleccione un curso...</option>
                        <?php foreach ($cursos as $curso): ?>
                            <?php
                            $cursoLabel = trim($curso['grado_sala'] . ' ' . $curso['division'])
                                . ' - ' . $curso['nivel']
                                . ' (' . ($curso['turno'] === 'manana' ? 'Mañana' : 'Tarde') . ')';
                            ?>
                            <option value="<?= (int) $curso['id_curso'] ?>"<?= $cursoId === (string) $curso['id_curso'] ? ' selected' : '' ?>>
                                <?= htmlspecialchars($cursoLabel, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-success"<?= $cursos === [] ? ' disabled' : '' ?>>Guardar Alumno</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </main>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
