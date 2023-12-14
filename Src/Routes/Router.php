<?php

namespace Routes;

class Router{

    protected $routes = [];

    function methodCaller($controller,$method){
        $new = new $controller;
        call_user_func([$new,$method]);
    }

    public function add($method, $uri, $controller,$function){
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'function' => $function,
            'middleware'
        ];
        
        return $this;
    }

    public function get($uri, $controller,$method){
        return $this->add('GET', $uri, $controller,$method);
    }

    public function post($uri, $controller,$method){
        return $this->add('POST',$uri,$controller,$method);
    }

    public function delete($uri, $controller,$method) {
        return $this->add('DELETE', $uri, $controller,$method);
    }

    public function patch($uri,$controller,$method) {
        return $this->add('PATCH', $uri, $controller,$method);
    }

    public function put($uri, $controller,$method){
        return $this->add("PUT", $uri, $controller,$method);
    }

    public function route($uri, $method){
        foreach($this->routes as $route){
            if($route['uri'] == $uri && $route['method'] ===strtoupper($method)){
                return $this->methodCaller($route['controller'],$route['function']);
            }
        }
    }
}