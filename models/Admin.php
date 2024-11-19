<?php

class Admin
{
    public static function getAdminByUsername($conn, $username)
    {
        $query = "SELECT * FROM admins WHERE username = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $admin = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_stmt_close($stmt);
        return $admin;
    }

    public static function createAdmin($conn, $username, $password, $admin_role, $office_id)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO admins (username, hashed_password, admin_role, office_id) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ssii', $username, $hashedPassword, $admin_role, $office_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public static function deleteAdmin($conn, $id)
    {
        $query = "DELETE FROM admins WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}
?>