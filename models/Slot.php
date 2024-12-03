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
}
?>
