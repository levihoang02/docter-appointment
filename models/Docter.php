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
}
?>
