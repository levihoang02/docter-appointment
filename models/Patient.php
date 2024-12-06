<?php
class Patient {
    private $connection;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function findById($id) {
        $stmt = $this->connection->prepare(
            "SELECT * FROM patients WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function findByPhoneAndDob($phone, $dob) {
        $stmt = $this->connection->prepare(
            "SELECT * FROM patients WHERE phone_no = ? AND dob = ?"
        );
        $stmt->bind_param("ss", $phone, $dob);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function insertWithEmail($full_name, $phone_no, $email, $dob) {
        $stmt = $this->connection->prepare(
            "INSERT INTO patients (full_name, phone_no, email, dob)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("ssss", $full_name, $phone_no, $email, $dob);
        $stmt->execute();
        return $this->connection->insert_id;
    }

    public function insertWithNoEmail($full_name, $phone_no, $dob) {
        $stmt = $this->connection->prepare(
            "INSERT INTO patients (full_name, phone_no, dob)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("ssss", $full_name, $phone_no, $dob);
        $stmt->execute();
        return $this->connection->insert_id;
    }

    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM patients WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
