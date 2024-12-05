<?php
require_once './controllers/AdminBookingController.php';

$controller = new AdminBookingController();

// Xử lý POST (Save và Delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_booking'])) {
        $controller->editBooking($_POST['id'], $_POST['patient_id'], $_POST['doctor_id'], $_POST['slot_id'], $_POST['status_id']);
    } elseif (isset($_POST['delete_booking'])) {
        $controller->deleteBooking($_POST['id']);
    }
}

// Lấy danh sách bookings
$bookings = $controller->getBookings();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center">Manage Bookings</h2>
        <a href="index.php?page=admin_dashboard" class="btn btn-secondary mb-3">Back to Dashboard</a>
        
        <!-- Booking Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Slot</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                <tr id="booking-<?= $booking['id'] ?>">
                    <form method="POST">
                        <td><?= htmlspecialchars($booking['id']) ?></td>
                        <td>
                            <span class="view-mode"><?= htmlspecialchars($booking['patient_name']) ?></span>
                            <input type="hidden" name="id" value="<?= $booking['id'] ?>">
                            <input type="text" name="patient_id" value="<?= $booking['patient_id'] ?>" class="form-control edit-mode d-none" required>
                        </td>
                        <td>
                            <span class="view-mode"><?= htmlspecialchars($booking['doctor_name']) ?></span>
                            <input type="text" name="doctor_id" value="<?= $booking['doctor_id'] ?>" class="form-control edit-mode d-none" required>
                        </td>
                        <td>
                            <span class="view-mode"><?= htmlspecialchars($booking['slot']) ?></span>
                            <input type="text" name="slot_id" value="<?= $booking['slot_id'] ?>" class="form-control edit-mode d-none" required>
                        </td>
                        <td>
                            <span class="view-mode"><?= htmlspecialchars($booking['status']) ?></span>
                            <input type="text" name="status_id" value="<?= $booking['status_id'] ?>" class="form-control edit-mode d-none" required>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning toggle-edit">Edit</button>
                            <button type="submit" name="save_booking" class="btn btn-sm btn-success d-none save-mode">Save</button>
                            <button type="submit" name="delete_booking" class="btn btn-sm btn-danger">Delete</button>
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
