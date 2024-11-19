<?php

class Patient
{
    public static function createPatient($conn, $full_name, $phone_number, $email)
    {
        $query = "INSERT INTO patients (full_name, phone_number, email) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sss', $full_name, $phone_number, $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return mysqli_insert_id($conn);
    }

    public static function getPatientById($conn, $id)
    {
        $query = "SELECT * FROM patients WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        return mysqli_fetch_assoc($result);
    }

    public static function getPatientByPhoneNumber($conn, $phone_number)
    {
        $query = "SELECT * FROM patients WHERE phone_number = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 's', $phone_number);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        return mysqli_fetch_assoc($result);
    }
}
?>
