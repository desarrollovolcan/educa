<?php
// -----------------------------------------------------------------------------
// Punto de entrada alternativo en la raíz del proyecto.
// Redirige al Front Controller ubicado en /public.
// -----------------------------------------------------------------------------

// Detectar la ruta base del proyecto para evitar hardcode.
$basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');

// Si estamos en la raíz, asegurar base vacía.
if ($basePath === '.' || $basePath === '/') {
    $basePath = '';
}

// Redirigir a la carpeta pública donde vive el Front Controller.
header('Location: ' . $basePath . '/public/');
exit;
