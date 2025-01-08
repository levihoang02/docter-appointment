<?php session_start(); 

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f5f5f5;
            padding-top: 60px;
            height: 100%;
            width: 100%;
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            min-height: 100vh;
            flex-direction: column;
            justify-content:center;
        }
        footer {
            margin-top: 50px;
            padding: 15px;
            width: 100%;
            background-color: lightblue;
            font-weight: bolder;
            font-size: 16px;
            text-align: center;
            
        }
        .content { 
            flex: 1; 
        }
        .navButton {
            border: none;
            margin: 0;
            padding: 12px;
            width: fit-content;
            transition: 0.4s;
            font-size: 16px;
            text-align: center;
            font-weight: bold;
        }
        .navButton:hover {
            margin: 0;
            width: fit-content;
            color: #211f1d;
            font-weight: bold;
            text-align: center;
            background-color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md fixed-top" style="background-color: lightblue;">
        <div class="container-xxl">
            <a href="index.php?page=home" class="navbar-brand">
                <span  class="fw-bold" style="font-size: 24px; color:black;">
                    Doctor Appointment
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav"
                    aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end align-center" id="main-nav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn navButton d-none d-md-block" href="?page=home">HOME</a>
                    </li>
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="btn navButton d-none d-md-block" href="?page=view_doctors">DOCTORS</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn navButton d-none d-md-block" href="?page=bookings">BOOKINGS</a>
                        </li>
                    <?php endif; ?>
                    </li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <?php if ($_SESSION['role']==='admin'): ?>
                            <li class="nav-item"><a class="btn navButton d-none d-md-block" href="?page=admin_dashboard">DASHBOARD</a></li>
                        <?php elseif ($_SESSION['role']==='doctor') : ?>
                            <li class="nav-item"><a class="btn navButton d-none d-md-block" href="?page=appointments">APPOINTMENTS</a></li>
                            <li class="nav-item"><a class="btn navButton d-none d-md-block" href="?page=timeslot">TIMESLOT</a></li>
                        <?php elseif ($_SESSION['role']==='staff') : ?>
                            <li class="nav-item"><a class="btn navButton d-none d-md-block" href="?page=staff_dashboard">DASHBOARD</a></li>    
                        <?php endif; ?>
                        <li class="nav-item"><a class="btn navButton d-none d-md-block" href="./services/logout.php">LOGOUT</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="btn navButton d-none d-md-block" href="?page=login">LOGIN</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="content" id="content" >
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            switch ($page) {
                case 'home':
                    include './views/shared/home.php';
                    break;
                case 'login':
                    include './views/shared/login.php';
                    break;
                case 'view_doctors':
                    include './views/shared/view_doctors.php';
                    break;
                case 'admin_dashboard':
                    include './views/admin/dashboard.php';
                    break;
                case 'appointments':
                    include './views/office/appointments.php';
                    break;
                case 'timeslot':
                    include './views/office/timeslot.php';
                    break;
                case 'staff_dashboard':
                    include './views/staff/dashboard.php';
                    break;
                case 'bookings':
                    include './views/patient/booking.php';
                    break;
                case 'manage_bookings':
                    include './views/admin/manage_bookings.php';
                    break;
                case 'manage_offices':
                    include './views/admin/manage_offices.php';
                    break;
                case 'manage_staff':
                    include './views/admin/manage_staff.php';
                    break;
                case 'view_doctors_admin':
                    include './views/admin/view_doctors.php';
                    break;
                case 'view_doctors':
                    include './views/shared/view_doctors.php';
                    break;
                default:
                    echo '<p>Page not found</p>';
            }
        } else {
            include './views/shared/home.php';
        }
        ?>
    </div>
</body>
<footer>
    <section id="footer">
    <p>&copy; 2024 Doctor Booking. All rights reserved.</p>
    </section>
</footer>
</html>
