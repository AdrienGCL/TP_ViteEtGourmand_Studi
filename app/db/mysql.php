<?php

namespace App\Db;

class Mysql 
{
    private $db_name;
    private $db_user;
    private $db_password;
    private $db_port;
    private $db_host;
    private $pdo = null;
    private static $_instance = null;

    private function __construct()
    {

        if (isset($_ENV['DB_NAME'])) {
            $this->db_name = $_ENV['DB_NAME'];
        }
        if (isset($_ENV['DB_USER'])) {
            $this->db_user = $_ENV['DB_USER'];
        }
        if (isset($_ENV['DB_PASS'])) {
            $this->db_password = $_ENV['DB_PASS'];
        }
        if (isset($_ENV['DB_PORT'])) {
            $this->db_port = $_ENV['DB_PORT'];
        }
        if (isset($_ENV['DB_HOST'])) {
            $this->db_host = $_ENV['DB_HOST'];
        }

    }

    public static function getInstance():self
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Mysql();
        }
        return self::$_instance;
    }

    public function getPDO():\PDO
    {
        try{
            if (is_null($this->pdo)) {
                $this->pdo = new \PDO('mysql:dbname=' . $this->db_name . ';charset=utf8;host=' . $this->db_host.':'.$this->db_port, $this->db_user, $this->db_password);
            }
            return $this->pdo;
        }
        catch (\Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        
    }


}