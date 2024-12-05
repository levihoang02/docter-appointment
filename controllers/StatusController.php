<?php
require_once __DIR__ . '/../models/Status.php';

class StatusController {
    private $statusModel;
    
    public function __construct($db) {
        $this->statusModel = new Status($db);
    }

    public function findById($id) {
        return $this->statusModel->findById($id);
    }
}
?> 