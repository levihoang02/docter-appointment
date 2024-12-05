<?php
class Docter {
    private $connection;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function getByPfficeId($officeId) {
        $stmt = $this->connection->prepare(
            "SELECT * FROM docters WHERE office_id = ?"
        );
        $stmt->bind_param("i", $officeId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function findById($id) {
        $stmt = $this->connection->prepare(
            "SELECT * FROM docters WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function findAll() {
        $stmt = $this->connection->prepare(
            "SELECT * FROM docters"
        );
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}
?>
