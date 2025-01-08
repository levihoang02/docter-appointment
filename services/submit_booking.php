<?php
require_once __DIR__ . '/../services/database.php';
require_once __DIR__ . '/../controllers/BookingController.php';
require_once __DIR__ . '/../controllers/PatientController.php';

$db = Database::getInstance();
$bookingController = new BookingController($db->getConnection());
$patientController = new PatientController($db->getConnection());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $slotId = $_POST['slot_id'];
        $slotDate = $_POST['slot_date'];
        $doctorId = $_POST['slot_doctor_id'];
        $fullName = $_POST['full_name'];
        $phone = $_POST['phone'];
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $dob = $_POST['dob'];
        $patientId = $patientController->createIfNotExist($fullName, $phone, $dob, $email);
        $result = $bookingController->create($patientId, $doctorId, $slotId, $slotDate);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        } 
    }  catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error processing your request: ' . $e->getMessage()]);
    }
}
?>