<?php

declare(strict_types=1);

namespace GoEduca\Database;

use GoEduca\Support\Env;
use PDO;
use PDOException;

final class Connection
{
    public static function rootPdo(): PDO
    {
        $host = Env::get('DB_HOST', '127.0.0.1');
        $port = Env::get('DB_PORT', '3306');
        $user = Env::get('DB_ROOT_USERNAME', 'root');
        $pass = Env::get('DB_ROOT_PASSWORD', '');
        $dsn = sprintf('mysql:host=%s;port=%s;charset=utf8mb4', $host, $port);

        return self::connect($dsn, $user, $pass);
    }

    public static function appPdo(): PDO
    {
        $host = Env::get('DB_HOST', '127.0.0.1');
        $port = Env::get('DB_PORT', '3306');
        $db = Env::get('DB_DATABASE', 'goeduca');
        $user = Env::get('DB_USERNAME', 'goeduca');
        $pass = Env::get('DB_PASSWORD', '');
        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', $host, $port, $db);

        return self::connect($dsn, $user, $pass);
    }

    private static function connect(string $dsn, string $user, string $pass): PDO
    {
        try {
            $pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $exception) {
            fwrite(STDERR, "Database connection failed: {$exception->getMessage()}" . PHP_EOL);
            exit(1);
        }

        return $pdo;
    }
}
