<?php
    require_once __DIR__ . '/../services/database.php';
    require_once __DIR__ . '/../controllers/SlotController.php';

    $db = Database::getInstance();
    $slotModel = new SlotController($db->getConnection());

    // Handle form submissions
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['new_timeslot'])) {
            // Create new time slot
            $new_timeslot = $_POST['new_timeslot'];
            $slotModel->createSlot($new_timeslot);
            // Refresh the page to see the new time slot
            header("Location: ../index.php?page=timeslot");
        } elseif (isset($_POST['timeslot']) && isset($_POST['id'])) {
            // Update existing time slot
            $id = intval($_POST['id']);
            $timeslot = $_POST['timeslot'];
            $slotModel->updateSlot($id, $timeslot);
            // Refresh the page to see the updated time slot
            header("Location: ../index.php?page=timeslot");
        }
    }
?>