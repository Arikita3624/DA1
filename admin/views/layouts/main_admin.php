<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Panel</title>
  <?php require_once('../admin/assets/css/libs_css.php'); ?>
  <style>
    .header {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1;
      height: 60px;
    }
    .sidebar {
      position: fixed;
      top: 60px;
      left: 0;
      width: 250px;
      z-index: 1;
    }
    .content {
      flex-grow: 1;
      padding: 20px;
      margin-top: 60px;
      margin-left: 250px;
      z-index: 2;
    }
  </style>
</head>
<body>
  <?php require_once '../admin/views/layouts/header_siderbar/header.php'; ?>

  <div style="display: flex;">
    <?php require_once '../admin/views/layouts/header_siderbar/siderbar.php'; ?>

    <div class="content">
      <?php
        if (!empty($content_admin)) {
            require_once $content_admin;
        } else {
            echo "<p>No content.</p>";
        }
      ?>
    </div>
  </div>

  <?php require_once('../admin/assets/js/libs_js.php'); ?>
</body>
</html>

<script>
    setTimeout(() => {
        const alertBox = document.getElementById('alert-box');
        if (alertBox) {
            alertBox.style.opacity = '0';
            alertBox.style.transition = 'opacity 0.5s ease';
            setTimeout(() => alertBox.style.display = 'none', 500);
        }
    }, 1500);
</script>
