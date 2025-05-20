<?php
require_once('../admin/models/CategoryModel.php');

class CategoryController
{
    public function index()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->get_all_categories();

        global $content_admin, $category_list;
        $category_list = $categories;
        $content_admin = '../admin/views/Category/category_list.php';
        require_once "../admin/views/layouts/main_admin.php";
    }
}

class CategoryAddController
{
    public function addCategory()
    {
        $categoryModel = new CategoryModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';

            if (empty($name)) {
                $_SESSION['error_message'] = "Category name cannot be empty.";
                global $content_admin;
                $content_admin = '../admin/views/Category/category_add.php';
                require_once "../admin/views/layouts/main_admin.php";
                return;
            }

            try {
                $categoryModel->add_category($name);
                $_SESSION['success_message'] = "Category added successfully!";
                header('Location: ?act=category-list');
                exit;
            } catch (Exception $e) {
                $_SESSION['error_message'] = "Failed to add category: " . $e->getMessage();
            }
        }

        global $content_admin;
        $content_admin = '../admin/views/Category/category_add.php';
        require_once "../admin/views/layouts/main_admin.php";
    }
}

class CategoryDeleteController
{
    public function deleteCategory($id)
    {
        $categoryModel = new CategoryModel();

        try {
            $result = $categoryModel->delete_category($id);

            if ($result['success']) {
                $_SESSION['success_message'] = $result['message'];
            } else {
                $_SESSION['error_message'] = $result['message'];
            }
        } catch (Exception $e) {
            error_log("Error in CategoryDeleteController: " . $e->getMessage());
            $_SESSION['error_message'] = "Failed to delete category: " . $e->getMessage();
        }

        header('Location: ?act=category-list');
        exit;
    }
}
?>
