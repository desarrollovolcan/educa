<?php
// -----------------------------------------------------------------------------
// Configuración general de la aplicación Go Educa.
// Este archivo define constantes básicas usadas en todo el sistema.
// -----------------------------------------------------------------------------

// Nombre visible de la aplicación.
define('APP_NAME', 'Go Educa');

// URL base del proyecto (ajustar según carpeta en XAMPP).
// Ejemplo: http://localhost/educa/public
// Se usa para generar enlaces en vistas.
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$basePath = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
if ($basePath === '/' || $basePath === '.') {
    $basePath = '';
}
define('BASE_URL', $basePath);
