<?php
require_once __DIR__ . '/../models/Patient.php';

class PatientController {
    private $patientModel;
    
    public function __construct($db) {
        $this->patientModel = new Patient($db);
    }
    
    public function createIfNotExist($full_name, $phone_no, $dob, $email) {
        if($this->patientModel->findByPhoneAndDob($phone_no, $dob)) {
            $result = $this->patientModel->findByPhoneAndDob($phone_no, $dob);
            $patient = $result->fetch_assoc();
            if($patient) {
                return $patient['id'];
            }
        }
        if($email) {
            return $this->patientModel->insertWithEmail($full_name, $phone_no, $email, $dob);
        }
        else {
            return $this->patientModel->insertWithNoEmail($full_name, $phone_no, $dob);
        }
        return 1;
    }

    public function findById($id) {
        return $this->patientModel->findById($id);
    }
}
?> 