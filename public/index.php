<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../backend/src/Support/Env.php';
if (class_exists('PDO')) {
    require_once __DIR__ . '/../backend/src/Database/Connection.php';
}
require_once __DIR__ . '/../app/Controllers/PageController.php';
require_once __DIR__ . '/../app/Support/Rut.php';

use GoEduca\Controllers\PageController;
use GoEduca\Support\Env;

Env::load(__DIR__ . '/../backend/.env');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$routes = require __DIR__ . '/../routes/web.php';

$controller = new PageController();

if ($method === 'POST' && $uri === '/auth/login') {
    $role = $_POST['role'] ?? 'director';
    $allowedRoles = ['director', 'teacher', 'inspector', 'pie', 'guardian', 'student', 'finance'];
    if (!in_array($role, $allowedRoles, true)) {
        $role = 'director';
    }
    $_SESSION['role'] = $role;
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
    $target = $dashboardRoutes[$role] ?? '/dashboard/director';
    header('Location: ' . $basePath . $target);
    exit;
}

if (isset($routes[$uri])) {
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
