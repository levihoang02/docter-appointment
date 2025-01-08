<?php
require_once __DIR__ . '/../services/database.php';
require_once __DIR__ . '/../controllers/SlotController.php';

$db = Database::getInstance();
$slotController = new SlotController($db->getConnection());

$startDate = $_GET['start_date'] ?? '';
$endDate = $_GET['end_date'] ?? '';
$docterId = $_GET['doctor_id'] ?? '';

$results = $slotController->findSlotsByFilters($startDate, $endDate, $docterId);

$slots = [];
while ($row = $results->fetch_assoc()) {
    $slots[] = [
        'id' => $row['slot_id'],
        'date' => $row['date'],
        'time' => $row['slot_name'],
        'doctor_name' => $row['doctor_name']
    ];
}
echo json_encode($slots);
