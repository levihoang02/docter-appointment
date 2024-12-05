<?php
require_once __DIR__ . '/../services/database.php';

class AdminBookingController {
    private $conn;

    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    public function getBookings() {
        $query = "SELECT 
                    bookings.id,
                    bookings.patient_id,
                    bookings.docter_id AS doctor_id,
                    bookings.slot_id,
                    bookings.status_id,
                    patients.full_name AS patient_name,
                    docters.name AS doctor_name,
                    slots.name AS slot,
                    statuses.name AS status
                FROM bookings
                JOIN patients ON bookings.patient_id = patients.id
                JOIN docters ON bookings.docter_id = docters.id
                JOIN slots ON bookings.slot_id = slots.id
                JOIN statuses ON bookings.status_id = statuses.id";

        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function editBooking($id, $patient_id, $doctor_id, $slot_id, $status_id) {
        $query = "UPDATE bookings SET patient_id = ?, docter_id = ?, slot_id = ?, status_id = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iiiii", $patient_id, $doctor_id, $slot_id, $status_id, $id);
        return $stmt->execute();
    }

    public function deleteBooking($id) {
        $query = "DELETE FROM bookings WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
