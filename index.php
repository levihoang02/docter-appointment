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
        }
        footer {
            margin-top: 50px;
            padding: 15px;
            bottom: 0;
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
            <a href="#intro" class="navbar-brand">
                <span class="fw-bold" style="font-size: 24px; color:black;">
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
                    <li class="nav-item">
                        <a class="btn navButton d-none d-md-block" href="?page=booking">BOOKING</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn navButton d-none d-md-block" href="?page=appointments">APPOINTMENTS</a>
                    </li>
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
                    include './views/home.php';
                    break;
                case 'booking':
                    include './views/booking.php';
                    break;
                case 'appointments':
                    include './views/appointments.php';
                    break;
                default:
                    echo '<p>Page not found</p>';
            }
        } else {
            include './views/home.php';
        }
        ?>
    </div>
</body>
<footer>
    <section id="footer">
        <p>Powered by </p>
    </section>
</footer>
</html>
