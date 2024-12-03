<?php
class Patient {
    private $connection;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function findById($id) {
        $stmt = $this->connection->prepare(
            "SELECT * FROM patient_bookings WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function findSlotsByBookingInfo($docter_id, $office_id) {
        $stmt = $this->connection->prepare(
            "SELECT slot_id FROM patient_bookings WHERE docter_id = ? OR office_id= ?"
        );
        $stmt->bind_param("ii", $docter_id, $office_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function insert($patient_id, $docter_id, $slot_id, $office_id) {
        $stmt = $this->connection->prepare(
            "INSERT INTO patient_bookings (patient_id, docter_id, slot_id, office_id)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("iiii", $patient_id, $docter_id, $slot_id, $office_id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM patient_bookings WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
