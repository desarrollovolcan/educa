<?php
// -----------------------------------------------------------------------------
// Controlador base para todas las clases de controlador.
// Incluye helpers para renderizar vistas.
// -----------------------------------------------------------------------------

/**
 * Clase Controller
 * Proporciona métodos comunes de render para vistas.
 */
class Controller
{
    /**
     * Renderiza una vista con datos.
     *
     * @param string $view Ruta relativa dentro de /app/views.
     * @param array $data Datos disponibles en la vista.
     * @return void
     */
    protected function render(string $view, array $data = []): void
    {
        // Extraer variables para que estén disponibles en la vista.
        extract($data);

        // Construir ruta absoluta de la vista.
        $viewPath = __DIR__ . '/../views/' . $view . '.php';

        // Validar que la vista exista.
        if (!file_exists($viewPath)) {
            throw new RuntimeException('Vista no encontrada: ' . $viewPath);
        }

        // Incluir la vista.
        include $viewPath;
    }
}
