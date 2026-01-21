<?php
// -----------------------------------------------------------------------------
// Router principal del sistema.
// Su responsabilidad es mapear rutas HTTP a controladores.
// -----------------------------------------------------------------------------

/**
 * Clase Router
 * Registra rutas GET/POST y despacha el controlador correspondiente.
 */
class Router
{
    /**
     * Arreglo de rutas registradas.
     * @var array<string, array<string, callable>>
     */
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    /**
     * Registra una ruta GET.
     *
     * @param string $path Ruta solicitada.
     * @param callable $handler Función o controlador a ejecutar.
     * @return void
     */
    public function get(string $path, callable $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    /**
     * Registra una ruta POST.
     *
     * @param string $path Ruta solicitada.
     * @param callable $handler Función o controlador a ejecutar.
     * @return void
     */
    public function post(string $path, callable $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    /**
     * Ejecuta el despacho de la ruta actual.
     *
     * @return void
     */
    public function dispatch(): void
    {
        // Obtener método HTTP actual.
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        // Obtener la ruta limpia (sin query string).
        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($requestUri, PHP_URL_PATH);

        // Normalizar ruta raíz.
        if ($path === '' || $path === false) {
            $path = '/';
        }

        // Eliminar base path si la aplicación está en subcarpeta.
        $basePath = defined('BASE_URL') ? BASE_URL : '';
        if ($basePath !== '' && strpos($path, $basePath) === 0) {
            $path = substr($path, strlen($basePath));
            if ($path === '') {
                $path = '/';
            }
        }

        // Si la ruta existe para el método, ejecutarla.
        if (isset($this->routes[$method][$path])) {
            call_user_func($this->routes[$method][$path]);
            return;
        }

        // Si no hay ruta encontrada, enviar 404 simple.
        http_response_code(404);
        echo '404 - Página no encontrada';
    }
}
