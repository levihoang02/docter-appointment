<?php
require_once '../../controllers/AdminStaffController.php';

$controller = new AdminStaffController();

// Xử lý POST (Save, Delete, Add)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_staff'])) {
        $controller->editStaff($_POST['id'], $_POST['username'], $_POST['full_name'], $_POST['email'], $_POST['role']);
    } elseif (isset($_POST['delete_staff'])) {
        $controller->deleteStaff($_POST['id']);
    } elseif (isset($_POST['add_staff'])) {
        $controller->addStaff($_POST['username'], $_POST['full_name'], $_POST['email'], $_POST['role']);
    }
}

// Lấy danh sách staff
$staff = $controller->getStaff();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center">Manage Staff</h2>
        <a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>
        
        <!-- Add Staff Form -->
        <form method="POST" class="mb-4">
            <h4>Add New Staff</h4>
            <div class="row mb-2">
                <div class="col-md-3">
                    <input type="text" name="username" placeholder="Username" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="full_name" placeholder="Full Name" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <input type="email" name="email" placeholder="Email" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <select name="role" class="form-control" required>
                        <option value="staff">Staff</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" name="add_staff" class="btn btn-success w-100">Add</button>
                </div>
            </div>
        </form>

        <!-- Staff Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($staff as $member): ?>
                <tr id="staff-<?= $member['id'] ?>">
                    <form method="POST">
                        <td><?= htmlspecialchars($member['id']) ?></td>
                        <td>
                            <span class="view-mode"><?= htmlspecialchars($member['username']) ?></span>
                            <input type="hidden" name="id" value="<?= $member['id'] ?>">
                            <input type="text" name="username" value="<?= $member['username'] ?>" class="form-control edit-mode d-none" required>
                        </td>
                        <td>
                            <span class="view-mode"><?= htmlspecialchars($member['full_name']) ?></span>
                            <input type="text" name="full_name" value="<?= $member['full_name'] ?>" class="form-control edit-mode d-none" required>
                        </td>
                        <td>
                            <span class="view-mode"><?= htmlspecialchars($member['email']) ?></span>
                            <input type="email" name="email" value="<?= $member['email'] ?>" class="form-control edit-mode d-none" required>
                        </td>
                        <td>
                            <span class="view-mode"><?= htmlspecialchars($member['role']) ?></span>
                            <input type="text" name="role" value="<?= $member['role'] ?>" class="form-control edit-mode d-none" required>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning toggle-edit">Edit</button>
                            <button type="submit" name="save_staff" class="btn btn-sm btn-success d-none save-mode">Save</button>
                            <button type="submit" name="delete_staff" class="btn btn-sm btn-danger">Delete</button>
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
