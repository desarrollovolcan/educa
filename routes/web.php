<?php
// -----------------------------------------------------------------------------
// Definición de rutas web del sistema.
// -----------------------------------------------------------------------------

require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/DashboardController.php';

// Instanciar router.
$router = new Router();

// Ruta por defecto: mostrar login en la raíz.
$router->get('/', function () {
    $controller = new AuthController();
    $controller->showLogin();
});

// Rutas de autenticación.
$router->get('/login', function () {
    $controller = new AuthController();
    $controller->showLogin();
});

$router->post('/login', function () {
    $controller = new AuthController();
    $controller->login();
});

$router->get('/logout', function () {
    $controller = new AuthController();
    $controller->logout();
});

// Ruta de dashboard (requiere autenticación en el controlador).
$router->get('/dashboard', function () {
    $controller = new DashboardController();
    $controller->index();
});

// Ejecutar despacho de rutas.
$router->dispatch();
