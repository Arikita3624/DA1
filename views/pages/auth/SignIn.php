<div class="auth-container">
    <h2>Login</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="error-message">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="success-message">
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <form class="auth-form" action="?act=login" method="POST">
        <div class="form-group">
            <label for="email">Username or Email</label>
            <input type="text" id="email" name="email" class="auth-input" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="auth-input" required>
        </div>
        <button type="submit" class="auth-button">Login</button>
    </form>

    <div class="auth-link">
        <p>Don't have an account? <a href="?act=register">Register here</a></p>
    </div>
</div>
