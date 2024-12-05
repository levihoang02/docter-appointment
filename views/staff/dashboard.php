<?php
require_once '../../controllers/StaffController.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Staff Dashboard</h4>
                        <p>View all appointment details here</p>
                    </div>
                    <div class="card-body">
                        <!-- Booking Table -->
                        <h5 class="mb-3">Doctor Bookings</h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Booking ID</th>
                                        <th>Patient Name</th>
                                        <th>Doctor Name</th>
                                        <th>Office</th>
                                        <th>Slot</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($bookings)): ?>
                                        <?php foreach ($bookings as $booking): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($booking['booking_id']); ?></td>
                                                <td><?php echo htmlspecialchars($booking['patient_name']); ?></td>
                                                <td><?php echo htmlspecialchars($booking['doctor_name']); ?></td>
                                                <td><?php echo htmlspecialchars($booking['office_name']); ?></td>
                                                <td><?php echo htmlspecialchars($booking['slot_name']); ?></td>
                                                <td><?php echo htmlspecialchars($booking['status_name']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No bookings found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Logout Button -->
                        <div class="text-center mt-4">
                            <a href="/controllers/LogoutController.php" class="btn btn-danger w-100">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-5">
        <p>&copy; 2024 Doctor Appointment System. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>