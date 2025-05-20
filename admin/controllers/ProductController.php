<?php
require_once('../admin/models/ProductModel.php');

class ProductController {
    public function index() {
        $productsModel = new ProductModel();
        $products = $productsModel->get_all_products();
        global $content_admin;
        $content_admin = '../admin/views/Product/products_list.php';
        require_once "../admin/views/layouts/main_admin.php";
    }
}

class ProductAddController {
    public function addProduct() {
        $productsModel = new ProductModel();
        $data = $_POST;

        // Kiểm tra nếu form đã được xử lý (tránh lặp)
        if (isset($_SESSION['form_processed']) && $_SESSION['form_processed'] === true) {
            unset($_SESSION['form_processed']);
            header('Location: ?act=products-list');
            exit;
        }


        if (empty($data['name']) || empty($data['category_id'])) {
            $_SESSION['error_message'] = "Product name and category are required.";
            global $content_admin;
            $content_admin = '../admin/views/Product/product_add.php';
            require_once "../admin/views/layouts/main_admin.php";
            return;
        }

        try {
            $productsModel->add_product($data);
            $_SESSION['form_processed'] = true;
            $_SESSION['success_message'] = "Product added successfully!";
            header('Location: ?act=products-list');
            exit;
        } catch (Exception $e) {
            $_SESSION['error_message'] = "Failed to add product: " . $e->getMessage();
            global $content_admin;
            $content_admin = '../admin/views/Product/product_add.php';
            require_once "../admin/views/layouts/main_admin.php";
        }
    }
}
class ProductEditController {
    public function editProduct($id) {
        $productsModel = new ProductModel();
        $product = $productsModel->get_product_by_id($id);

        if (!$product) {
            $_SESSION['error_message'] = "Product not found.";
            header('Location: ?act=products-list');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? $product['name'],
                'image' => $_POST['image'] ?? $product['image'],
                'price' => $_POST['price'] ?? $product['price'],
                'quantity' => $_POST['quantity'] ?? $product['quantity'],
                'status' => $_POST['status'] ?? $product['status'],
                'category_id' => $_POST['category_id'] ?? $product['category_id'],
                'description' => $_POST['description'] ?? $product['description']
            ];

            try {
                $productsModel->update_product($data, $id);
                $_SESSION['success_message'] = "Product updated successfully!";
                header('Location: ?act=products-list');
                exit;
            } catch (Exception $e) {
                $_SESSION['error_message'] = "Failed to update product: " . $e->getMessage();
                global $content_admin;
                $content_admin = '../admin/views/Product/product_edit.php';
                require_once "../admin/views/layouts/main_admin.php";
            }
        } else {
            global $content_admin;
            $content_admin = '../admin/views/Product/product_edit.php';
            global $product_data;
            $product_data = $product;
            require_once "../admin/views/layouts/main_admin.php";
        }
    }
}
class ProductDeleteController
{
    public function deleteProduct($id)
    {
        $productModel = new ProductModel();

        try {
            $result = $productModel->delete_product($id);

            if ($result['success']) {
                $_SESSION['success_message'] = $result['message'];
            } else {
                $_SESSION['error_message'] = $result['message'];
            }
        } catch (Exception $e) {
            error_log("Error in ProductDeleteController: " . $e->getMessage());
            $_SESSION['error_message'] = "Failed to delete product: " . $e->getMessage();
        }

        header('Location: ?act=products-list');
        exit;
    }
}

?>