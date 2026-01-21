<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../backend/src/Support/Env.php';
require_once __DIR__ . '/../services/database.php';
if (class_exists('PDO')) {
    require_once __DIR__ . '/../backend/src/Database/Connection.php';
}
require_once __DIR__ . '/../app/Controllers/PageController.php';
require_once __DIR__ . '/../app/Support/Rut.php';

use GoEduca\Controllers\PageController;
use GoEduca\Support\Env;

Env::load(__DIR__ . '/../backend/.env');
DatabaseService::bootstrap();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$routes = require __DIR__ . '/../routes/web.php';

$controller = new PageController();

if ($method === 'POST' && $uri === '/auth/login') {
    if (!DatabaseService::isAvailable()) {
        $controller->render('auth/login', [
            'title' => 'Login',
            'layout' => 'auth',
            'loginError' => 'No se pudo conectar con la base de datos MySQL.',
        ]);
        exit;
    }
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $db = DatabaseService::getInstance();
    $user = $db->verifyUser($username, $password);

    if ($user !== null) {
        $_SESSION['authenticated'] = true;
        $_SESSION['role'] = $user['role'] ?? 'director';
        $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/');
        $basePath = $basePath === '/' ? '' : $basePath;
        $dashboardRoutes = [
            'director' => '/dashboard/director',
            'teacher' => '/dashboard/teacher',
            'inspector' => '/dashboard/inspector',
            'pie' => '/dashboard/pie',
            'guardian' => '/dashboard/guardian',
            'student' => '/dashboard/student',
            'finance' => '/dashboard/finance',
        ];
        $target = $dashboardRoutes[$_SESSION['role']] ?? '/dashboard/director';
        header('Location: ' . $basePath . $target);
        exit;
    }

    $controller->render('auth/login', [
        'title' => 'Login',
        'layout' => 'auth',
        'loginError' => 'Usuario o contraseña inválidos.',
    ]);
    exit;
}

if (isset($routes[$uri])) {
    $isAuthRoute = str_starts_with($uri, '/auth');
    if (!$isAuthRoute && empty($_SESSION['authenticated'])) {
        $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/');
        $basePath = $basePath === '/' ? '' : $basePath;
        header('Location: ' . $basePath . '/auth/login');
        exit;
    }
    $route = $routes[$uri];
    $controller->render($route['view'], [
        'title' => $route['title'],
        'layout' => $route['layout'] ?? 'app',
    ]);
    exit;
}

http_response_code(404);
header('Content-Type: text/plain; charset=utf-8');
echo '404 - Página no encontrada.';
