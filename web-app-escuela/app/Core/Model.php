<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Model — clase base de los modelos (TP10, Fase 0).
 *
 * Recibe la conexión PDO por constructor (inyección de dependencias) y deja
 * la consulta preparada disponible en $this->pdo para las subclases.
 *
 * Un modelo conoce la base de datos, pero NUNCA conoce $_POST, header() ni
 * HTML: eso es responsabilidad del controlador y de la vista.
 */
abstract class Model
{
    protected \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}
