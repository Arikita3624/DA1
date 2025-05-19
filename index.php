<?php
session_start(); // Bắt đầu session
$content = '';

// Require file Common
require_once './commons/env.php';
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/shop-grid/ProductsController.php';
require_once './controllers/cart-controller/CartItemsController.php';
require_once './controllers/blog-controller/BlogControllers.php';
require_once './controllers/contact-controller/ContactController.php';
require_once './controllers/auth-controller/AuthController.php';


// Require toàn bộ file Models (nếu có)
// require_once './models/Auth.php'; // Đã được include trong AuthController.php

// Route
$act = $_GET['act'] ?? '/';

// Để bảo đảm tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
match ($act) {
    // Trang chủ
    '/' => (new HomeController())->index(),
    'products-list' => (new ProductsController())->index(),
    'product-detail' => (new ProductDetailController())->index(),
    'cart-items' => (new CartItemsController())->index(),
    'checkout' => (new CheckoutController())->index(),
    'blogs' => (new BlogControllers())->index(),
    'blog-detail' => (new BlogDetailController())->index(),
    'contact' => (new ContactController())->index(),
    'login' => $_SERVER['REQUEST_METHOD'] === 'POST'
    ? (new SignInController())->handleLogin()
    : (new SignInController())->index(),
    'register' => $_SERVER['REQUEST_METHOD'] === 'POST'
    ? (new SignUpController()) ->handleRegister()    : (new SignUpController()) ->index(),
    'logout' => (new LogoutController())-> index(),
    default => (new HomeController())->index(),
};
?>