<?php
// -----------------------------------------------------------------------------
// Modelo AuditLog para operaciones sobre la tabla audit_logs.
// -----------------------------------------------------------------------------

require_once __DIR__ . '/../core/Model.php';

/**
 * Clase AuditLog
 * Registra eventos relevantes del sistema.
 */
class AuditLog extends Model
{
    /**
     * Registra un evento de auditoría.
     *
     * @param int $userId ID del usuario.
     * @param string $event Nombre del evento.
     * @param string $description Descripción breve del evento.
     * @param string $ip Dirección IP.
     * @return void
     */
    public function log(int $userId, string $event, string $description, string $ip): void
    {
        // Insertar registro en tabla audit_logs.
        $sql = 'INSERT INTO audit_logs (user_id, event, description, ip_address, estado, created_at, updated_at)
                VALUES (:user_id, :event, :description, :ip, 1, NOW(), NOW())';

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'user_id' => $userId,
            'event' => $event,
            'description' => $description,
            'ip' => $ip,
        ]);
    }
}
