<?php
require_once '../services/AuthService.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authService = new AuthService();
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($authService->login($username, $password)) {
        $role = $_SESSION['role'];

        // Điều hướng dựa trên vai trò
        if ($role === 'admin') {
            header('Location: ../index.php?page=admin_dashboard');
        } elseif ($role === 'staff') {
            header('Location: ../index.php?page=staff_dashboard');
        } elseif ($role === 'doctor') {
            header('Location: ../index.php?page=appointments');
        }
    } else {
        echo "Invalid username or password!";
    }
}
?>
