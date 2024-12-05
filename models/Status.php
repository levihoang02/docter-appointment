<?php
class Status {
    private $connection;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function findById($id) {
        $stmt = $this->connection->prepare(
            "SELECT * FROM statuses WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>
