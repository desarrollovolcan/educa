<?php
// -----------------------------------------------------------------------------
// Front Controller.
// Punto de entrada único para la aplicación MVC.
// -----------------------------------------------------------------------------

// Iniciar sesión nativa de PHP.
session_start();

// Incluir configuración general.
require_once __DIR__ . '/../app/config/config.php';

// Incluir clases base del sistema.
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/Model.php';
require_once __DIR__ . '/../app/core/Auth.php';
require_once __DIR__ . '/../app/core/Csrf.php';
require_once __DIR__ . '/../app/core/Validator.php';

// Incluir rutas.
require_once __DIR__ . '/../routes/web.php';
