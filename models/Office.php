<?php

class Office
{
    public static function getAllOffices($conn)
    {
        $query = "SELECT * FROM offices";
        $result = mysqli_query($conn, $query);
        $offices = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $offices[] = $row;
        }
        mysqli_free_result($result);
        return $offices;
    }

    public static function getOfficeById($conn, $id)
    {
        $query = "SELECT * FROM offices WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $office = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $office;
    }

    public static function createOffice($conn, $name, $location)
    {
        $query = "INSERT INTO offices (name, location) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $name, $location);
        mysqli_stmt_execute($stmt);
        $id = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt);
        return $id;
    }
}
?>