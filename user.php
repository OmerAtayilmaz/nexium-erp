<?php

include "./database.php";


if($_SERVER['REQUEST_METHOD']=="GET"){
    

    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo var_dump($result);
}
if($_SERVER['REQUEST_METHOD']=="POST"){

   $jsonData = file_get_contents('php://input');
   $data = json_decode($jsonData,true);

   $statement = $pdo->prepare("INSERT INTO users (name,email) values (:name,:email)");
   $statement->bindParam(':name', $data['name']);
   $statement->bindParam(':email', $data['email']);
   $statement->execute();
   
   echo var_dump($data);
}