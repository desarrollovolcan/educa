<?php
// -----------------------------------------------------------------------------
// Modelo base para acceso a base de datos.
// -----------------------------------------------------------------------------

require_once __DIR__ . '/../config/database.php';

/**
 * Clase Model
 * Proporciona acceso a la conexión PDO.
 */
class Model
{
    /**
     * Instancia de PDO disponible para modelos hijos.
     * @var PDO
     */
    protected PDO $db;

    /**
     * Constructor del modelo.
     * Inicializa la conexión PDO.
     */
    public function __construct()
    {
        // Obtener la conexión desde la clase Database.
        $this->db = Database::getConnection();
    }
}
