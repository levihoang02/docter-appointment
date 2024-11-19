<?php

class Appointment
{
    public static function createAppointment($conn, $patient_id, $doctor_id, $time_slot_id)
    {
        $query = "INSERT INTO appointments (patient_id, doctor_id, time_slot_id, status) VALUES (?, ?, ?, 'Pending')";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'iii', $patient_id, $doctor_id, $time_slot_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return mysqli_insert_id($conn);
    }

    public static function getAllAppointments($conn)
    {
        $query = "SELECT * FROM appointments";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $appointments[] = $row;
        }
        mysqli_free_result($result);
        return $appointments;
    }

    public static function getAppointmentById($conn, $id)
    {
        $query = "SELECT * FROM appointments WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $appointment = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_stmt_close($stmt);
        return $appointment;
    }

    public static function getAppointmentsByPatientId($conn, $patient_id)
    {
        $query = "SELECT * FROM appointments WHERE patient_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $patient_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $appointments = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $appointments[] = $row;
        }
        mysqli_free_result($result);
        mysqli_stmt_close($stmt);
        return $appointments;
    }

    public static function getAppointmentsByDoctorId($conn, $doctor_id)
    {
        $query = "SELECT * FROM appointments WHERE doctor_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $doctor_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $appointments = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $appointments[] = $row;
        }
        mysqli_free_result($result);
        mysqli_stmt_close($stmt);
        return $appointments;
    }

    public static function updateAppointmentStatus($conn, $id, $status)
    {
        $query = "UPDATE appointments SET status = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'si', $status, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public static function deleteAppointment($conn, $id)
    {
        $query = "DELETE FROM appointments WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public static function getAppointmentsByOfficeId($conn, $office_id)
    {
        $query = "SELECT * FROM appointments WHERE office_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $office_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $appointments = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $appointments[] = $row;
        }
        mysqli_free_result($result);
        mysqli_stmt_close($stmt);
        return $appointments;
    }
    public static function getAppointmentStatus($conn, $id)
    {
        $query = "SELECT status FROM appointments WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $status = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_stmt_close($stmt);
        return $status['status'];
    }
}
?>