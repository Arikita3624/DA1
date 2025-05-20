<?php
require_once('../admin/models/ProductModel.php');
$productModel = new ProductModel();

// Kiểm tra và lấy thông báo từ session
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : null;

// Xóa thông báo sau khi lấy để tránh hiển thị lại
unset($_SESSION['success_message']);
unset($_SESSION['error_message']);
?>

<h2 class="mb-4">Add New Product</h2>

<?php if ($success_message): ?>
    <p style="color:green;"><?php echo htmlspecialchars($success_message); ?></p>
<?php endif; ?>

<?php if ($error_message): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error_message); ?></p>
<?php endif; ?>

<form action="?act=product-add" method="POST">
    <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" class="form-control" placeholder="Enter product name" name="name" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Image URL</label>
        <input type="text" class="form-control" placeholder="https://example.com/image.jpg" name="image">
    </div>

    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" class="form-control" placeholder="0.00" name="price" min="0" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Quantity</label>
        <input type="number" class="form-control" placeholder="1" name="quantity" min="0" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select class="form-select" name="status">
            <option value="1">On Going</option>
            <option value="2">Deleted</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Category</label>
        <select class="form-select" name="category_id" required>
            <option selected disabled value="">-- Select Category --</option>
            <?php
            $categories = $productModel->get_all_categories();
            foreach ($categories as $category) {
                echo '<option value="' . $category['id'] . '">' . htmlspecialchars($category['name']) . '</option>';
            }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" rows="3" placeholder="Enter description..." name="description"></textarea>
    </div>

    <button type="submit" class="btn btn-primary" name="add">Add Product</button>
</form>