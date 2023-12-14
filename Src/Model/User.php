<?php
namespace Model;
use PDO;
use Database\Database;
class User  extends Model{
    
    public function __construct(){
        parent::__construct();
    }
    

    public function findAll()  {
        $users = $this->db->query('select * from users')->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
}