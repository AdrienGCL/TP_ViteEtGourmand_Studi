<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/config/bootstrap.php';

use App\Db\Mysql;

try {
    $pdo = Mysql::getInstance()->getPDO();

    $statement = $pdo->query('SELECT 1');

    if ($statement->fetchColumn() == 1) {
        echo 'Connexion PDO réussie !';
    }
} catch (Throwable $e) {
    error_log($e->getMessage());

    echo 'Échec de la connexion PDO.';
}