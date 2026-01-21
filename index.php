<?php

declare(strict_types=1);

require_once __DIR__ . '/backend/src/Support/Env.php';
require_once __DIR__ . '/app/Controllers/PageController.php';

use GoEduca\Controllers\PageController;
use GoEduca\Support\Env;

Env::load(__DIR__ . '/backend/.env');

$controller = new PageController();
$controller->render('auth/login', [
    'title' => 'Login',
    'layout' => 'auth',
]);
