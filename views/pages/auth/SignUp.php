<div class="auth-container">
    <h2>Register</h2>
    <form class="auth-form" action="?act=register" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="auth-input"
                   value="<?php echo isset($_SESSION['form_data']['username']) ? htmlspecialchars($_SESSION['form_data']['username']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="auth-input"
                   value="<?php echo isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : ''; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="auth-input" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" class="auth-input"
                   value="<?php echo isset($_SESSION['form_data']['address']) ? htmlspecialchars($_SESSION['form_data']['address']) : ''; ?>">
        </div>
        <div class="form-group">
            <label for="telephone">Phone</label>
            <input type="text" id="telephone" name="telephone" class="auth-input"
                   value="<?php echo isset($_SESSION['form_data']['telephone']) ? htmlspecialchars($_SESSION['form_data']['telephone']) : ''; ?>">
        </div>
        <button type="submit" class="auth-button">Register</button>
    </form>
    <div class="auth-link">
        <p>Already have an account? <a href="?act=login">Login here</a></p>
    </div>
</div>

<?php
// Clear form data after display
if (isset($_SESSION['form_data'])) {
    unset($_SESSION['form_data']);
}
?>