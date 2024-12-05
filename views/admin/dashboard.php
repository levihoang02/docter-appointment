<?php
require_once '../../services/AuthService.php';

$authService = new AuthService();
$authService->checkRole('admin'); // Chỉ cho phép Admin truy cập
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Admin Dashboard</h4>
                        <p>Manage Offices, Staff, Doctors, and Bookings</p>
                    </div>
                    <div class="card-body">
                        <!-- Quick Actions -->
                        <div class="row text-center mb-4">
                            <div class="col-md-6 mb-3">
                                <a href="/views/admin/manage_offices.php" class="btn btn-outline-primary w-100">Manage Offices</a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="/views/admin/manage_staff.php" class="btn btn-outline-secondary w-100">Manage Staff</a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="/views/admin/view_doctors.php" class="btn btn-outline-success w-100">View Doctors</a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="/views/admin/manage_bookings.php" class="btn btn-outline-warning w-100">Manage Bookings</a>
                            </div>
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
