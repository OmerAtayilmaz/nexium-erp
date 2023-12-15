<?php
namespace Model;
use PDO;
use Database\Database;
class User  extends Model{
    
    public $table_name = 'users';
    public $attributes = ['name','email'];

    
}