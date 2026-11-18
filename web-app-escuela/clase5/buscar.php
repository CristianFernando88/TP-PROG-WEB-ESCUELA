<?php
declare(strict_types=1);

require_once __DIR__ . '/_bootstrap.php';
require_once __DIR__ . '/_helpers.php';

$busqueda = [
    'q' => '',
    'nivel' => '',
    'turno' => '',
];
$resultados = [];
$buscado = false;

if (
    ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'GET'
    && (isset($_GET['q']) || isset($_GET['nivel']) || isset($_GET['turno']))
) {
    $buscado = true;
    $busqueda['q'] = c5_sanitizar_texto(is_string($_GET['q'] ?? null) ? $_GET['q'] : null);
    $busqueda['nivel'] = c5_sanitizar_texto(is_string($_GET['nivel'] ?? null) ? $_GET['nivel'] : null);
    $busqueda['turno'] = c5_sanitizar_texto(is_string($_GET['turno'] ?? null) ? $_GET['turno'] : null);

    $materias = [
        ['nombre' => 'Matemática', 'nivel' => 'secundario', 'turno' => 'manana'],
        ['nombre' => 'Lengua y Literatura', 'nivel' => 'secundario', 'turno' => 'tarde'],
        ['nombre' => 'Ciencias Naturales', 'nivel' => 'primario', 'turno' => 'manana'],
        ['nombre' => 'Historia', 'nivel' => 'secundario', 'turno' => 'manana'],
        ['nombre' => 'Educación Física', 'nivel' => 'primario', 'turno' => 'tarde'],
        ['nombre' => 'Salas de 4', 'nivel' => 'inicial', 'turno' => 'manana'],
        ['nombre' => 'Salas de 5', 'nivel' => 'inicial', 'turno' => 'tarde'],
    ];

    $textoBusqueda = html_entity_decode($busqueda['q'], ENT_QUOTES, 'UTF-8');
    $resultados = array_values(array_filter(
        $materias,
        static function (array $materia) use ($busqueda, $textoBusqueda): bool {
            if ($textoBusqueda !== '' && stripos($materia['nombre'], $textoBusqueda) === false) {
                return false;
            }

            if ($busqueda['nivel'] !== '' && $materia['nivel'] !== $busqueda['nivel']) {
                return false;
            }

            if ($busqueda['turno'] !== '' && $materia['turno'] !== $busqueda['turno']) {
                return false;
            }

            return true;
        }
    ));
}

$titulo_pagina = 'Buscar materias - Clase 5';

require_once __DIR__ . '/../includes/header.php';
?>
<div class="d-flex flex-column flex-lg-row min-vh-100 bg-light">
    <?php require_once __DIR__ . '/../includes/nav.php'; ?>
    <div class="flex-grow-1 p-4 overflow-auto">
<main class="container my-5">
    <h1>Buscador de materias</h1>
    <p>Formulario GET. Los filtros se envían por URL.</p>

    <form method="get" action="<?= htmlspecialchars(c5_url('buscar.php'), ENT_QUOTES, 'UTF-8') ?>" class="row g-3">
        <div class="col-md-6">
            <label for="q" class="form-label">Materia</label>
            <input type="text" name="q" placeholder="Nombre de la materia..." class="form-control" id="q" value="<?= htmlspecialchars($busqueda['q'], ENT_QUOTES, 'UTF-8', false) ?>">
        </div>
        <div class="col-md-6">
            <label for="nivel" class="form-label">Nivel</label>
            <select name="nivel" class="form-select" id="nivel">
                <option value=""<?= $busqueda['nivel'] === '' ? ' selected' : '' ?>>Todos los niveles</option>
                <option value="inicial"<?= $busqueda['nivel'] === 'inicial' ? ' selected' : '' ?>>Inicial</option>
                <option value="primario"<?= $busqueda['nivel'] === 'primario' ? ' selected' : '' ?>>Primario</option>
                <option value="secundario"<?= $busqueda['nivel'] === 'secundario' ? ' selected' : '' ?>>Secundario</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="turno" class="form-label">Turno</label>
            <select name="turno" class="form-select" id="turno">
                <option value=""<?= $busqueda['turno'] === '' ? ' selected' : '' ?>>Todos los turnos</option>
                <option value="manana"<?= $busqueda['turno'] === 'manana' ? ' selected' : '' ?>>Mañana</option>
                <option value="tarde"<?= $busqueda['turno'] === 'tarde' ? ' selected' : '' ?>>Tarde</option>
            </select>
        </div>
        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a class="btn btn-outline-secondary" href="<?= htmlspecialchars(c5_url('buscar.php'), ENT_QUOTES, 'UTF-8') ?>">Limpiar</a>
        </div>
    </form>

    <hr>
    <div id="resultados">
        <?php if (!$buscado): ?>
            <p class="text-muted">Ingresá un criterio para ver resultados.</p>
        <?php else: ?>
            <?php if ($busqueda['q'] !== ''): ?>
                <h2 class="h5">Resultados para: <?= htmlspecialchars($busqueda['q'], ENT_QUOTES, 'UTF-8', false) ?></h2>
            <?php else: ?>
                <h2 class="h5">Resultados</h2>
            <?php endif; ?>
            <?php if ($resultados === []): ?>
                <div class="alert alert-warning" role="alert">No se encontraron materias con esos filtros.</div>
            <?php else: ?>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Materia</th>
                            <th scope="col">Nivel</th>
                            <th scope="col">Turno</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultados as $materia): ?>
                            <tr>
                                <td><?= htmlspecialchars($materia['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars(ucfirst($materia['nivel']), ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($materia['turno'] === 'manana' ? 'Mañana' : 'Tarde', ENT_QUOTES, 'UTF-8') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</main>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
