<?php
declare(strict_types=1);

return [
    'admin' => [
        'name' => 'Sofía Méndez',
        'title' => 'Administración general',
        'initials' => 'SM',
        'permissions' => ['dashboard', 'alumnos', 'niveles', 'materias'],
        'summary' => 'Este es el resumen de la comunidad educativa hoy.',
        'primary_action' => ['label' => 'Gestionar alumnos', 'href' => 'alumnos.php', 'permission' => 'alumnos'],
        'metrics' => [
            ['label' => 'Alumnos activos', 'value' => '1.284', 'note' => '+32 este mes', 'icon' => 'bi-people'],
            ['label' => 'Docentes', 'value' => '86', 'note' => '+4 incorporaciones', 'icon' => 'bi-mortarboard'],
            ['label' => 'Cursos activos', 'value' => '42', 'note' => '3 niveles', 'icon' => 'bi-layers'],
            ['label' => 'Asistencia hoy', 'value' => '94,8%', 'note' => '+1,2% vs. ayer', 'icon' => 'bi-check2-circle'],
        ],
        'activity_title' => 'Actividad reciente',
        'activity_description' => 'Últimos movimientos del sistema',
        'activity' => [
            ['initials' => 'LM', 'title' => 'Lucía Molina fue matriculada', 'context' => '1.º A • Nivel Primario', 'time' => 'Hace 12 min'],
            ['initials' => 'FG', 'title' => 'Federico Gómez actualizó notas', 'context' => 'Matemática • 3.º B', 'time' => 'Hace 38 min'],
            ['initials' => 'AR', 'title' => 'Ana Ruiz creó un nuevo curso', 'context' => 'Sala de 4 • Turno tarde', 'time' => 'Hace 1 h'],
        ],
        'quick_links' => [
            ['title' => 'Alumnos y matrícula', 'description' => 'Consultar y gestionar estudiantes', 'icon' => 'bi-people', 'href' => 'alumnos.php', 'permission' => 'alumnos'],
            ['title' => 'Niveles y cursos', 'description' => 'Ver la estructura académica', 'icon' => 'bi-layers', 'href' => 'niveles.php', 'permission' => 'niveles'],
            ['title' => 'Materias', 'description' => 'Consultar materias y asignaciones', 'icon' => 'bi-book', 'href' => 'materias.php', 'permission' => 'materias'],
        ],
    ],
    'directivo' => [
        'name' => 'Marcela Fernández',
        'title' => 'Equipo directivo',
        'initials' => 'MF',
        'permissions' => ['dashboard', 'alumnos', 'niveles', 'materias'],
        'summary' => 'Consultá el estado general de la institución.',
        'primary_action' => ['label' => 'Ver niveles y cursos', 'href' => 'niveles.php', 'permission' => 'niveles'],
        'metrics' => [
            ['label' => 'Alumnos activos', 'value' => '1.284', 'note' => 'Comunidad educativa', 'icon' => 'bi-people'],
            ['label' => 'Cursos activos', 'value' => '42', 'note' => '3 niveles', 'icon' => 'bi-layers'],
            ['label' => 'Asistencia hoy', 'value' => '94,8%', 'note' => 'Indicador institucional', 'icon' => 'bi-check2-circle'],
        ],
        'activity_title' => 'Novedades institucionales',
        'activity_description' => 'Resumen de actividad reciente',
        'activity' => [
            ['initials' => 'LM', 'title' => 'Nueva matrícula registrada', 'context' => '1.º A • Nivel Primario', 'time' => 'Hace 12 min'],
            ['initials' => 'FG', 'title' => 'Se actualizaron calificaciones', 'context' => 'Matemática • 3.º B', 'time' => 'Hace 38 min'],
            ['initials' => 'AR', 'title' => 'Se creó un nuevo curso', 'context' => 'Sala de 4 • Turno tarde', 'time' => 'Hace 1 h'],
        ],
        'quick_links' => [
            ['title' => 'Alumnos y matrícula', 'description' => 'Consultar estudiantes', 'icon' => 'bi-people', 'href' => 'alumnos.php', 'permission' => 'alumnos'],
            ['title' => 'Niveles y cursos', 'description' => 'Consultar estructura académica', 'icon' => 'bi-layers', 'href' => 'niveles.php', 'permission' => 'niveles'],
            ['title' => 'Materias', 'description' => 'Consultar asignaciones', 'icon' => 'bi-book', 'href' => 'materias.php', 'permission' => 'materias'],
        ],
    ],
    'preceptor' => [
        'name' => 'Carla Núñez',
        'title' => 'Preceptoría',
        'initials' => 'CN',
        'permissions' => ['dashboard', 'alumnos', 'niveles'],
        'summary' => 'Este es el seguimiento de tus cursos y estudiantes.',
        'primary_action' => ['label' => 'Consultar alumnos', 'href' => 'alumnos.php', 'permission' => 'alumnos'],
        'metrics' => [
            ['label' => 'Alumnos a cargo', 'value' => '128', 'note' => 'Cursos asignados', 'icon' => 'bi-people'],
            ['label' => 'Cursos asignados', 'value' => '6', 'note' => 'Turno mañana', 'icon' => 'bi-layers'],
            ['label' => 'Asistencia pendiente', 'value' => '12', 'note' => 'Para revisar', 'icon' => 'bi-clipboard-check'],
        ],
        'activity_title' => 'Seguimiento de cursos',
        'activity_description' => 'Novedades de preceptoría',
        'activity' => [
            ['initials' => '1A', 'title' => 'Asistencia pendiente de revisión', 'context' => '1.º A • Turno mañana', 'time' => 'Hoy'],
            ['initials' => '3B', 'title' => 'Se registró una novedad', 'context' => '3.º B • Turno mañana', 'time' => 'Hace 25 min'],
        ],
        'quick_links' => [
            ['title' => 'Alumnos y matrícula', 'description' => 'Consultar estudiantes', 'icon' => 'bi-people', 'href' => 'alumnos.php', 'permission' => 'alumnos'],
            ['title' => 'Niveles y cursos', 'description' => 'Consultar cursos asignados', 'icon' => 'bi-layers', 'href' => 'niveles.php', 'permission' => 'niveles'],
        ],
    ],
    'profesor' => [
        'name' => 'Federico Gómez',
        'title' => 'Docente',
        'initials' => 'FG',
        'permissions' => ['dashboard', 'materias'],
        'summary' => 'Este es el resumen académico de tus cursadas.',
        'primary_action' => ['label' => 'Ver materias', 'href' => 'materias.php', 'permission' => 'materias'],
        'metrics' => [
            ['label' => 'Materias asignadas', 'value' => '4', 'note' => 'Ciclo lectivo 2025', 'icon' => 'bi-book'],
            ['label' => 'Cursos a cargo', 'value' => '3', 'note' => 'Asignaciones activas', 'icon' => 'bi-layers'],
            ['label' => 'Evaluaciones pendientes', 'value' => '8', 'note' => 'Para completar', 'icon' => 'bi-journal-check'],
        ],
        'activity_title' => 'Actividad académica',
        'activity_description' => 'Novedades de tus cursadas',
        'activity' => [
            ['initials' => '3B', 'title' => 'Evaluaciones pendientes de cargar', 'context' => 'Matemática • 3.º B', 'time' => 'Hoy'],
            ['initials' => '2A', 'title' => 'Próxima clase', 'context' => 'Matemática • 2.º A', 'time' => '10:30'],
        ],
        'quick_links' => [
            ['title' => 'Mis materias', 'description' => 'Consultar materias y asignaciones', 'icon' => 'bi-book', 'href' => 'materias.php', 'permission' => 'materias'],
        ],
    ],
    'tutor' => [
        'name' => 'Lucía Costa',
        'title' => 'Tutor/a',
        'initials' => 'LC',
        'permissions' => ['dashboard', 'hijos'],
        'summary' => 'Consultá las novedades académicas de tus estudiantes vinculados.',
        'primary_action' => null,
        'metrics' => [
            ['label' => 'Estudiantes vinculados', 'value' => '2', 'note' => 'A tu cargo', 'icon' => 'bi-people'],
            ['label' => 'Próxima actividad', 'value' => 'Mañana', 'note' => 'Reunión escolar', 'icon' => 'bi-calendar-event'],
            ['label' => 'Comunicados nuevos', 'value' => '3', 'note' => 'Para revisar', 'icon' => 'bi-chat-left-text'],
        ],
        'activity_title' => 'Novedades de tus estudiantes',
        'activity_description' => 'Información de ejemplo para la vista de tutor',
        'activity' => [
            ['initials' => 'EC', 'title' => 'Nuevo comunicado escolar', 'context' => 'Emma • Nivel Primario', 'time' => 'Hoy'],
            ['initials' => 'TC', 'title' => 'Asistencia actualizada', 'context' => 'Tomás • Nivel Secundario', 'time' => 'Ayer'],
        ],
        'quick_links' => [
            ['title' => 'Mis Hijos', 'description' => 'Consultar información académica', 'icon' => 'bi-people', 'href' => 'hijos.php', 'permission' => 'hijos'],
        ],
        'children' => [
            [
                'name' => 'Emma Costa',
                'initials' => 'EC',
                'course' => '3.º A • Nivel Primario',
                'attendance' => '96%',
                'average' => '8,7',
                'updates' => 'Asistencia registrada hoy',
            ],
            [
                'name' => 'Tomás Costa',
                'initials' => 'TC',
                'course' => '1.º B • Nivel Secundario',
                'attendance' => '93%',
                'average' => '8,2',
                'updates' => 'Última calificación: Matemática',
            ],
        ],
    ],
];
