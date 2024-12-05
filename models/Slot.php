<?php
class Slot {
    private $connection;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function getAlSlot() {
        $stmt = $this->connection->prepare(
            "SELECT * FROM slots"
        );
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function findById($id) {
        $stmt = $this->connection->prepare(
            "SELECT * FROM slots WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>