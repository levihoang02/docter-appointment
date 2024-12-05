<?php
require_once __DIR__ . '/../services/database.php';
require_once __DIR__ . '/../controllers/BookingController.php';
require_once __DIR__ . '/../controllers/DocterController.php';
require_once __DIR__ . '/../controllers/OfficeController.php';
require_once __DIR__ . '/../controllers/SlotController.php';
require_once __DIR__ . '/../controllers/PatientController.php';
require_once __DIR__ . '/../controllers/StatusController.php';

$db = Database::getInstance();

$controller = new BookingController($db->getConnection());
$results = $controller->findBookingAll();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Doctor Booking Appointments</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Doctor Booking Appointments</h2>
        <?php
        if ($results->num_rows > 0) {
            echo '<table class="table table-striped">';
            echo '<thead class="thead-dark"><tr><th>ID</th><th>Patient Name</th><th>Doctor Name</th><th>Appointment Date</th><th>Appointment Time</th></tr></thead>';
            echo '<tbody>';
            // Output data of each row
            while($row = $results->fetch_assoc()) {
                $patientModel = new PatientController($db->getConnection());
                $docterModel = new DocterController($db->getConnection());
                $slotModel = new SlotController($db->getConnection());
                $statusModel = new StatusController($db->getConnection());

                $patient = $patientModel->findById($row['patient_id']);
                $docter = $docterModel->findById($row['docter_id']);
                $slot = $slotModel->findById($row['slot_id']);
                $status = $statusModel->findById($row['status_id']);

                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                echo '<td>' . htmlspecialchars($patient['full_name']) . '</td>';
                echo '<td>' . htmlspecialchars($docter['name']) . '</td>';
                echo '<td>' . htmlspecialchars($slot['name']) . '</td>';
                echo '<td>' . htmlspecialchars($status['name']) . '</td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<div class="alert alert-warning" role="alert">No appointments found.</div>';
        }
        ?>
    </div>
    
</body>
</html>