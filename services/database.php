<?php

class DatabaseService extends SQLite3
{
    private static $instance;
    private string $dbPath;

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new DatabaseService();
        }
        return self::$instance;
    }

    public static function bootstrap(): void
    {
        $db = self::getInstance();
        $db->ensureSchema();
        $db->ensureSuperUser();
    }

    public function __construct()
    {
        $this->dbPath = __DIR__ . '/database.db';
        $this->open($this->dbPath);
    }

    private function ensureSchema(): void
    {
        $this->exec('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY AUTOINCREMENT, email TEXT)');

        $columns = [];
        $result = $this->query('PRAGMA table_info(users)');
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $columns[$row['name']] = true;
        }

        if (!isset($columns['username'])) {
            $this->exec('ALTER TABLE users ADD COLUMN username TEXT');
        }

        if (!isset($columns['password_hash'])) {
            $this->exec('ALTER TABLE users ADD COLUMN password_hash TEXT');
        }

        if (!isset($columns['role'])) {
            $this->exec('ALTER TABLE users ADD COLUMN role TEXT');
        }
    }

    private function ensureSuperUser(): void
    {
        $stmt = $this->prepare('SELECT id FROM users WHERE username = :username LIMIT 1');
        $stmt->bindValue(':username', 'super_user', SQLITE3_TEXT);
        $result = $stmt->execute();
        if ($result->fetchArray(SQLITE3_ASSOC)) {
            return;
        }

        $insert = $this->prepare(
            'INSERT INTO users (email, username, password_hash, role) VALUES (:email, :username, :password_hash, :role)'
        );
        $insert->bindValue(':email', 'super_user@educa.local', SQLITE3_TEXT);
        $insert->bindValue(':username', 'super_user', SQLITE3_TEXT);
        $insert->bindValue(':password_hash', password_hash('123456789', PASSWORD_DEFAULT), SQLITE3_TEXT);
        $insert->bindValue(':role', 'director', SQLITE3_TEXT);
        $insert->execute();
    }

    public function verifyUser(string $username, string $password): ?array
    {
        $stmt = $this->prepare('SELECT username, password_hash, role FROM users WHERE username = :username LIMIT 1');
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $result = $stmt->execute();
        $row = $result->fetchArray(SQLITE3_ASSOC);
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
        $stmt = $this->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $result = $stmt->execute();
        return (bool) $result->fetchArray(SQLITE3_ASSOC);
    }
}

?>
