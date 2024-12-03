<?php
require_once __DIR__ . '/../services/database.php';
require_once __DIR__ . '/../controllers/BookingController.php';
require_once __DIR__ . '/../controllers/DocterController.php';
require_once __DIR__ . '/../controllers/OfficeController.php';
require_once __DIR__ . '/../controllers/PatientController.php';
require_once __DIR__ . '/../controllers/SlotController.php';

$full_name = $_POST['fullname'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$doctor_office = $_POST['doctor_office'] ?? '';
$doctor = $_POST['doctor'] ?? '';
$time_slot = $_POST['time_slot'] ?? '';

$db = Database::getInstance();

$patientController = new PatientController($db->getConnection());
$bookingController = new BookingController($db->getConnection());

$patient_id =$patientController->createIfNotExist($full_name, $phone, $dob, $email);

$bookingController->create($patient_id, $doctor, $time_slot, $doctor_office);

?>