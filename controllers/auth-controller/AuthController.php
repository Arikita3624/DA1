<?php
require_once './models/Auth.php';
require_once './commons/function.php';
$conn = connectDB();

class SignInController {
    public function index() {
        global $content;
        $content = "./views/pages/auth/SignIn.php";
        require_once "./views/layouts/main.php";
    }

    public function handleLogin() {
        global $conn;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            // Save user input to fill again if invalid
            $_SESSION['form_data'] = [
                'email' => $email
            ];

            // Validate input
            if (empty($email) || empty($password)) {
                $_SESSION['error'] = "Please fill in all required fields.";
                header("Location: ?act=login");
                exit();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Invalid email format.";
                header("Location: ?act=login");
                exit();
            }

            // Validate account
            $auth = new Auth($conn);
            $user = $auth->login($email, $password);

            if ($user) {
                unset($_SESSION['form_data']);
                $_SESSION['user'] = $user;
                $_SESSION['success'] = "Login successful!";
                header("Location: ?act=/"); // Or redirect to home page, dashboard,...
                exit();
            } else {
                $_SESSION['error'] = "Invalid email or password.";
                header("Location: ?act=login");
                exit();
            }
        }
    }
}

class SignUpController {
    public function index() {
        global $content;
        $content = "./views/pages/auth/SignUp.php";
        require_once "./views/layouts/main.php";
    }

    public function handleRegister() {
        global $conn;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $address = trim($_POST['address'] ?? '');
            $telephone = trim($_POST['telephone'] ?? '');

            $_SESSION['form_data'] = [
                'username' => $username,
                'email' => $email,
                'address' => $address,
                'telephone' => $telephone
            ];

            if (empty($username) || empty($email) || empty($password)) {
                $_SESSION['error'] = "Please fill in all required fields.";
                header("Location: ?act=register");
                exit();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Invalid email format.";
                header("Location: ?act=register");
                exit();
            }

            if (strlen($password) < 6) {
                $_SESSION['error'] = "Password must be at least 6 characters.";
                header("Location: ?act=register");
                exit();
            }

            if (!empty($telephone) && !preg_match('/^[0-9]{10,15}$/', $telephone)) {
                $_SESSION['error'] = "Phone number must be 10-15 digits.";
                header("Location: ?act=register");
                exit();
            }

            $auth = new Auth($conn);
            $result = $auth->register($username, $email, $password, $address, $telephone);

            if ($result === true) {
                unset($_SESSION['form_data']);
                $_SESSION['success'] = "Registration successful! Please log in.";
                header("Location: ?act=login");
                exit();
            } else {
                $_SESSION['error'] = $result ?: "Registration failed. Please try again.";
                header("Location: ?act=register");
                exit();
            }
        }
    }
}

class LogoutController {
    public function index() {
         session_destroy();
         session_start();
         $_SESSION['success'] = 'Logout successful!';
         header("Location: index.php");
         exit();
    }
}
?>

