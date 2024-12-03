<?php
require_once __DIR__ . '/../models/Patient.php';

class UserController {
    private $patientModel;
    
    public function __construct($db) {
        $this->patientModel = new User($db);
    }
    
    public function createIfNotExist($full_name, $phone_no, $dob, $email=null) {
        if($this->patientModel->findByPhoneAndDob($phone_no, $dob)) {
            return 0;
        }
        if($email) {
            $this->patientModel->insertWithEmail($full_name, $phone_no, $email, $dob);
        }
        else {
            $this->patientModel->insertWithNoEmail($full_name, $phone_no, $dob);
        }
        return 1;
    }
}
?> 