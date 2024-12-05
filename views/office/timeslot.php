<?php
require_once  './services/database.php';
require_once  './controllers/SlotController.php';

$db = Database::getInstance();

$slotModel = new SlotController($db->getConnection());
$slot = $slotModel->findAll();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Slot Management</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script> 
        function showUpdateForm(id) { 
            var form = document.getElementById('form-' + id); 
            form.style.display = 'flex'; 
            var button = document.getElementById('updateButton-' + id); 
            button.style.display = 'none'; 
        } 
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2>Time Slot Management</h2>
        <!-- Display current time slots -->
        <table class="table table-striped mt-3">
            <thead style="background-color:lightblue;">
                <tr>
                    <th>ID</th>
                    <th>Time Slot</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $slot->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <!-- <td>
                        <form action="./services/timeslot_management.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="text" name="timeslot" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </form>
                    </td> -->
                    <td> 
                            <div style="width:80%;">
                                <button class="btn btn-sm btn-primary" id="updateButton-<?php echo $row['id']; ?>" onclick="showUpdateForm(<?php echo $row['id']; ?>)">Update</button> 
                            </div>
                            <form action="./services/timeslot_management.php" method="post" class="update-form flex-row" id="form-<?php echo $row['id']; ?>" style="display:none;"> 
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> 
                                <input type="text" style="max-width:50%;"  name="timeslot" class="form-control" value="<?php echo htmlspecialchars($row['name']); ?>" required> 
                                <button type="submit" class="btn btn-primary btn-sm btn-update">Update</button> 
                            </form> 
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        
        <!-- Create new time slot -->
        <form action="./services/timeslot_management.php" method="post" class="mt-4">
            <div class="form-group">
                <label for="new_timeslot">New Time Slot</label>
                <input type="text" class="form-control" id="new_timeslot" name="new_timeslot" required></input>
            </div>
            <button type="submit" class="btn btn-success mt-2">Create</button>
        </form>
    </div>
    
</body>
</html>
