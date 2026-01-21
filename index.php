<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/backend/src/Support/Env.php';
require_once __DIR__ . '/services/database.php';
if (class_exists('PDO')) {
    require_once __DIR__ . '/backend/src/Database/Connection.php';
}
require_once __DIR__ . '/app/Controllers/PageController.php';
require_once __DIR__ . '/app/Support/Rut.php';

use GoEduca\Controllers\PageController;
use GoEduca\Support\Env;

Env::load(__DIR__ . '/backend/.env');
DatabaseService::bootstrap();

$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$basePath = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
if ($basePath === '/' || $basePath === '.') {
    $basePath = '';
}
if ($basePath !== '' && substr($basePath, -7) === '/public') {
    $basePath = substr($basePath, 0, -7);
}

$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
if ($basePath !== '' && strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
    if ($uri === '') {
        $uri = '/';
    }
}
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$routes = require __DIR__ . '/routes/web.php';

$controller = new PageController();

$dashboardRoutes = [
    'director' => '/dashboard/director',
    'teacher' => '/dashboard/teacher',
    'inspector' => '/dashboard/inspector',
    'pie' => '/dashboard/pie',
    'guardian' => '/dashboard/guardian',
    'student' => '/dashboard/student',
    'finance' => '/dashboard/finance',
];
$defaultDashboard = $dashboardRoutes['director'];

if (empty($_SESSION['authenticated'])) {
    $_SESSION['authenticated'] = true;
    $_SESSION['role'] = 'director';
}

if (strpos($uri, '/auth') === 0) {
    header('Location: ' . $basePath . $defaultDashboard);
    exit;
}

if ($method === 'POST' && $uri === '/auth/login') {
    header('Location: ' . $basePath . $defaultDashboard);
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
