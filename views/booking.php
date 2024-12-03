<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment Booking</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Book a Doctor Appointment</h4>
                    </div>
                    <div class="card-body">
                        <form action="process_appointment.php" method="POST">
                            <!-- Full Name -->
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your full name" required>
                            </div>
                            
                            <!-- Phone -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                            </div>
                            
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                            
                            <!-- Doctor Office -->
                            <div class="mb-3">
                                <label for="doctor_office" class="form-label">Choose Doctor Office</label>
                                <select class="form-select" id="doctor_office" name="doctor_office" required>
                                    <option value="">Select Office</option>
                                    <option value="Cardiology">Cardiology</option>
                                    <option value="Dermatology">Dermatology</option>
                                    <option value="Pediatrics">Pediatrics</option>
                                    <option value="Orthopedics">Orthopedics</option>
                                </select>
                            </div>
                            
                            <!-- Doctor -->
                            <div class="mb-3">
                                <label for="doctor" class="form-label">Choose Doctor</label>
                                <select class="form-select" id="doctor" name="doctor" required>
                                    <option value="">Select Doctor</option>
                                    <option value="Dr. Smith">Dr. Smith</option>
                                    <option value="Dr. Taylor">Dr. Taylor</option>
                                    <option value="Dr. Johnson">Dr. Johnson</option>
                                    <option value="Dr. Brown">Dr. Brown</option>
                                </select>
                            </div>
                            
                            <!-- Time Slot -->
                            <div class="mb-3">
                                <label for="time_slot" class="form-label">Choose Time Slot</label>
                                <select class="form-select" id="time_slot" name="time_slot" required>
                                    <option value="">Select Slot</option>
                                    <option value="9:00 AM - 10:00 AM">9:00 AM - 10:00 AM</option>
                                    <option value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
                                    <option value="11:00 AM - 12:00 PM">11:00 AM - 12:00 PM</option>
                                    <option value="1:00 PM - 2:00 PM">1:00 PM - 2:00 PM</option>
                                </select>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Book Appointment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>