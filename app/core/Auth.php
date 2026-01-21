<?php
// -----------------------------------------------------------------------------
// Lógica de autenticación y control de sesión.
// -----------------------------------------------------------------------------

/**
 * Clase Auth
 * Maneja el estado de autenticación basado en sesiones PHP.
 */
class Auth
{
    /**
     * Verifica si el usuario está autenticado.
     *
     * @return bool
     */
    public static function check(): bool
    {
        // Validar si existe el ID de usuario en sesión.
        return isset($_SESSION['user_id']);
    }

    /**
     * Retorna datos básicos del usuario autenticado.
     *
     * @return array|null
     */
    public static function user(): ?array
    {
        // Si no hay sesión activa, retornar null.
        if (!self::check()) {
            return null;
        }

        // Retornar arreglo con datos del usuario.
        return [
            'user_id' => $_SESSION['user_id'],
            'rut' => $_SESSION['rut'],
            'nombre' => $_SESSION['nombre'],
            'rol' => $_SESSION['rol'],
            'tenant_id' => $_SESSION['tenant_id'],
        ];
    }

    /**
     * Obliga a autenticación para acceder a una ruta.
     * Si no está autenticado, redirige a /login.
     *
     * @return void
     */
    public static function requireAuth(): void
    {
        // Si no está autenticado, redirigir.
        if (!self::check()) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    /**
     * Inicia sesión guardando datos en $_SESSION.
     *
     * @param array $user Datos del usuario desde base de datos.
     * @return void
     */
    public static function login(array $user): void
    {
        // Regenerar ID de sesión por seguridad.
        session_regenerate_id(true);

        // Guardar datos esenciales en sesión.
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['rut'] = $user['rut'];
        $_SESSION['nombre'] = $user['nombre'];
        $_SESSION['rol'] = $user['rol_nombre'];
        $_SESSION['tenant_id'] = $user['tenant_id'];
    }

    /**
     * Cierra la sesión del usuario.
     *
     * @return void
     */
    public static function logout(): void
    {
        // Vaciar variables de sesión.
        $_SESSION = [];

        // Destruir la sesión por completo.
        session_destroy();
    }
}
