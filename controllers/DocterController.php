<?php
require_once __DIR__ . '/../models/Docter.php';

class DocterController {
    private $docterModel;
    
    public function __construct($db) {
        $this->docterModel = new Docter($db);
    }
    
    public function findByOfficeId($officeId) {
        return $this->docterModel->getByPfficeId($officeId);
    }

    public function findById($id) {
        return $this->docterModel->findById($id);
    }

    public function findAll() {
        return $this->docterModel->findAll();
    }
}
?> 