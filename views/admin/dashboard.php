<?php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php?page=login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header text-center" style="background-color:lightblue;">
                        <h4>Admin Dashboard</h4>
                        <p>Manage Offices, Staff, Doctors, and Bookings</p>
                    </div>
                    <div class="card-body">
                        <!-- Quick Actions -->
                        <div class="row text-center mb-4">
                            <div class="col-md-6 mb-3">
                                <a href="index.php?page=manage_offices" class="btn btn-outline-primary w-100">Manage Offices</a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="index.php?page=manage_staff" class="btn btn-outline-secondary w-100">Manage Staff</a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="index.php?page=view_doctors" class="btn btn-outline-success w-100">View Doctors</a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="index.php?page=manage_bookings" class="btn btn-outline-warning w-100">Manage Bookings</a>
                            </div>
                        </div>

                        <!-- Logout Button -->
                        <div class="text-center mt-4">
                            <a href="./controllers/LogoutController.php" class="btn btn-danger w-100">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
