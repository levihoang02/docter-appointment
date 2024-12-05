<?php
require_once './services/database.php';



class StaffController {
    private $conn;

    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    public function getBookings() {
        $query = "SELECT 
                    bookings.id AS booking_id,
                    patients.full_name AS patient_name,
                    docters.name AS doctor_name,
                    offices.name AS office_name,
                    slots.name AS slot_name,
                    statuses.name AS status_name
                  FROM bookings
                  JOIN patients ON bookings.patient_id = patients.id
                  JOIN docters ON bookings.docter_id = docters.id
                  JOIN offices ON docters.office_id = offices.id
                  JOIN slots ON bookings.slot_id = slots.id
                  JOIN statuses ON bookings.status_id = statuses.id";

        $result = $this->conn->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }
}

// Tạo instance của StaffController và lấy dữ liệu bookings
$controller = new StaffController();
$bookings = $controller->getBookings();
