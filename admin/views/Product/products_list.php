<?php
require_once('../admin/models/ProductModel.php');
$productModel = new ProductModel();
$product_list = $productModel->get_all_products();

$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : null;
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : null;

unset($_SESSION['success_message']);
unset($_SESSION['error_message']);
?>

<div class="mt-4">
  <h2 class="mb-4 d-flex justify-content-between align-items-center">Product List
    <a href="?act=product-add" class="btn btn-primary">Add new product</a>
  </h2>
</div>

<?php if ($success_message): ?>
  <div id="success-message" class="alert alert-success" role="alert">
    <?php echo htmlspecialchars($success_message); ?>
  </div>
<?php endif; ?>

<?php if ($error_message): ?>
  <div id="error-message" class="alert alert-danger" role="alert">
    <?php echo htmlspecialchars($error_message); ?>
  </div>
<?php endif; ?>

<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Id</th>
        <th>Product Name</th>
        <th>Image</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Status</th>
        <th>Category</th>
        <th>Description</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($product_list as $product): ?>
        <tr>
          <td><?php echo htmlspecialchars($product['id']); ?></td>
          <td><?php echo htmlspecialchars($product['name']); ?></td>
          <td><img src="<?php echo htmlspecialchars($product['image']); ?>" class="img-thumbnail" style="width: 100px;" alt="Product Image"></td>
          <td><?php echo number_format($product['price'], 0, ',', '.'); ?> VND</td>
          <td><?php echo htmlspecialchars($product['quantity']); ?></td>
          <td>
            <span class="badge <?php echo $product['status'] == 1 ? 'bg-success' : 'bg-secondary'; ?>">
              <?php echo htmlspecialchars($product['status'] == 1 ? 'Active' : 'Deleted'); ?>
            </span>
          </td>
          <td><?php echo htmlspecialchars($product['category_name']); ?></td>
          <td><?php echo htmlspecialchars($product['description']); ?></td>
          <td><?php echo htmlspecialchars($product['created_at']); ?></td>
          <td><?php echo htmlspecialchars($product['updated_at']); ?></td>
          <td>
            <a href="?act=product-edit&id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-sm btn-primary">Edit</a>
            <a href="?act=delete-product&id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script id="notification-script">
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = document.getElementById('success-message');
        const errorMessage = document.getElementById('error-message');

        if (successMessage) {
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 1500);
        }

        if (errorMessage) {
            setTimeout(() => {
                errorMessage.style.display = 'none';
            }, 1500);
        }
    });
</script>
