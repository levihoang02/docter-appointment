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

    public function createSlot($name) {
        return $this->slotModel->createSlot($name);
    }

    public function updateSlot($id, $name) {
        return $this->slotModel->updateSlot($id, $name);
    }
    
    public function findSlotsByFilters($startDate, $endDate, $docterId) {
        return $this->slotModel->findSlotsByFilters($startDate, $endDate, $docterId);
    }
}
?> 