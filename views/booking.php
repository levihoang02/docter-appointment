<?php
require_once __DIR__ . '/../services/database.php';
require_once __DIR__ . '/../controllers/BookingController.php';
require_once __DIR__ . '/../controllers/DocterController.php';
require_once __DIR__ . '/../controllers/OfficeController.php';
require_once __DIR__ . '/../controllers/SlotController.php';

$db = Database::getInstance();
$slotController = new SlotController($db->getConnection());
$allSlots = [];
$results = $slotController->findAll();  // Fetch all predefined slots

while ($row = $results->fetch_assoc()) {
    $allSlots[] = ['id' => $row['id'], 'name' => $row['name']];
}

$offices = (new OfficeController($db->getConnection()))->findAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Available Slots</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Available Appointment Slots</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" id="start_date" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" id="end_date" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="doctor_office" class="form-label">Choose Office</label>
                                <select id="doctor_office" class="form-select">
                                    <option value="">Select Office</option>
                                    <?php foreach ($offices as $office) { ?>
                                        <option value="<?= $office['id'] ?>"><?= $office['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="doctor" class="form-label">Choose Doctor</label>
                                <select id="doctor" class="form-select" disabled>
                                    <option value="">Select Doctor</option>
                                </select>
                            </div>
                            <div class="col-md-4 mt-3">
                                <button id="filter_btn" class="btn btn-primary mt-4">Filter</button>
                            </div>
                        </div>

                        <div id="slots_table"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Booking Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bookingForm">
                    <input type="hidden" id="slot_id" name="slot_id">
                    <input type="hidden" id="slot_date" name="slot_date">
                    <input type="hidden" id="slot_doctor_id" name="slot_doctor_id">
                    
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email (Optional)</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>

                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ms-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Pass predefined slots to JavaScript from PHP
        const allSlots = <?php echo json_encode($allSlots); ?>;
        console.log(allSlots);

        document.getElementById('doctor_office').addEventListener('change', function() {
            const officeId = this.value;
            const doctorSelect = document.getElementById('doctor');
            
            if (officeId) {
                doctorSelect.disabled = false;

                fetch(`../services/search.php?model=docters&query=${officeId}`)
                    .then(response => response.json())
                    .then(data => {
                        doctorSelect.innerHTML = '<option value="">Select Doctor</option>';
                        data.forEach(doctor => {
                            const option = document.createElement('option');
                            option.value = doctor.id;
                            option.textContent = doctor.name;
                            doctorSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching doctors:', error);
                    });
            } else {
                doctorSelect.disabled = true;
                doctorSelect.innerHTML = '<option value="">Select Doctor</option>';
            }
        });

        document.getElementById('filter_btn').addEventListener('click', function() {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            const doctorId = document.getElementById('doctor').value;

            let url = `../services/view_slots.php?start_date=${startDate}&end_date=${endDate}&doctor_id=${doctorId}`;

            fetch(url)
                .then(response => response.json())
                .then(bookedSlots => {
                    
                    let avaiSlots = [];
                    let current = new Date(startDate);
                    let end = new Date(endDate);

                    while (current <= end) {
                        for (let i = 0; i < allSlots.length; i++) {
                            let slot = {
                                date: current.toISOString().split('T')[0], 
                                id: allSlots[i].id,
                                name: allSlots[i].name,
                                booked: false
                            };
                            
                            avaiSlots.push(slot);
                        }
                       
                        current.setDate(current.getDate() + 1);
                    }

                    bookedSlots.forEach(bookedSlot => {
                        avaiSlots.forEach(slot => {
                            if (slot.id === bookedSlot.id && slot.date === bookedSlot.date) {
                                slot.booked = true; // Mark as booked
                            }
                        });
                    });

                    console.log("avai ",avaiSlots);

                    let slotsHTML = '<table class="table table-bordered"><thead><tr><th>Date</th><th>Time</th><th>Action</th></tr></thead><tbody>';

                    // Filter out the booked slots
                    avaiSlots.forEach(slot => {
                        if (!slot.booked) {
                            // Only show available slots
                            slotsHTML += `
                                <tr>
                                    <td>${slot.date}</td>
                                    <td>${slot.name}</td>
                                    <td><button class="btn btn-success" onclick="openBookingModal(${slot.id}, '${slot.date}', '${doctorId}')">Book</button></td>
                                </tr>
                            `;
                        }
                    });

                    slotsHTML += '</tbody></table>';
                    document.getElementById('slots_table').innerHTML = slotsHTML;
                })
                .catch(error => {
                    console.error('Error fetching slots:', error);
                    document.getElementById('slots_table').innerHTML = '<p class="text-danger">Error fetching data. Please try again.</p>';
                });
        });
        function openBookingModal(slotId, slotDate, docterId) {
            document.getElementById('slot_id').value = slotId;
            document.getElementById('slot_date').value = slotDate;
            document.getElementById('slot_doctor_id').value = docterId;

            new bootstrap.Modal(document.getElementById('bookingModal')).show();
        }

        document.getElementById('bookingForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch('../services/submit_booking.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log(response.body);
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Booking successful!');
                    let modal = bootstrap.Modal.getInstance(document.getElementById('bookingModal'));
                    modal.hide();
                } else {
                    alert('Booking failed. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error submitting booking:', error);
                alert('An error occurred. Please try again later.');
            });
        });
    </script>
</body>
</html>
