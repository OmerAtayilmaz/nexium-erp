<?php

namespace Helper;

class Password {

    public static function hash($pass){
        return password_hash($pass,PASSWORD_BCRYPT);
    }
    public static function password_verify($provided_pass, $user_pass){
        return password_verify($provided_pass,$user_pass);
    }
}