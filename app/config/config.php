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

$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$scriptDir = rtrim(dirname($scriptName), '/');
$documentRoot = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'] ?? ''), '/');

if ($scriptDir !== '' && substr($scriptDir, -7) === '/public') {
    $publicPath = $scriptDir;
} elseif ($documentRoot !== '' && is_dir($documentRoot . '/assets')) {
    $publicPath = $basePath;
} else {
    $publicPath = rtrim($basePath . '/public', '/');
}

define('PUBLIC_URL', $publicPath);
