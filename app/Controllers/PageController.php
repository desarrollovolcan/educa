<?php

declare(strict_types=1);

namespace GoEduca\Controllers;

use GoEduca\Database\Connection;
use GoEduca\Support\Env;

final class PageController
{
    public function render(string $view, array $data = []): void
    {
        $viewPath = __DIR__ . '/../Views/' . $view . '.php';
        if (!file_exists($viewPath)) {
            http_response_code(404);
            echo 'Vista no encontrada.';
            return;
        }

        $title = $data['title'] ?? 'Go Educa';
        $contentView = $viewPath;
        $layout = $data['layout'] ?? 'app';
        $assetBase = rtrim(Env::get('APP_URL', ''), '/');

        $dbStatus = null;
        $dbName = null;
        $dbError = null;

        if ($view === 'auth/login') {
            $dbName = Env::get('DB_DATABASE', 'educa');
            if (!class_exists(Connection::class)) {
                $dbStatus = 'error';
                $dbError = 'Servicio de base de datos no disponible.';
            } elseif (!class_exists(\PDO::class)) {
                $dbStatus = 'error';
                $dbError = 'Extensión PDO no disponible en el servidor.';
            } else {
                $pdo = Connection::appPdoOrNull();
                if ($pdo === null) {
                    $dbStatus = 'error';
                    $dbError = 'No se pudo conectar con la base de datos.';
                } else {
                    $dbStatus = 'ok';
                }
            }
        }

        $dbStatus = null;
        $dbName = null;
        $dbError = null;

        if ($view === 'auth/login') {
            $dbName = Env::get('DB_DATABASE', 'goeduca');
            if (!class_exists(Connection::class)) {
                $dbStatus = 'error';
                $dbError = 'Servicio de base de datos no disponible.';
            } elseif (!class_exists(\PDO::class)) {
                $dbStatus = 'error';
                $dbError = 'Extensión PDO no disponible en el servidor.';
            } else {
                $pdo = Connection::appPdoOrNull();
                if ($pdo === null) {
                    $dbStatus = 'error';
                    $dbError = 'No se pudo conectar con la base de datos.';
                } else {
                    $dbStatus = 'ok';
                }
            }
        }

        $layoutPath = __DIR__ . '/../Views/layouts/' . $layout . '.php';
        if (!file_exists($layoutPath)) {
            $layoutPath = __DIR__ . '/../Views/layouts/app.php';
        }

        require $layoutPath;
    }
}
