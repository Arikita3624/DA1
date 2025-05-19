<?php
require_once("./views/header_footer/Header.php");

global $content;

// Thông báo lỗi hoặc thành công
if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success" id="alert-box" style="background-color: #e6ffe6; color: #006600; padding: 10px; margin: 15px auto; border-radius: 5px; width: 90%; max-width: 600px;">
        <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
    <?php unset($_SESSION['success']);
endif;

if (isset($_SESSION['error'])): ?>
    <div class="alert alert-error" id="alert-box" style="background-color: #ffe6e6; color: #cc0000; padding: 10px; margin: 15px auto; border-radius: 5px; width: 90%; max-width: 600px;">
        <?= htmlspecialchars($_SESSION['error']) ?>
    </div>
    <?php unset($_SESSION['error']);
endif;
?>

<!-- ✅ Script ẩn thông báo sau 3 giây -->
<script>
    const alertBox = document.getElementById('alert-box');
    if (alertBox) {
        setTimeout(() => {
            alertBox.style.opacity = '0';
            alertBox.style.transition = 'opacity 0.5s ease';
            setTimeout(() => alertBox.style.display = 'none', 500);
        }, 1500);
    }
</script>

<?php
// Hiển thị nội dung trang con
if (!empty($content) && file_exists($content)) {
    require_once $content;
} else {
    die("Error: Content file '$content' not found.");
}

require_once("./views/header_footer/Footer.php");
?>
