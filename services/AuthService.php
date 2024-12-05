<?php
require_once 'AlternateDatabase.php';

class AuthService {
    private $conn;

    public function __construct() {
        $this->conn = (new AlternateDatabase())->getConnection();
    }

    public function login($username, $password) {
        $query = "SELECT * FROM officers WHERE username = ? AND password = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            return true;
        }
        return false;
    }

    public function logout() {
        session_start();
        session_destroy();
    }

    public function checkRole($requiredRole) {
        session_start();

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole) {
            header('Location: /views/shared/login.php?error=unauthorized');
            exit();
        }
    }
}
