<?php
// -----------------------------------------------------------------------------
// Modelo Tenant para operaciones sobre la tabla tenants.
// -----------------------------------------------------------------------------

require_once __DIR__ . '/../core/Model.php';

/**
 * Clase Tenant
 * Gestiona consultas relacionadas a tenants.
 */
class Tenant extends Model
{
    /**
     * Cuenta la cantidad total de tenants.
     *
     * @return int
     */
    public function countTenants(): int
    {
        // Consulta simple de conteo.
        $stmt = $this->db->query('SELECT COUNT(*) AS total FROM tenants');
        $result = $stmt->fetch();

        return (int)$result['total'];
    }
}
