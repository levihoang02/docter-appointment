<?php

require_once 'controllers/DoctorController.php';
require_once 'controllers/AppointmentController.php';
require_once 'services/database.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($path === '/appointments' && $method === 'POST') {
    $conn = getDatabaseConnection();
    $payload = json_decode(file_get_contents('php://input'), true);
    $controller = new AppointmentController();
    $controller->create($conn, $payload['full_name'], $payload['phone_number'], $payload['email'], $payload['office_id'], $payload['doctor_id'], $payload['time_slot_id']);
    closeDatabaseConnection($conn);
}


if ($path === '/appointments' && $method === 'GET') {
    $conn = getDatabaseConnection();
    $payload = json_decode(file_get_contents('php://input'), true);
    $controller = new AppointmentController();
    $controller->getAppointmentsByOfficeId($conn, $payload['office_id']);
    closeDatabaseConnection($conn);
}

if ($path === '/appointments' && $method === 'PUT') {
    $conn = getDatabaseConnection();
    $payload = json_decode(file_get_contents('php://input'), true);
    $controller = new AppointmentController();
    $controller->updateAppointmentStatus($conn, $payload['id'], $payload['status']);
    closeDatabaseConnection($conn);
}

if ($path === '/appointments' && $method === 'DELETE') {
    $conn = getDatabaseConnection();
    $payload = json_decode(file_get_contents('php://input'), true);
    $controller = new AppointmentController();
    $controller->deleteAppointment($conn, $payload['id']);
    closeDatabaseConnection($conn);
}

if ($path == '/login' && $method == 'POST') {
    $conn = getDatabaseConnection();
    $payload = json_decode(file_get_contents('php://input'), true);
    $controller = new AuthController();
    $controller->login($conn, $payload['username'], $payload['password']);
    closeDatabaseConnection($conn);
}

?>
