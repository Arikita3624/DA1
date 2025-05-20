<?php
require_once('../admin/models/CategoryModel.php');
$categoryModel = new CategoryModel();
$category_list = $categoryModel->get_all_categories();

$success_message = $_SESSION['success_message'] ?? null;
$error_message = $_SESSION['error_message'] ?? null;

unset($_SESSION['success_message'], $_SESSION['error_message']);
require_once('../admin/controllers/CategoryController.php');
?>

<div class="mt-4">
    <h2 class="mb-4 d-flex justify-content-between align-items-center">Category List
        <a href="?act=category-add" class="btn btn-primary">Add New Category</a>
    </h2>
</div>

<?php if ($success_message): ?>
    <div id="success-message" class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
<?php endif; ?>

<?php if ($error_message): ?>
    <div id="error-message" class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Category Name</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($category_list as $category): ?>
                <tr id="category-row-<?php echo $category['id']; ?>">
                    <td><?php echo $category['id']; ?></td>
                    <td><?php echo htmlspecialchars($category['name']); ?></td>
                    <td><?php echo htmlspecialchars($category['created_at']); ?></td>
                    <td><?php echo htmlspecialchars($category['updated_at']); ?></td>
                    <td>
                        <a href="?act=delete-category&id=<?php echo $category['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
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
