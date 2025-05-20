<?php
    // Turn off display errors on screen, only write to log
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    ini_set('log_errors', 1);
    error_reporting(E_ALL);

    require_once('../admin/models/CategoryModel.php');

    header('Content-Type: application/json; charset=utf-8');

    try {
        $category_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($category_id <= 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid category ID.'
            ]);
            exit;
        }

        $categoryModel = new CategoryModel();
        $result = $categoryModel->delete_category($category_id);
        echo json_encode($result);
    } catch (Exception $e) {
        error_log("Error deleting category: " . $e->getMessage());
        echo json_encode([
            'success' => false,
            'message' => 'Server error: ' . $e->getMessage()
        ]);
    }
    ?>
