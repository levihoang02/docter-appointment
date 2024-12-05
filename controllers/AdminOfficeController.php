<?php
require_once '../../services/AlternateDatabase.php';

class AdminOfficeController {
    private $conn;

    public function __construct() {
        $this->conn = (new AlternateDatabase())->getConnection();
    }

    // Lấy danh sách offices
    public function getOffices() {
        $query = "SELECT * FROM offices";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Chỉnh sửa office
    public function editOffice($id, $name, $address, $description) {
        $query = "UPDATE offices SET name = ?, address = ?, description = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssi", $name, $address, $description, $id);
        return $stmt->execute();
    }

    // Xóa office
    public function deleteOffice($id) {
        $query = "DELETE FROM offices WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Thêm office
    public function addOffice($name, $address, $description) {
        $query = "INSERT INTO offices (name, address, description) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $name, $address, $description);
        return $stmt->execute();
    }
}
