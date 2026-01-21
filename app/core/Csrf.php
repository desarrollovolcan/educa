<?php
// -----------------------------------------------------------------------------
// Manejo de tokens CSRF para formularios.
// -----------------------------------------------------------------------------

/**
 * Clase Csrf
 * Genera y valida tokens CSRF para proteger formularios.
 */
class Csrf
{
    /**
     * Genera y guarda un token CSRF en sesión.
     *
     * @return string
     */
    public static function generateToken(): string
    {
        // Crear token seguro si no existe o si se desea rotar.
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    /**
     * Valida el token CSRF recibido desde formulario.
     *
     * @param string $token Token recibido en POST.
     * @return bool
     */
    public static function validateToken(string $token): bool
    {
        // Comparar token recibido con token en sesión.
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}
