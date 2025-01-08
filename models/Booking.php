<?php
class Booking {
    private $connection;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function findById($id) {
        $stmt = $this->connection->prepare(
            "SELECT * FROM bookings WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function findSlotsByBookingInfo($docter_id, $office_id) {
        $stmt = $this->connection->prepare(
            "SELECT b.slot_id, s.slot_name 
             FROM bookings b 
             JOIN slots s ON b.slot_id = s.id 
             WHERE b.docter_id = ? OR b.office_id = ?"
        );
        $stmt->bind_param("ii", $docter_id, $office_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function findByDocterId($docter_id) {
        $stmt = $this->connection->prepare(
            "SELECT s.id, s.name
             FROM bookings b 
             JOIN slots s ON b.slot_id = s.id 
             WHERE b.docter_id = ? AND b.status_id = 1"
        );
        $stmt->bind_param("i", $docter_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    
    public function findAll() {
        $stmt = $this->connection->prepare(
            "SELECT * FROM bookings"
        );
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function findByDocterIdAndDate($docter_id, $date) {
        $stmt = $this->connection->prepare(
            "SELECT s.id, s.name
             FROM bookings b 
             JOIN slots s ON b.slot_id = s.id 
             WHERE b.docter_id = ? AND (b.status_id = 1 AND b.booking_date = ?)"
        );
        $stmt->bind_param("is", $docter_id, $date);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function insert($patient_id, $docter_id, $slot_id, $date) {
        $stmt = $this->connection->prepare(
            "INSERT INTO bookings (patient_id, docter_id, slot_id, date)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("iiis", $patient_id, $docter_id, $slot_id, $date);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM patient_bookings WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
