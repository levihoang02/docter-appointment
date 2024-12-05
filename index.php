<?php
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/':
    case '':
        require __DIR__ . '/views/shared/login.php'; // Trang login mặc định
        break;

    case '/views/admin/dashboard.php':
        require __DIR__ . '/views/admin/dashboard.php'; // Admin Dashboard
        break;

    case '/views/staff/dashboard.php':
        require __DIR__ . '/views/staff/dashboard.php'; // Staff Dashboard
        break;

    case '/views/shared/booking.php':
        require __DIR__ . '/views/shared/booking.php'; // Trang Booking cho Patient
        break;

    default:
        http_response_code(404);
        echo "Page not found!";
        break;
}
?>
