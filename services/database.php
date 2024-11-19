<?php

function getDatabaseConnection()
{
    $hostname = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "your_database_name";

    // Create a connection
    $conn = mysqli_connect($hostname, $username, $password);

    if (!$conn) {
        echo "Connection failed: " . mysqli_connect_error();
    }

    // Select the database
    if (!mysqli_select_db($conn, $dbname)) {
        echo "Database selection failed: " . mysqli_error($conn);
    }

    return $conn;
}

function closeDatabaseConnection($conn)
{
    mysqli_close($conn);
}
?>
