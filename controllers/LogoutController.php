<?php
require_once '../services/AuthService.php';

class LogoutController {
    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function logout() {
        $this->authService->logout();
        // Chuyển hướng về trang login
        header('Location: ./index.php?page=login');
        exit();
    }
}

// Tạo instance của LogoutController và thực thi logout
$controller = new LogoutController();
$controller->logout();
