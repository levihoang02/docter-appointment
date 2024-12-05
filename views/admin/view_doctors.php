<?php
require_once '../../controllers/AdminDoctorController.php';

$controller = new AdminDoctorController();

// Xử lý POST (Save, Delete, Add)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_doctor'])) {
        $controller->editDoctor($_POST['id'], $_POST['name'], $_POST['email'], $_POST['phone_no'], $_POST['office_id'], $_POST['description']);
    } elseif (isset($_POST['delete_doctor'])) {
        $controller->deleteDoctor($_POST['id']);
    } elseif (isset($_POST['add_doctor'])) {
        $controller->addDoctor($_POST['name'], $_POST['email'], $_POST['phone_no'], $_POST['office_id'], $_POST['description']);
    }
}

// Lấy danh sách doctors
$doctors = $controller->getDoctors();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Doctors</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center">Manage Doctors</h2>
        <a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>

        <!-- Add Doctor Form -->
        <form method="POST" class="mb-4">
            <h4>Add New Doctor</h4>
            <div class="row mb-2">
                <div class="col-md-3">
                    <input type="text" name="name" placeholder="Name" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <input type="email" name="email" placeholder="Email" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <input type="text" name="phone_no" placeholder="Phone" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <input type="number" name="office_id" placeholder="Office ID" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <input type="text" name="description" placeholder="Description" class="form-control" required>
                </div>
                <div class="col-md-1">
                    <button type="submit" name="add_doctor" class="btn btn-success w-100">Add</button>
                </div>
            </div>
        </form>

        <!-- Doctor Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Office</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($doctors as $doctor): ?>
                <tr id="doctor-<?= $doctor['id'] ?>">
                    <form method="POST">
                        <td><?= htmlspecialchars($doctor['id']) ?></td>
                        <td>
                            <span class="view-mode"><?= htmlspecialchars($doctor['name']) ?></span>
                            <input type="hidden" name="id" value="<?= $doctor['id'] ?>">
                            <input type="text" name="name" value="<?= $doctor['name'] ?>" class="form-control edit-mode d-none" required>
                        </td>
                        <td>
                            <span class="view-mode"><?= htmlspecialchars($doctor['email']) ?></span>
                            <input type="email" name="email" value="<?= $doctor['email'] ?>" class="form-control edit-mode d-none" required>
                        </td>
                        <td>
                            <span class="view-mode"><?= htmlspecialchars($doctor['phone_no']) ?></span>
                            <input type="text" name="phone_no" value="<?= $doctor['phone_no'] ?>" class="form-control edit-mode d-none" required>
                        </td>
                        <td>
                            <span class="view-mode"><?= htmlspecialchars($doctor['office_id']) ?></span>
                            <input type="number" name="office_id" value="<?= $doctor['office_id'] ?>" class="form-control edit-mode d-none" required>
                        </td>
                        <td>
                            <span class="view-mode"><?= htmlspecialchars($doctor['description']) ?></span>
                            <input type="text" name="description" value="<?= $doctor['description'] ?>" class="form-control edit-mode d-none" required>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning toggle-edit">Edit</button>
                            <button type="submit" name="save_doctor" class="btn btn-sm btn-success d-none save-mode">Save</button>
                            <button type="submit" name="delete_doctor" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </form>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.toggle-edit').forEach(button => {
            button.addEventListener('click', function () {
                const row = this.closest('tr');
                row.querySelectorAll('.view-mode').forEach(el => el.classList.add('d-none'));
                row.querySelectorAll('.edit-mode').forEach(el => el.classList.remove('d-none'));
                row.querySelector('.save-mode').classList.remove('d-none');
                this.classList.add('d-none');
            });
        });
    </script>
</body>
</html>
