<?php
require_once __DIR__ . '/../models/Booking.php';

class BookingController {
    private $bookingModel;
    
    public function __construct($db) {
        $this->bookingModel = new Booking($db);
    }
    
    public function create($patient_id, $docter_id, $slot_id, $date) {
        $this->bookingModel->insert($patient_id, $docter_id, $slot_id, $date);
        return true;
    }

    public function findBookingByDocterId($docter_id) {
        return $this->bookingModel->findByDocterId($docter_id);
    }

    public function findBookingAll() {
        return $this->bookingModel->findAll();
    }
    public function findByDocterIdAndDate($docter_id, $date) {
        return $this->bookingModel->findByDocterIdAndDate($docter_id, $date);
    }


}
?> 