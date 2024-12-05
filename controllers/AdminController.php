<?php
require_once '../services/AlternateDatabase.php';
require_once '../services/AuthService.php';
class AdminController {
    private $db;

    public function __construct() {
        $this->db = (new AlternateDatabase())->getConnection();
    }

    public function saveStaff($data) {
        $query = "INSERT INTO staff (name, email, position) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $data['name'], $data['email'], $data['position']);
        return $stmt->execute();
    }

    public function deleteStaff($id) {
        $query = "DELETE FROM staff WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function fetchOffices() {
        $query = "SELECT * FROM office";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function saveOffice($data) {
        $query = "INSERT INTO office (name, location) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $data['name'], $data['location']);
        return $stmt->execute();
    }

    public function deleteOffice($id) {
        $query = "DELETE FROM office WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function fetchDoctors() {
        $query = "SELECT * FROM doctors";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function fetchStaff() {
        $query = "SELECT * FROM staff";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

// Xử lý request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AdminController();
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'saveStaff':
            echo json_encode($controller->saveStaff($_POST));
            break;
        case 'deleteStaff':
            echo json_encode($controller->deleteStaff($_POST['id']));
            break;
        case 'saveOffice':
            echo json_encode($controller->saveOffice($_POST));
            break;
        case 'deleteOffice':
            echo json_encode($controller->deleteOffice($_POST['id']));
            break;
        default:
            echo json_encode(['error' => 'Invalid action']);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new AdminController();
    $action = $_GET['action'] ?? '';

    switch ($action) {
        case 'fetchOffices':
            echo json_encode($controller->fetchOffices());
            break;
        case 'fetchDoctors':
            echo json_encode($controller->fetchDoctors());
            break;
        case 'fetchStaff':
            echo json_encode($controller->fetchStaff());
            break;
        default:
            echo json_encode(['error' => 'Invalid action']);
    }
}
?>
