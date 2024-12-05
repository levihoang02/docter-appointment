<?php
require_once './controllers/AdminOfficeController.php';

$controller = new AdminOfficeController();

// Xử lý POST (Save, Delete, Add)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_office'])) {
        $controller->editOffice($_POST['id'], $_POST['name'], $_POST['address'], $_POST['description']);
    } elseif (isset($_POST['delete_office'])) {
        $controller->deleteOffice($_POST['id']);
    } elseif (isset($_POST['add_office'])) {
        $controller->addOffice($_POST['name'], $_POST['address'], $_POST['description']);
    }
}

// Lấy danh sách offices
$offices = $controller->getOffices();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Offices</title>
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center">Manage Offices</h2>
        <a href="index.php?page=admin_dashboard" class="btn btn-secondary mb-3">Back to Dashboard</a>
        
        <!-- Add Office Form -->
        <form method="POST" class="mb-4">
            <h4>Add New Office</h4>
            <div class="row mb-2">
                <div class="col-md-4">
                    <input type="text" name="name" placeholder="Office Name" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="address" placeholder="Address" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="description" placeholder="Description" class="form-control" required>
                </div>
                <div class="col-md-1">
                    <button type="submit" name="add_office" class="btn btn-success w-100">Add</button>
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($offices as $office): ?>
                <tr id="office-<?= $office['id'] ?>">
                    <form method="POST">
                        <td><?= htmlspecialchars($office['id']) ?></td>
                        <td>
                            <span class="view-mode"><?= htmlspecialchars($office['name']) ?></span>
                            <input type="hidden" name="id" value="<?= $office['id'] ?>">
                            <input type="text" name="name" value="<?= $office['name'] ?>" class="form-control edit-mode d-none" required>
                        </td>
                        <td>
                            <span class="view-mode"><?= htmlspecialchars($office['address']) ?></span>
                            <input type="text" name="address" value="<?= $office['address'] ?>" class="form-control edit-mode d-none" required>
                        </td>
                        <td>
                            <span class="view-mode"><?= htmlspecialchars($office['description']) ?></span>
                            <input type="text" name="description" value="<?= $office['description'] ?>" class="form-control edit-mode d-none" required>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning toggle-edit">Edit</button>
                            <button type="submit" name="save_office" class="btn btn-sm btn-success d-none save-mode">Save</button>
                            <button type="submit" name="delete_office" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </form>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

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
