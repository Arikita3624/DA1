<?php
require_once('/xampp/htdocs/DUAN1/commons/function.php');

class ProductModel
{
  private $conn;

  public function __construct()
  {
    $this->conn = connectDB();
  }

  public function get_all_products()
  {
    $sql = "SELECT products.*, categories.name AS category_name,
                (CASE WHEN products.status = 1 THEN 'On going' ELSE 'Deleted' END) AS status_name
                FROM products
                LEFT JOIN categories ON products.category_id = categories.id
                ORDER BY products.id DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_all_categories()
  {
    $sql = "SELECT * FROM categories ORDER BY name ASC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function add_product($data)
  {
    if (empty($data['name']) || empty($data['category_id'])) {
      throw new Exception("Product name and category are required.");
    }

    $sql = "INSERT INTO products (name, image, price, quantity, status, category_id, description, created_at, updated_at)
                VALUES (:name, :image, :price, :quantity, :status, :category_id, :description, NOW(), NOW())";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':name', $data['name']);
    $stmt->bindParam(':image', $data['image']);
    $stmt->bindParam(':price', $data['price'], PDO::PARAM_INT);
    $stmt->bindParam(':quantity', $data['quantity'], PDO::PARAM_INT);
    $stmt->bindParam(':status', $data['status'], PDO::PARAM_INT);
    $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
    $stmt->bindParam(':description', $data['description']);
    return $stmt->execute();
  }
  public function get_product_by_id($id)
  {
    $sql = "SELECT * FROM products WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function update_product($data, $id)
  {
    $sql = "UPDATE products SET name = :name, image = :image, price = :price, quantity = :quantity,
                status = :status, category_id = :category_id, description = :description, updated_at = NOW()
                WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':name', $data['name']);
    $stmt->bindParam(':image', $data['image']);
    $stmt->bindParam(':price', $data['price'], PDO::PARAM_INT);
    $stmt->bindParam(':quantity', $data['quantity'], PDO::PARAM_INT);
    $stmt->bindParam(':status', $data['status'], PDO::PARAM_INT);
    $stmt->bindParam(':category_id', $data['category_id'], PDO::PARAM_INT);
    $stmt->bindParam(':description', $data['description']);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }
  public function get_products_by_category_id($category_id)
  {
    $stmt = $this->conn->prepare("SELECT * FROM products WHERE category_id = ?");
    $stmt->execute([$category_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
   public function delete_product($id) {
        try {
            $sql = "DELETE FROM products WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $result = $stmt->execute();

            return [
                'success' => $result,
                'message' => $result ? 'Xóa sản phẩm thành công.' : 'Xóa sản phẩm thất bại.'
            ];
        } catch (Exception $e) {
            error_log("Lỗi trong delete_product: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Lỗi khi xóa sản phẩm: ' . $e->getMessage()
            ];
        }
    }
}
