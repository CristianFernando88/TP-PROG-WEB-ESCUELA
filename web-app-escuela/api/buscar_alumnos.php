<?php
declare(strict_types=1);

// TP9 - API JSON: el header se envía siempre antes que cualquier otra salida
header('Content-Type: application/json; charset=utf-8');

// Autenticación: la API responde 401 en JSON (nunca un redirect HTML, rompería el fetch)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$rolesApi = require __DIR__ . '/../config/roles.php';
$rolApi = $_SESSION['rol'] ?? null;

if (!is_string($rolApi) || !isset($rolesApi[$rolApi])) {
    http_response_code(401);
    echo json_encode([
        'status' => 'error',
        'message' => 'No autorizado. Iniciá sesión para buscar alumnos.',
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

require_once __DIR__ . '/../config/conexion.php'; // Acceso a $pdo

// Capturar y sanitizar el parámetro de búsqueda
$q = isset($_GET['q']) && is_string($_GET['q']) ? trim($_GET['q']) : '';

try {
    // Mismo LEFT JOIN que el listado del CRUD (admin/index.php)
    $sql = "SELECT a.id_alumno, a.nombre, a.apellido, a.estado,
                   CONCAT_WS(' ', c.grado_sala, NULLIF(c.division, '')) AS curso
            FROM alumnos AS a
            LEFT JOIN cursos AS c ON a.id_curso = c.id_curso";

    if ($q !== '') {
        $sql .= ' WHERE a.nombre LIKE :nombre OR a.apellido LIKE :apellido
                  ORDER BY a.apellido ASC, a.nombre ASC';

        $stmt = $pdo->prepare($sql);
        $term = '%' . $q . '%';
        $stmt->execute([
            ':nombre' => $term,
            ':apellido' => $term,
        ]);
    } else {
        // Sin filtro: se devuelven todos los alumnos
        $sql .= ' ORDER BY a.apellido ASC, a.nombre ASC';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }

    $alumnos = $stmt->fetchAll();

    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'data' => $alumnos,
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (PDOException $e) {
    // Se registra el detalle interno, pero no se expone al cliente
    error_log('buscar_alumnos.php: ' . $e->getMessage());

    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'No se pudieron obtener los alumnos. Intentá nuevamente.',
    ], JSON_UNESCAPED_UNICODE);
}
