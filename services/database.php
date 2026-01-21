<?php

use GoEduca\Database\Connection;

class DatabaseService
{
    private static ?DatabaseService $instance = null;
    private ?PDO $pdo = null;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function isAvailable(): bool
    {
        return class_exists('PDO') && class_exists(Connection::class) && Connection::appPdoOrNull() !== null;
    }

    public static function bootstrap(): void
    {
        $db = self::getInstance();
        $db->ensureSchema();
        $db->ensureSuperUser();
    }

    private function __construct()
    {
        $this->pdo = class_exists('PDO') && class_exists(Connection::class)
            ? Connection::appPdoOrNull()
            : null;
    }

    private function ensureSchema(): void
    {
        if ($this->pdo === null) {
            return;
        }

        $this->pdo->exec(
            'CREATE TABLE IF NOT EXISTS users ('
            . 'id INT AUTO_INCREMENT PRIMARY KEY,'
            . 'email VARCHAR(255) NULL,'
            . 'username VARCHAR(255) NOT NULL UNIQUE,'
            . 'password_hash VARCHAR(255) NOT NULL,'
            . 'role VARCHAR(50) NOT NULL DEFAULT "director"'
            . ') ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;'
        );
    }

    private function ensureSuperUser(): void
    {
        if ($this->pdo === null) {
            return;
        }

        $stmt = $this->pdo->prepare('SELECT id FROM users WHERE username = :username LIMIT 1');
        $stmt->execute(['username' => 'super_user']);
        if ($stmt->fetchColumn()) {
            return;
        }

        $insert = $this->pdo->prepare(
            'INSERT INTO users (email, username, password_hash, role) VALUES (:email, :username, :password_hash, :role)'
        );
        $insert->execute([
            'email' => 'super_user@educa.local',
            'username' => 'super_user',
            'password_hash' => password_hash('123456789', PASSWORD_DEFAULT),
            'role' => 'director',
        ]);
    }

    public function verifyUser(string $username, string $password): ?array
    {
        if ($this->pdo === null) {
            return null;
        }

        $stmt = $this->pdo->prepare('SELECT username, password_hash, role FROM users WHERE username = :username LIMIT 1');
        $stmt->execute(['username' => $username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }

        if (!password_verify($password, $row['password_hash'] ?? '')) {
            return null;
        }

        return $row;
    }

    public function checkUser(string $email): bool
    {
        if ($this->pdo === null) {
            return false;
        }

        $stmt = $this->pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        return (bool) $stmt->fetchColumn();
    }
}

?>
