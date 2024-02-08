<?php
namespace Model;
use PDO;
use Helper\Password;

class User  extends Model{
    
    public $table_name = 'users';
    public $attributes = ['name','email','password'];

    public function auth($credentials){
    
        $email = $credentials['email'];
        $statement =  $this->db->query("select * from {$this->table_name} WHERE email = '$email'");

        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
       
        if(!$user)
            return   [ "status" => 404 ];

        if(Password::password_verify($credentials['password'],$user['password'])){
            return [ "status" => 200, 'id' => $user['id'], 'email' => $user['email']];
        }
        
        return null;
    
    }

  

    
    
}