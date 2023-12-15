<?php
namespace Model;
use Database\Database;
use PDO;
class Model {
    
    protected $db;
    protected $table_name = 'default';

    public function __construct() {
       
        $this->db = Database::getInstance()->getConnection();
        if (!$this->db) {
            throw new \Exception("Database connection is null");
        }
    }

    public function get(){
        return $this->db->query("select * from {$this->table_name}")->fetchAll(PDO::FETCH_ASSOC);
    }
}