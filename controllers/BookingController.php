<?php
require_once __DIR__ . '/../models/Booking.php';

class BookingController {
    private $bookingModel;
    
    public function __construct($db) {
        $this->bookingModel = new Booking($db);
    }
    
    public function create($patient_id, $docter_id, $slot_id, $office_id) {
        $this->bookingModel->create($patient_id, $docter_id, $slot_id, $office_id);
    }

    public function findBookingByDocterId($docter_id) {
        return $this->bookingModel->findByDocterId($docter_id);
    }
}
?> 