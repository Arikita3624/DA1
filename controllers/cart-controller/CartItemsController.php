<?php

class CartItemsController{
    public function index(){
        global $content;
        $content = "views/pages/carts/CartItems.php";
        require_once "./views/layouts/main.php";
    }
}

class CheckoutController{
    public function index(){
        global $content;
        $content = "views/pages/carts/Checkout.php";
        require_once "./views/layouts/main.php";
    }
}


?>