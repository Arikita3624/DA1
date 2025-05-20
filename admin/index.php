<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
};

$content_admin='';

// Require file Common
require_once '../commons/env.php';
require_once '../commons/function.php';

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/CategoryController.php';

// Require toàn bộ file Models
require_once 'models/ProductModel.php';

// Route
$act = $_GET['act'] ?? '/';
$id = $_GET['id'] ?? null;

match ($act) {
    // Dashboards
    '/'                 => (new DashboardController())->index(),
    'products-list'     => (new ProductController())->index(),
    'product-add'       => (new ProductAddController())->addProduct(),
    'product-edit'      => (new ProductEditController())->editProduct($id),
    'delete-product'    => (new ProductDeleteController())->deleteProduct($id),
    'category-list'     => (new CategoryController())->index(),
    'category-add'      => (new CategoryAddController())->addCategory(),
    'delete-category'   => (new CategoryDeleteController())->deleteCategory($id),
    default => (new ProductController())->index(),
};
?>