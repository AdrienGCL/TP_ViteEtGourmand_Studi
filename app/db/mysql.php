<?php

namespace app\db;

use PDO;
use PDOException;
use RuntimeException;

class Mysql
{
    private string $db_name;
    private string $db_user;
    private string $db_password;
    private int $db_port;
    private string $db_host;

    private ?PDO $pdo = null;

    private static ?self $_instance = null;

    private function __construct()
    {
        $this->db_name = $this->getEnvValue('DB_NAME');
        $this->db_user = $this->getEnvValue('DB_USER');
        $this->db_password = $this->getEnvValue('DB_PASS');
        $this->db_host = $this->getEnvValue('DB_HOST');

        $port = $this->getEnvValue('DB_PORT');
        $this->db_port = (int) $port;
    }

    private function getEnvValue(string $key): string
    {
        $value = $_ENV[$key] ?? null;

        if ($value === null || $value === '') {
            throw new RuntimeException(
                "Variable d'environnement manquante : {$key}"
            );
        }

        return $value;
    }

    public static function getInstance(): self
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function getPDO(): PDO
    {
        if ($this->pdo === null) {
            $dsn = sprintf(
                'mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
                $this->db_host,
                $this->db_port,
                $this->db_name
            );

            try {
                $this->pdo = new PDO(
                    $dsn,
                    $this->db_user,
                    $this->db_password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );
            } catch (PDOException $e) {
                error_log(
                    'Erreur de connexion à la base de données : '
                    . $e->getMessage()
                );

                throw new RuntimeException(
                    'Impossible de se connecter à la base de données.',
                    0,
                    $e
                );
            }
        }

        return $this->pdo;
    }
}