<?php
class Slot {
    private $connection;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function getAlSlot() {
        $stmt = $this->connection->prepare(
            "SELECT * FROM slots"
        );
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function findSlotsByFilters($startDate, $endDate, $docterId) {
        $stmt = $this->connection->prepare(
            "SELECT 
                b.id, 
                b.booking_date, 
                d.name AS doctor_name, 
                s.name AS slot_name,
                s.id as slot_id
            FROM 
                bookings b
            JOIN 
                docters d ON b.docter_id = d.id
            JOIN 
                slots s ON b.slot_id = s.id
            WHERE 
                b.booking_date BETWEEN ? AND ? AND 
                b.docter_id = ? AND b.status_id = 2
                ORDER BY `b`.`booking_date` DESC"
        );
    
        // Use 's' for strings (dates) and 'i' for the integer (docterId)
        $stmt->bind_param('ssi', $startDate, $endDate, $docterId);
    
        $stmt->execute();
    
        return $stmt->get_result();
    }
}
?>
