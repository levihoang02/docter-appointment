<?php

class Doctor
{
    public static function getAllDoctors($conn)
    {
        $query = "SELECT id, name, specialty FROM doctors";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            return ['error' => 'Failed to fetch doctors: ' . mysqli_error($conn)];
        }

        $doctors = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $doctors[] = $row;
        }

        return $doctors;
    }
}
?>