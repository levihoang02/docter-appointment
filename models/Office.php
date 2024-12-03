<?php
class Office {
    private $connection;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function getAllOffice() {
        $stmt = $this->connection->prepare(
            "SELECT * FROM offices"
        );
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}
?>
