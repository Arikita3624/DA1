<body class="auth-page">
    <div class="auth-container">
        <h2>Login</h2>
        <form class="auth-form" action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="auth-input" required>
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
</body>