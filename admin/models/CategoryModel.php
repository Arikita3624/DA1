<?php
require_once('/xampp/htdocs/DUAN1/commons/function.php');

class CategoryModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
        if (!$this->conn) {
            throw new Exception("Unable to connect to the database.");
        }
    }

    public function get_all_categories() {
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_category_by_id($id) {
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add_category($name) {
        $sql = "INSERT INTO categories (name, created_at, updated_at) VALUES (:name, NOW(), NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }

    public function update_category($id, $name) {
        $sql = "UPDATE categories SET name = :name, updated_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete_category($id) {
        try {
            $checkSql = "SELECT COUNT(*) FROM products WHERE category_id = :id";
            $checkStmt = $this->conn->prepare($checkSql);
            $checkStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $checkStmt->execute();
            $productCount = $checkStmt->fetchColumn();

            if ($productCount > 0) {
                return [
                    'success' => false,
                    'message' => "Cannot delete category because there are $productCount related products."
                ];
            }

            $sql = "DELETE FROM categories WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $result = $stmt->execute();

            return [
                'success' => $result,
                'message' => $result ? 'Category deleted successfully.' : 'Failed to delete category.'
            ];
        } catch (Exception $e) {
            error_log("Error in delete_category: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Error deleting category: ' . $e->getMessage()
            ];
        }
    }
}
?>
