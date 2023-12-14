<?php
$db = $_ENV['DB_NAME'];
$user = $_ENV['DB_USERNAME'];
$pass = $_ENV['DB_PASSWORD'];
$dsn = "mysql:host=localhost;dbname=$db";

try{
    $pdo = new PDO($dsn, $user,$pass);
}catch(PDOException $e){
    die("Connection failed: " . $e->getMessage());
}
