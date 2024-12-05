<?php
require_once __DIR__ . '/../models/Slot.php';

class SlotController {
    private $slotModel;
    
    public function __construct($db) {
        $this->slotModel = new Slot($db);
    }
    
    public function findAll() {
        return $this->slotModel->getAlSlot();
    }

    public function findById($id) {
        return $this->slotModel->findById($id);
    }
}
?> 