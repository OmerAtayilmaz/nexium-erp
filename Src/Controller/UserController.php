<?php

namespace Controller;

use Model\User;

class UserController extends Controller{

 
    public function index(){
        $userModel = new User();
        $users = $userModel->get();
     
        echo json_encode($users);

    }

    public function store() {
        echo "stored!";
    }
}