<?php

declare(strict_types=1);

require_once __DIR__ . '/../backend/src/Support/Env.php';
require_once __DIR__ . '/../backend/src/Database/Connection.php';

use GoEduca\Support\Env;

Env::load(__DIR__ . '/../backend/.env');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/health') {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'ok']);
    exit;
}

http_response_code(404);
header('Content-Type: application/json');
echo json_encode(['error' => 'Not Found']);
