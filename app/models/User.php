<?php
// -----------------------------------------------------------------------------
// Modelo User para operaciones sobre la tabla users.
// -----------------------------------------------------------------------------

require_once __DIR__ . '/../core/Model.php';

/**
 * Clase User
 * Gestiona consultas relacionadas a usuarios.
 */
class User extends Model
{
    /**
     * Busca un usuario por RUT.
     *
     * @param string $rut RUT del usuario.
     * @return array|null
     */
    public function findByRut(string $rut): ?array
    {
        // Consulta SQL con JOIN para traer nombre del rol.
        $sql = 'SELECT users.*, roles.nombre AS rol_nombre
                FROM users
                INNER JOIN roles ON roles.id = users.role_id
                WHERE users.rut = :rut
                LIMIT 1';

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['rut' => $rut]);
        $user = $stmt->fetch();

        return $user ?: null;
    }

    /**
     * Cuenta la cantidad total de usuarios.
     *
     * @return int
     */
    public function countUsers(): int
    {
        // Consulta simple de conteo.
        $stmt = $this->db->query('SELECT COUNT(*) AS total FROM users');
        $result = $stmt->fetch();

        return (int)$result['total'];
    }

    /**
     * Actualiza la fecha de último acceso del usuario.
     *
     * @param int $userId ID del usuario.
     * @return void
     */
    public function updateLastLogin(int $userId): void
    {
        // Actualizar campo last_login_at.
        $stmt = $this->db->prepare('UPDATE users SET last_login_at = NOW(), updated_at = NOW() WHERE id = :id');
        $stmt->execute(['id' => $userId]);
    }

    /**
     * Obtiene el último acceso de un usuario por ID.
     *
     * @param int $userId ID del usuario.
     * @return string|null
     */
    public function getLastLoginAt(int $userId): ?string
    {
        // Consultar el campo last_login_at.
        $stmt = $this->db->prepare('SELECT last_login_at FROM users WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $userId]);
        $result = $stmt->fetch();

        return $result['last_login_at'] ?? null;
    }

    /**
     * Cuenta intentos fallidos recientes por IP.
     *
     * @param string $ip Dirección IP.
     * @param int $minutes Ventana de minutos.
     * @return int
     */
    public function countFailedAttemptsByIp(string $ip, int $minutes): int
    {
        // Calcular ventana de tiempo en SQL.
        $sql = 'SELECT COUNT(*) AS total
                FROM login_attempts
                WHERE ip_address = :ip
                  AND success = 0
                  AND created_at >= (NOW() - INTERVAL :minutes MINUTE)';

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':ip', $ip);
        $stmt->bindValue(':minutes', $minutes, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();

        return (int)$result['total'];
    }

    /**
     * Registra un intento de login.
     *
     * @param string $rut RUT ingresado.
     * @param string $ip Dirección IP.
     * @param bool $success Indica si fue exitoso.
     * @return void
     */
    public function logLoginAttempt(string $rut, string $ip, bool $success): void
    {
        // Insertar registro de intento.
        $sql = 'INSERT INTO login_attempts (rut, ip_address, success, estado, created_at, updated_at)
                VALUES (:rut, :ip, :success, 1, NOW(), NOW())';

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'rut' => $rut,
            'ip' => $ip,
            'success' => $success ? 1 : 0,
        ]);
    }

    /**
     * Cuenta intentos fallidos de login en los últimos 7 días.
     *
     * @return int
     */
    public function countFailedAttemptsLast7Days(): int
    {
        // Consulta de intentos fallidos en la última semana.
        $sql = 'SELECT COUNT(*) AS total
                FROM login_attempts
                WHERE success = 0
                  AND created_at >= (NOW() - INTERVAL 7 DAY)';

        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();

        return (int)$result['total'];
    }
}
