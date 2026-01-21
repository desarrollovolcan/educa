<?php
// -----------------------------------------------------------------------------
// Controlador de autenticación.
// Maneja login, logout y render de la vista de acceso.
// -----------------------------------------------------------------------------

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Csrf.php';
require_once __DIR__ . '/../core/Validator.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/AuditLog.php';

/**
 * Clase AuthController
 * Controla el flujo de inicio y cierre de sesión.
 */
class AuthController extends Controller
{
    /**
     * Muestra el formulario de login.
     *
     * @return void
     */
    public function showLogin(): void
    {
        // Generar token CSRF para el formulario.
        $csrfToken = Csrf::generateToken();

        // Obtener mensaje de error si existe.
        $error = $_SESSION['login_error'] ?? '';
        unset($_SESSION['login_error']);

        // Renderizar la vista de login.
        $this->render('auth/login', [
            'csrfToken' => $csrfToken,
            'error' => $error,
        ]);
    }

    /**
     * Procesa el login del usuario.
     *
     * @return void
     */
    public function login(): void
    {
        // Obtener datos POST.
        $rut = trim($_POST['rut'] ?? '');
        $password = $_POST['password'] ?? '';
        $csrf = $_POST['csrf_token'] ?? '';

        // Validar CSRF.
        if (!Csrf::validateToken($csrf)) {
            $_SESSION['login_error'] = 'Credenciales inválidas';
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        // Normalizar y validar RUT.
        $rutNormalized = Validator::normalizeRut($rut);
        if (!Validator::validateRut($rutNormalized)) {
            $_SESSION['login_error'] = 'Credenciales inválidas';
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        // Instanciar modelo de usuario.
        $userModel = new User();

        // Obtener IP del cliente.
        $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

        // Validar rate limit: máximo 5 intentos fallidos en 10 minutos.
        $failedAttempts = $userModel->countFailedAttemptsByIp($ip, 10);
        if ($failedAttempts >= 5) {
            $_SESSION['login_error'] = 'Credenciales inválidas';
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        // Buscar usuario por RUT.
        $user = $userModel->findByRut($rutNormalized);

        // Validar usuario existente, activo y contraseña.
        if (!$user || (int)$user['estado'] !== 1 || !password_verify($password, $user['password'])) {
            // Registrar intento fallido.
            $userModel->logLoginAttempt($rutNormalized, $ip, false);

            $_SESSION['login_error'] = 'Credenciales inválidas';
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        // Registrar intento exitoso.
        $userModel->logLoginAttempt($rutNormalized, $ip, true);

        // Iniciar sesión con datos del usuario.
        Auth::login($user);

        // Actualizar último acceso.
        $userModel->updateLastLogin((int)$user['id']);

        // Registrar auditoría de login exitoso.
        $auditLog = new AuditLog();
        $auditLog->log(
            (int)$user['id'],
            'LOGIN_OK',
            'Inicio de sesión exitoso',
            $ip
        );

        // Redirigir a dashboard.
        header('Location: ' . BASE_URL . '/dashboard');
        exit;
    }

    /**
     * Cierra la sesión del usuario.
     *
     * @return void
     */
    public function logout(): void
    {
        // Cerrar sesión.
        Auth::logout();

        // Redirigir a login.
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}
