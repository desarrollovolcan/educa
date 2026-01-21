<?php

declare(strict_types=1);

// Clase de conexión a la base de datos.
// Se mantiene simple y con comentarios claros para facilitar su mantenimiento.

namespace GoEduca\Database;

use GoEduca\Support\Env;
use PDO;
use PDOException;

final class Connection
{
    // Obtiene una conexión con privilegios de root.
    public static function rootPdo(): PDO
    {
        $host = Env::get('DB_HOST', 'localhost');
        $port = Env::get('DB_PORT', '3306');
        $user = Env::get('DB_ROOT_USERNAME', 'root');
        $pass = Env::get('DB_ROOT_PASSWORD', '');
        $dsn = sprintf('mysql:host=%s;port=%s;charset=utf8mb4', $host, $port);

        return self::connect($dsn, $user, $pass, true);
    }

    // Obtiene una conexión con el usuario de la aplicación.
    public static function appPdo(): PDO
    {
        $host = Env::get('DB_HOST', 'localhost');
        $port = Env::get('DB_PORT', '3306');
        $db = Env::get('DB_DATABASE', 'educa');
        $user = Env::get('DB_USERNAME', 'root');
        $pass = Env::get('DB_PASSWORD', '');
        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', $host, $port, $db);

        return self::connect($dsn, $user, $pass, true);
    }

    // Igual que rootPdo(), pero devuelve null si falla.
    public static function rootPdoOrNull(): ?PDO
    {
        $host = Env::get('DB_HOST', 'localhost');
        $port = Env::get('DB_PORT', '3306');
        $user = Env::get('DB_ROOT_USERNAME', 'root');
        $pass = Env::get('DB_ROOT_PASSWORD', '');
        $dsn = sprintf('mysql:host=%s;port=%s;charset=utf8mb4', $host, $port);

        return self::connect($dsn, $user, $pass, false);
    }

    // Igual que appPdo(), pero devuelve null si falla.
    public static function appPdoOrNull(): ?PDO
    {
        $host = Env::get('DB_HOST', 'localhost');
        $port = Env::get('DB_PORT', '3306');
        $db = Env::get('DB_DATABASE', 'educa');
        $user = Env::get('DB_USERNAME', 'root');
        $pass = Env::get('DB_PASSWORD', '');
        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', $host, $port, $db);

        return self::connect($dsn, $user, $pass, false);
    }

    // Crea la conexión PDO con parámetros comunes.
    // $exitOnFailure define si se aborta la ejecución ante errores.
    private static function connect(string $dsn, string $user, string $pass, bool $exitOnFailure): ?PDO
    {
        if (!class_exists(PDO::class)) {
            error_log('Database connection failed: PDO extension is not available.');
            if ($exitOnFailure) {
                exit(1);
            }

            return null;
        }

        try {
            return new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $exception) {
            error_log("Database connection failed: {$exception->getMessage()}");
            if ($exitOnFailure) {
                exit(1);
            }

            return null;
        }
    }
}
