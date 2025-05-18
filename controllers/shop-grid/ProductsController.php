<?php

class ProductsController {
    public function index() {
       global $content;
       $content = "views/pages/products/ProductsListClient.php";
       require_once "./views/layouts/main.php";
    }
}

class ProductDetailController {
    public function index() {
       global $content;
       $content = "views/pages/products/ProductDetail.php";
       require_once "./views/layouts/main.php";
    }
}

?>