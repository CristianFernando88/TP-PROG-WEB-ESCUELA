<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Model;
use PDO;

class Usuario extends Model
{
    public function buscarPorEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare('
            SELECT u.id_usuario, u.nombre, u.apellido, u.password_hash, r.nombre AS nombre_rol
            FROM usuarios AS u
            INNER JOIN roles AS r ON r.id_rol = u.id_rol
            WHERE u.email = :email AND u.activo = 1
        ');
        $stmt->execute([':email' => $email]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        return $fila === false ? null : $fila;
    }

    public function emailExiste(string $email): bool
    {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM usuarios WHERE email = :email');
        $stmt->execute([':email' => $email]);
        return (int)$stmt->fetchColumn() > 0;
    }

    public function crear(string $nombre, string $apellido, string $email, string $password, int $idRol = 3): int
    {
        $stmt = $this->pdo->prepare('
            INSERT INTO usuarios (id_rol, nombre, apellido, email, password_hash)
            VALUES (:id_rol, :nombre, :apellido, :email, :password_hash)
        ');
        $stmt->execute([
            ':id_rol'        => $idRol,
            ':nombre'        => $nombre,
            ':apellido'      => $apellido,
            ':email'         => $email,
            ':password_hash' => password_hash($password, PASSWORD_BCRYPT),
        ]);
        return (int) $this->pdo->lastInsertId();
    }

    public function passwordEsValida(array $usuario, string $password): bool
    {
        return password_verify($password, $usuario['password_hash']);
    }
}