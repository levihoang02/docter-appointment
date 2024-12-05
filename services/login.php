<?php
// controllers/LoginController.php
require_once '../services/AuthService.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authService = new AuthService();
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($authService->login($username, $password)) {
        $role = $_SESSION['role'];
        if ($role === 'admin') {
            header('Location: /views/admin/dashboard.php');
        } else {
            header('Location: /views/staff/dashboard.php');
        }
    } else {
        echo "Tên đăng nhập hoặc mật khẩu không đúng!";
    }
}
?>
