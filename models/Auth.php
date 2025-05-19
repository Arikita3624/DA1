<?php
require_once './commons/function.php';
$conn = connectDB();

class Auth {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function register($username, $email, $password, $address, $telephone) {
        try {
            $sql = "SELECT * FROM users WHERE username = :username OR email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':username' => $username, ':email' => $email]);

            if ($stmt->rowCount() > 0) {
                return "Username or email already exists";
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (username, email, password, address, telephone, role)
                    VALUES (:username, :email, :password, :address, :telephone, 'user')";
            $stmt = $this->conn->prepare($sql);

            $success = $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':password' => $hashedPassword,
                ':address' => $address,
                ':telephone' => $telephone
            ]);

            return $success ? true : "Failed to register user.";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function login($email, $password) {
        try {
            $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':email' => $email]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }

            return false;
        } catch (PDOException $e) {
            return false;
        }
    }
}
