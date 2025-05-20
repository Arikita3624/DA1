<?php
$success_message = $_SESSION['success_message'] ?? null;
$error_message = $_SESSION['error_message'] ?? null;

unset($_SESSION['success_message'], $_SESSION['error_message']);
?>

<h2 class="mb-4">Add New Category</h2>

<?php if ($success_message): ?>
  <p style="color:green;"><?php echo htmlspecialchars($success_message); ?></p>
<?php endif; ?>

<?php if ($error_message): ?>
  <p style="color:red;"><?php echo htmlspecialchars($error_message); ?></p>
<?php endif; ?>

<form action="?act=category-add" method="POST">
  <div class="mb-3">
    <label class="form-label">Category Name</label>
    <input type="text" class="form-control" name="name" required>
  </div>
  <button type="submit" class="btn btn-primary" name="add">Add Category</button>
</form>
