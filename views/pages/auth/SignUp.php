<body class="auth-page">
    <div class="auth-container">
        <h2>Register</h2>
        <form class="auth-form" action="register.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="auth-input" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="auth-input" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="auth-input" required>
            </div>
            <button type="submit" class="auth-button">Register</button>
        </form>
        <div class="auth-link">
            <p>Already have an account? <a href="?act=login">Login here</a></p>
        </div>
    </div>
</body>