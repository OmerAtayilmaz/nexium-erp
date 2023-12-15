<?php
namespace Model;
use Database\Database;

use PDO;
use PDOException;
use Util\HttpStatus;

class Model {
    
    protected $db;
    protected $table_name;

    protected $attributes = [] ;

    public function __construct() {
       
        $this->table_name = $this->getTableOverride() ?? $this->getDefaultTableName();

        $this->db = Database::getInstance()->getConnection();
        if (!$this->db) {
            throw new \Exception("Database connection is null");
        }
    }

    

    public function get(){
        http_response_code(HttpStatus::OK);
        return $this->db->query("select * from {$this->table_name}")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($data){

        try{
            $keys = "(" . implode(',',$this->attributes) . ')';
        
            $stmt = $this->db->prepare("INSERT INTO $this->table_name $keys VALUES (:" . implode(',:', $this->attributes) . ")");
           
            http_response_code(HttpStatus::CREATED);

            $stmt->execute($data);
        }catch(PDOException $e){
            echo "Error Occured:" . $e->getMessage();
            die();
        }
       
    }


    //Table naming strategy

    protected function getDefaultTableName(){
        $className = $this->getClassNameWithoutNamespace();
        RETURN strtolower($className) . 's';
    }

    protected function getClassNameWithoutNamespace()
    {
        $className = get_called_class();
        $classNameParts = explode('\\', $className);
        return end($classNameParts);
    }

    protected function getTableOverride(){
        return property_exists($this,'table_name') ? $this->table_name : null;
    }

}