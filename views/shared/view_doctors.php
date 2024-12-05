<?php
require_once  './services/database.php';
require_once  './controllers/DocterController.php';

$db = Database::getInstance();

$controller = new DocterController($db->getConnection());
$results = $controller->findAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Doctors</title>
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
        .container { flex: 1; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Doctors</h2>
        <table class="table table-striped mt-3">
            <thead style="background-color:lightblue;">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone No.</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $results->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone_no']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
</body>
</html>
