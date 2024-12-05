<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Doctor Appointment Booking</title>

</head>
<body>
    <div class="container my-5" >
        <div class="row justify-content-center" >
            <div class="col-md-6">
                <div class="card shadow" style="border-radius:20px;">
                    <div class="card-header text-center" style="background-color: lightblue;  border-radius:20px 20px 0 0;">
                        <h4>Welcome to Doctor Appointment System</h4>
                        <p>Please login or proceed as a patient</p>
                    </div>
                    <div class="card-body">
                        <!-- Login Form -->
                        <form action="./controllers/LoginController.php" method="POST">
                            <!-- Username -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn w-100" style="background-color: lightblue;">Login</button>
                            </div>
                        </form>

                        <!-- Divider -->
                        <hr class="my-4">

                        <!-- Button for Patients -->
                        <div class="text-center">
                            <a href="index.php?page=bookings" class="btn btn-outline-secondary w-100">I'm a Patient</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
