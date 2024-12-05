<?php
require_once __DIR__ . '/../services/database.php';

class AdminStaffController {
    private $conn;

    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    // Lấy danh sách staff
    public function getStaff() {
        $query = "SELECT * FROM officers WHERE role = 'staff'";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Chỉnh sửa staff
    public function editStaff($id, $username, $full_name, $email, $role) {
        $query = "UPDATE officers SET username = ?, full_name = ?, email = ?, role = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssssi", $username, $full_name, $email, $role, $id);
        return $stmt->execute();
    }

    // Xóa staff
    public function deleteStaff($id) {
        $query = "DELETE FROM officers WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Thêm staff
    public function addStaff($username, $full_name, $email, $role) {
        $query = "INSERT INTO officers (username, full_name, email, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $username, $full_name, $email, $role);
        return $stmt->execute();
    }
}
