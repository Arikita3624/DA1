<?php
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : null;

unset($_SESSION['success_message']);
unset($_SESSION['error_message']);
?>

<h2 class="mb-4">Edit Product</h2>

<?php if ($success_message): ?>
    <p style="color:green;"><?php echo htmlspecialchars($success_message); ?></p>
<?php endif; ?>

<?php if ($error_message): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error_message); ?></p>
<?php endif; ?>

<?php global $product_data; ?>
<form action="?act=product-edit&id=<?php echo htmlspecialchars($product_data['id']); ?>" method="POST">
    <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($product_data['name']); ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Image URL</label>
        <input type="text" class="form-control" name="image" value="<?php echo htmlspecialchars($product_data['image']); ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" class="form-control" name="price" value="<?php echo htmlspecialchars($product_data['price']); ?>" min="0" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Quantity</label>
        <input type="number" class="form-control" name="quantity" value="<?php echo htmlspecialchars($product_data['quantity']); ?>" min="0" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select class="form-select" name="status">
            <option value="1" <?php echo $product_data['status'] == 1 ? 'selected' : ''; ?>>On Going</option>
            <option value="2" <?php echo $product_data['status'] == 2 ? 'selected' : ''; ?>>Deleted</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Category</label>
        <select class="form-select" name="category_id" required>
            <option selected disabled value="">-- Select Category --</option>
            <?php
            $categories = (new ProductModel())->get_all_categories();
            foreach ($categories as $category) {
                $selected = $product_data['category_id'] == $category['id'] ? 'selected' : '';
                echo '<option value="' . htmlspecialchars($category['id']) . '" ' . $selected . '>' . htmlspecialchars($category['name']) . '</option>';
            }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" rows="3" name="description"><?php echo htmlspecialchars($product_data['description']); ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary" name="edit">Update Product</button>
</form>