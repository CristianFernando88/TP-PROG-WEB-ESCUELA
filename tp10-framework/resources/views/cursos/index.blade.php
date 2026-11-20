<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Cursos - Colegio Horizonte (Laravel)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; color: #2D5A3F !important; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <div class="bg-success text-white p-2 rounded-3">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <span>Colegio Horizonte <small class="text-muted fw-normal">(Laravel Framework)</small></span>
            </a>
        </div>
    </nav>

    <main class="container">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="fw-bold text-dark m-0" style="font-size: 1.8rem;">Cursos y Divisiones</h1>
                    <p class="text-muted m-0" style="font-size: 0.9rem;">Módulo independiente desarrollado con Laravel (Eloquent ORM y Blade).</p>
                </div>
                <span class="badge bg-success px-3 py-2 rounded-pill">Parte B - TP10</span>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                        <tr>
                            <th class="border-0 pb-3">ID</th>
                            <th class="border-0 pb-3">Grado / Sala</th>
                            <th class="border-0 pb-3">División</th>
                            <th class="border-0 pb-3">Turno</th>
                            <th class="border-0 pb-3">Ciclo Lectivo</th>
                            <th class="border-0 pb-3 text-end">Capacidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cursos as $curso)
                            <tr>
                                <td class="fw-bold text-secondary">#{{ $curso->id_curso }}</td>
                                <td class="fw-bold text-dark">{{ $curso->grado_sala }}</td>
                                <td>{{ $curso->division ?: '-' }}</td>
                                <td>
                                    <span class="badge bg-light text-dark border">{{ $curso->turno }}</span>
                                </td>
                                <td>{{ $curso->ciclo_lectivo }}</td>
                                <td class="text-end fw-semibold">{{ $curso->capacidad }} alumnos</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No hay cursos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
