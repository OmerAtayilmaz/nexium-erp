<?php

namespace Controller;

use Model\User;

class UserController extends Controller{

 
    public function index(){
        $user = new User();
        return $user->findAll();
    }

    public function store() {
        echo "stored!";
    }
}