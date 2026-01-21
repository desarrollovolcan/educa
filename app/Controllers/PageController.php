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

        require __DIR__ . '/../Views/layouts/app.php';
    }
}
