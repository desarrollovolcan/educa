<?php
// -----------------------------------------------------------------------------
// Configuración y conexión a la base de datos usando PDO.
// Se encarga de crear la base de datos si no existe.
// -----------------------------------------------------------------------------

// Constantes de conexión (ajustar según entorno local).
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'go_educa');
define('DB_USER', 'root');
define('DB_PASS', '');

/**
 * Clase Database
 * Encapsula la lógica de conexión PDO y creación automática de la BD.
 */
class Database
{
    /**
     * Instancia única de PDO.
     * @var PDO|null
     */
    private static ?PDO $instance = null;

    /**
     * Obtiene la conexión PDO. Crea la BD si no existe.
     *
     * @return PDO
     */
    public static function getConnection(): PDO
    {
        // Si ya existe una instancia, la reutilizamos.
        if (self::$instance !== null) {
            return self::$instance;
        }

        // Conexión inicial sin base de datos para crearla si no existe.
        $dsnWithoutDb = 'mysql:host=' . DB_HOST . ';charset=utf8mb4';
        $pdo = new PDO($dsnWithoutDb, DB_USER, DB_PASS, [
            // Modo de error a excepciones.
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);

        // Crear la base de datos si no existe.
        $pdo->exec('CREATE DATABASE IF NOT EXISTS `' . DB_NAME . '` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');

        // Conexión final a la base de datos.
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        self::$instance = new PDO($dsn, DB_USER, DB_PASS, [
            // Modo de error a excepciones.
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Modo de fetch por defecto a arreglo asociativo.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        return self::$instance;
    }
}
