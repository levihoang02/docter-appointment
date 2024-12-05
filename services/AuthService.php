<?php
require_once __DIR__ . '/../services/database.php';



class AuthService {
    private $conn;

    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
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
}
