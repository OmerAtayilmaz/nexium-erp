<?php

namespace Controller;
use Model\Product;

class ProductController{


     /**
     * @OA\Get(
     *     path="/api/v1/product",
     *     summary= " Product list",
     *     description="Returns a list of all products",
     *     @OA\Response(response="200", description="All Products"),
     *     @OA\Response(response="404", description="Not Found")
    * )
    */
    public function index() {
        
        $productList = new Product();
        $pList = $productList->get();

        echo json_encode($pList);
    
    }

    /**
     * @OA\Post(
     *     path="/api/v1/product",
     *     @OA\Response(response="201", description="Created")
     * )
     */
    public function store(){
        $product = new Product();
        $product->save([
            'title' => 'Ayakkabı',
            'price' => "$120"
        ]);
        
    }
}