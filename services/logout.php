<?php
// controllers/LogoutController.php
require_once '../services/AuthService.php';

$authService = new AuthService();
$authService->logout();
header('Location: ../index.php');
exit();
?>
