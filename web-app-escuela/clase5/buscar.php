<?php
declare(strict_types=1);

require_once __DIR__ . '/_bootstrap.php';

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
            <input type="text" name="q" placeholder="Nombre de la materia..." class="form-control" id="q">
        </div>
        <div class="col-md-6">
            <label for="nivel" class="form-label">Nivel</label>
            <select name="nivel" class="form-select" id="nivel">
                <option value="">Todos los niveles</option>
                <option value="inicial">Inicial</option>
                <option value="primario">Primario</option>
                <option value="secundario">Secundario</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="turno" class="form-label">Turno</label>
            <select name="turno" class="form-select" id="turno">
                <option value="">Todos los turnos</option>
                <option value="manana">Mañana</option>
                <option value="tarde">Tarde</option>
            </select>
        </div>
        <div class="col-12 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a class="btn btn-outline-secondary" href="<?= htmlspecialchars(c5_url('buscar.php'), ENT_QUOTES, 'UTF-8') ?>">Limpiar</a>
        </div>
    </form>

    <hr>
    <div id="resultados">
        <p class="text-muted">Ingresá un criterio para ver resultados.</p>
    </div>
</main>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
