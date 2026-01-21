<?php
// -----------------------------------------------------------------------------
// Modelo Role para operaciones sobre la tabla roles.
// -----------------------------------------------------------------------------

require_once __DIR__ . '/../core/Model.php';

/**
 * Clase Role
 * Gestiona consultas relacionadas a roles.
 */
class Role extends Model
{
    /**
     * Cuenta la cantidad total de roles.
     *
     * @return int
     */
    public function countRoles(): int
    {
        // Consulta simple de conteo.
        $stmt = $this->db->query('SELECT COUNT(*) AS total FROM roles');
        $result = $stmt->fetch();

        return (int)$result['total'];
    }
}
