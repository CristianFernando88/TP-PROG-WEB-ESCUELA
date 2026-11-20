<?php
declare(strict_types=1);

$requerirPermiso = 'alumnos';
require_once __DIR__ . '/../auth_guard.php';
require_once __DIR__ . '/../config/conexion.php';

$titulo_pagina = 'Gestión de Alumnos - Admin';

$q = isset($_GET['q']) && is_string($_GET['q']) ? trim($_GET['q']) : '';
$query = "SELECT a.id_alumno, a.nombre, a.apellido, a.estado,
                 CONCAT_WS(' ', c.grado_sala, NULLIF(c.division, '')) AS curso
          FROM alumnos AS a
          LEFT JOIN cursos AS c ON a.id_curso = c.id_curso";

if ($q !== '') {
    $stmt = $pdo->prepare(
        $query . ' WHERE a.nombre LIKE :nombre OR a.apellido LIKE :apellido ORDER BY a.apellido ASC, a.nombre ASC'
    );
    $term = '%' . $q . '%';
    $stmt->execute([
        ':nombre' => $term,
        ':apellido' => $term,
    ]);
} else {
    $stmt = $pdo->prepare($query . ' ORDER BY a.apellido ASC, a.nombre ASC');
    $stmt->execute();
}

$alumnos = $stmt->fetchAll();

require_once __DIR__ . '/../includes/header.php';
?>
<div class="d-flex flex-column flex-lg-row min-vh-100 bg-light">
    <?php require_once __DIR__ . '/../includes/nav.php'; ?>

    <div class="flex-grow-1 p-4 overflow-auto">
        <main class="container-fluid">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 bg-white p-3 rounded-4 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success text-white fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                        <?= htmlspecialchars($currentUser['initials'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                    </div>
                    <div>
                        <span class="d-block fw-bold text-dark" style="font-size: 0.85rem; line-height: 1.1;"><?= htmlspecialchars($currentUser['name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span>
                        <span class="d-block text-muted" style="font-size: 0.7rem;"><?= htmlspecialchars($currentUser['title'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span>
                    </div>
                </div>
                <a href="../logout.php" class="btn btn-outline-success btn-sm d-flex align-items-center gap-2 ms-auto" aria-label="Cerrar sesión">
                    <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
                    <span class="d-none d-sm-inline">Cerrar sesión</span>
                </a>
            </div>

            <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
                <div>
                    <h1 class="fw-bold text-dark m-0" style="font-size: 2rem;">Alumnos y matrícula</h1>
                    <p class="text-muted m-0" style="font-size: 0.9rem;">Gestioná estudiantes, familias y vínculos.</p>
                </div>
                <a href="crear.php" class="btn text-white px-4 py-2 rounded-3 fw-semibold shadow-sm d-flex align-items-center gap-2" style="background-color: #2D5A3F;">
                    <i class="bi bi-person-plus-fill" aria-hidden="true"></i>
                    Matricular alumno
                </a>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <form method="GET" action="index.php" class="row g-3 mb-4">
                        <div class="col-md-8">
                            <label for="q" class="visually-hidden">Buscar alumnos</label>
                            <input
                                type="search"
                                name="q"
                                id="q"
                                class="form-control bg-light py-2"
                                placeholder="Buscar por nombre o apellido..."
                                value="<?= htmlspecialchars($q, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>"
                            >
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                                <i class="bi bi-search" aria-hidden="true"></i>
                                Buscar
                            </button>
                            <?php if ($q !== ''): ?>
                                <a href="index.php" class="btn btn-outline-secondary">Limpiar</a>
                            <?php endif; ?>
                        </div>
                    </form>

                    <?php if ($alumnos === []): ?>
                        <div class="alert alert-info mb-0">No hay alumnos que coincidan con la búsqueda.</div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle mb-0">
                                <thead>
                                    <tr class="text-muted text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                                        <th scope="col" class="border-0 pb-3">Alumno</th>
                                        <th scope="col" class="border-0 pb-3">Curso</th>
                                        <th scope="col" class="border-0 pb-3">Estado</th>
                                        <th scope="col" class="border-0 pb-3 text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($alumnos as $alumno): ?>
                                        <?php
                                        $alumnoId = (int) $alumno['id_alumno'];
                                        $iniciales = strtoupper(
                                            substr($alumno['nombre'], 0, 1) . substr($alumno['apellido'], 0, 1)
                                        );
                                        $estadoActivo = $alumno['estado'] === 'activo';
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="bg-light text-success fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-size: 0.8rem;">
                                                        <?= htmlspecialchars($iniciales, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                                                    </div>
                                                    <span class="fw-bold text-dark">
                                                        <?= htmlspecialchars($alumno['nombre'] . ' ' . $alumno['apellido'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                                                    </span>
                                                </div>
                                            </td>
                                            <td><?= htmlspecialchars($alumno['curso'] !== '' ? $alumno['curso'] : 'Sin curso asignado', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></td>
                                            <td>
                                                <span class="badge <?= $estadoActivo ? 'bg-success' : 'bg-secondary' ?>">
                                                    <?= htmlspecialchars(ucfirst($alumno['estado']), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                                                </span>
                                            </td>
                                            <td class="text-end text-nowrap">
                                                <a href="editar.php?id=<?= $alumnoId ?>" class="btn btn-sm btn-warning" aria-label="Editar alumno" title="Editar">
                                                    <i class="bi bi-pencil" aria-hidden="true"></i>
                                                </a>
                                                <a href="eliminar.php?id=<?= $alumnoId ?>" class="btn btn-sm btn-danger" aria-label="Eliminar alumno" title="Eliminar" onclick="return confirm('¿Seguro que desea eliminar a este alumno?')">
                                                    <i class="bi bi-trash" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
