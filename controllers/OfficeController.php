<?php
require_once __DIR__ . '/../models/Office.php';

class OfficeController {
    private $officeModel;
    
    public function __construct($db) {
        $this->officeModel = new Office($db);
    }
    
    public function findAll() {
        return $this->officeModel->getAllOffice();
    }
}
?> 