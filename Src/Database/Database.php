<?php

namespace Database;

use PDO;

class Database
{
    private static $instance;
    private $connection;


    private function __construct()
    {
        $dsn = 'mysql:' . http_build_query([
            'host' => 'localhost',
            'port' => 3306,
            'dbname' => 'php_api',
            'charset' => 'utf8mb4'
        ], '', ';');

        $this->connection = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], [
           PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
