<?php

require_once '../models/Admin.php';
require_once '../services/database.php';

class AuthController
{
    public function login($conn, $username, $password)
    {
        $admin = Admin::getAdminByUsername($conn, $username);
        if (!$admin) {
            jsonResponse(['error' => 'Invalid username'], 401);
        }
        if (password_verify($password, $admin['password'])) {
            jsonResponse(['message' => 'Login successful', 'admin' => $admin], 200);
        } else {
            jsonResponse(['error' => 'Invalid password'], 401);
        }
    }

    public function logout($conn)
    {
        session_destroy();
        closeDatabaseConnection($conn);
        jsonResponse(['message' => 'Logout successful'], 200);
    }

    public function register($conn, $username, $password, $admin_role, $office_id)
    {
        Admin::createAdmin($conn, $username, $password, $admin_role, $office_id);
        jsonResponse(['message' => 'Admin created successfully'], 201);
    }
}
