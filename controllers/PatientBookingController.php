<?php
require_once __DIR__ . '/../models/Patient_Booking.php';

class UserController {
    private $bookingModel;
    
    public function __construct($db) {
        $this->bookingModel = new User($db);
    }
    
    public function create($patient_id, $docter_id, $slot_id, $office_id) {
        $this->bookingModel->create($patient_id, $docter_id, $slot_id, $office_id);
    }

    public function findBookedSlots($docter_id=null, $office_id=null) {
        $slots = $this->bookingModel->findSlotsByBookingInfo($docter_id, $office_id)
        return $slots;
    }
}
?> 