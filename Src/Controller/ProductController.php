<?php

namespace Controller;
use Model\Product;

class ProductController{

    public function index() {
        
        $productList = new Product();
        $pList = $productList->get();

        echo json_encode($pList);
    
    }

    public function store(){
        $product = new Product();
        $product->save([
            'title' => 'Ayakkabı',
            'price' => "$120"
        ]);
        
    }
}