<?php

namespace Database;

use PDO;

class Database
{
    private static $instance;
    private $connection;


    private function __construct()
    {
        try {
            $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=php_api;charset=utf8mb4';
            
            $this->connection = new PDO($dsn, 'root', 'root', [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Enable error reporting for debugging
            ]);
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            die();
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
