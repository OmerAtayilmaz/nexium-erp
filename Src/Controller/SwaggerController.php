<?php

namespace Controller;



class SwaggerController extends Controller
{


    public function documentation()
    {
        require($_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php");
        $openapi = \OpenApi\Generator::scan([__DIR__]);
        header('Content-Type: application/json');
        echo $openapi->toJson();
    }


}