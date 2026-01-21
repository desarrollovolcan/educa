<?php
// -----------------------------------------------------------------------------
// Controlador del dashboard inicial.
// -----------------------------------------------------------------------------

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Tenant.php';
require_once __DIR__ . '/../models/Role.php';

/**
 * Clase DashboardController
 * Gestiona la vista principal luego del login.
 */
class DashboardController extends Controller
{
    /**
     * Muestra el dashboard inicial.
     *
     * @return void
     */
    public function index(): void
    {
        // Verificar autenticación obligatoria.
        Auth::requireAuth();

        // Obtener datos del usuario autenticado.
        $user = Auth::user();

        // Instanciar modelos para obtener métricas.
        $userModel = new User();
        $tenantModel = new Tenant();
        $roleModel = new Role();

        // Consultar métricas necesarias.
        $totalUsers = $userModel->countUsers();
        $totalTenants = $tenantModel->countTenants();
        $totalRoles = $roleModel->countRoles();
        $failedAttempts = $userModel->countFailedAttemptsLast7Days();
        $lastLoginAt = $userModel->getLastLoginAt((int)$user['user_id']);

        // Renderizar la vista de dashboard.
        $this->render('dashboard/index', [
            'user' => $user,
            'totalUsers' => $totalUsers,
            'totalTenants' => $totalTenants,
            'totalRoles' => $totalRoles,
            'failedAttempts' => $failedAttempts,
            'lastLoginAt' => $lastLoginAt,
        ]);
    }
}
