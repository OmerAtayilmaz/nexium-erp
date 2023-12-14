<?php
namespace Model;

class Product {
    public static function sayHi() {
        
        http_response_code(200);
        return [
            "status" => "success",
            "message" => "What's up?"
        ];
    }
}