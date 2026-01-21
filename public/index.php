<?php

declare(strict_types=1);

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

$routes = require __DIR__ . '/../routes/web.php';

$controller = new PageController();

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
