<?php
require 'vendor/autoload.php';  // Make sure the path to autoload.php is correct

use Model\Product;

echo json_encode(Product::sayHi());