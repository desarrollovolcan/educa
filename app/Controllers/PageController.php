<?php

declare(strict_types=1);

namespace GoEduca\Controllers;

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

        $layoutPath = __DIR__ . '/../Views/layouts/' . $layout . '.php';
        if (!file_exists($layoutPath)) {
            $layoutPath = __DIR__ . '/../Views/layouts/app.php';
        }

        require $layoutPath;
    }
}
