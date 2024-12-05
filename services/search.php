<?php
require_once __DIR__ . '/../services/database.php';
require_once __DIR__ . '/../controllers/BookingController.php';
require_once __DIR__ . '/../controllers/DocterController.php';
require_once __DIR__ . '/../controllers/OfficeController.php';
require_once __DIR__ . '/../controllers/SlotController.php';
require_once __DIR__ . '/../controllers/StatusController.php';

$db = Database::getInstance();

$model = $_GET['model'] ?? '';
$query = $_GET['query'] ?? '';

$resultsArray = [];

if($model == 'offices') {
    $controller = new OfficeController($db->getConnection());
    $results = $controller->findAll();
    while ($row = $results->fetch_assoc()) {
        $resultsArray[] = ['id' => $row['id'], 'name' => $row['name']];
    }
    echo json_encode($resultsArray);
}
else if($model == 'docters') {
    $controller = new DocterController($db->getConnection());
    $results = $controller->findByOfficeId($query);
    while ($row = $results->fetch_assoc()) {
        $resultsArray[] = ['id' => $row['id'], 'name' => $row['name']];
    }
    echo json_encode($resultsArray);
}
else if($model == 'slots') {
    if($query=='all') {
        $controller = new SlotController($db->getConnection());
        $results = $controller->findAll();
        while ($row = $results->fetch_assoc()) {
            $resultsArray[] = ['id' => $row['id'], 'name' => $row['name']];
        }
        echo json_encode($resultsArray);
    }
    else {
        $controller = new BookingController($db->getConnection());
        $results = $controller->findBookingByDocterId($query);
        while ($row = $results->fetch_assoc()) {
            $resultsArray[] = ['id' => $row['id'], 'name' => $row['name']];
        }
        echo json_encode($resultsArray);
    }
}
else {
    echo json_encode(['error' => 'Invalid model specified']);
}
?>
