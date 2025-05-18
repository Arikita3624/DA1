<?php
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

// Require toàn bộ file Models

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

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
    'login' => (new SignInController())->index(),
    'register' => (new SignUpController())->index(),
    default => (new HomeController())->index(),
};

?>