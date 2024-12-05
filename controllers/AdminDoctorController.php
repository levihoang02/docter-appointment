<?php
require_once '../../services/AlternateDatabase.php';

class AdminDoctorController {
    private $conn;

    public function __construct() {
        $this->conn = (new AlternateDatabase())->getConnection();
    }

    // Lấy danh sách doctors
    public function getDoctors() {
        $query = "SELECT * FROM docters";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Chỉnh sửa doctor
    public function editDoctor($id, $name, $email, $phone_no, $office_id, $description) {
        $query = "UPDATE docters SET name = ?, email = ?, phone_no = ?, office_id = ?, description = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssi", $name, $email, $phone_no, $office_id, $description, $id);
        return $stmt->execute();
    }

    // Xóa doctor
    public function deleteDoctor($id) {
        $query = "DELETE FROM docters WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Thêm doctor
    public function addDoctor($name, $email, $phone_no, $office_id, $description) {
        $query = "INSERT INTO docters (name, email, phone_no, office_id, description) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssss", $name, $email, $phone_no, $office_id, $description);
        return $stmt->execute();
    }
}
