<?php
require_once __DIR__ . '/../models/Patient.php';

class UserController {
    private $patientModel;
    
    public function __construct($db) {
        $this->patientModel = new User($db);
    }
    
    public function createIfNotExist($full_name, $phone_no, $dob, $email='') {
        if($this->patientModel->findByPhoneAndDob($phone_no, $dob)) {\
            $result = $this->patientModel->findByPhoneAndDob($phone_no, $dob);
            $patient = $result->fetch_assoc();
            return $patient ? $patient['id'];
        }
        if($email) {
            return $this->patientModel->insertWithEmail($full_name, $phone_no, $email, $dob);
        }
        else {
            return $this->patientModel->insertWithNoEmail($full_name, $phone_no, $dob);
        }
        return 1;
    }
}
?> 