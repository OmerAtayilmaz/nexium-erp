<?php

require 'vendor/autoload.php';

require __DIR__ . '/bootstrap.php';


use Model\Product;

echo json_encode(Product::sayHi());