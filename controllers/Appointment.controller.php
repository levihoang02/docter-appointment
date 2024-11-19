<?php

require_once '../models/Appointment.php';
require_once '../models/Patient.php';
require_once '../services/database.php';
require_once '../services/email.php';

class AppointmentController
{
    public function create($conn, $full_name, $phone_number, $email, $office_id, $doctor_id, $time_slot_id)
    {
        if (!$full_name || !$phone_number || !$email || !$office_id || !$doctor_id || !$time_slot_id) {
            jsonResponse(['error' => 'Missing required fields'], 400);
        }

        // Insert patient first (simplified for this example)
        $patient = Patient::getPatientByPhoneNumber($conn, $phone_number);
        $patient_id = null;
        if (!$patient) {
            $patient_id = Patient::createPatient($conn, $full_name, $phone_number, $email);
        } else {
            $patient_id = $patient['id'];
        }
        $office = Office::getOfficeById($conn, $office_id);
        $to = $office['email'];
        $subject = 'Appointment Confirmation';
        $body = 'You have a new appointment on ' . $time_slot_id;
        sendEmail($to, $subject, $body);
        $appointment_id = Appointment::createAppointment($conn, $patient_id, $doctor_id, $time_slot_id);

        jsonResponse(['message' => 'Appointment created successfully', 'appointment_id' => $appointment_id], 201);
    }

    public function getAppointmentsByOfficeId($conn, $office_id)
    {
        $appointments = Appointment::getAppointmentsByOfficeId($conn, $office_id);
        jsonResponse($appointments, 200);
    }

    public function viewAppointmentByDoctorId($conn, $doctor_id)
    {
        
        $appointments = Appointment::viewAppointmentByDoctorId($conn, $doctor_id);
        jsonResponse($appointments, 200);
    }

    public function updateAppointmentStatus($conn, $id, $status)
    {
        $appointment = Appointment::getAppointmentById($conn, $id);
        $patient = Patient::getPatientById($conn, $appointment['patient_id']);
        if(filter_var($patient['email'], FILTER_VALIDATE_EMAIL)) {
            $to = $patient['email'];
            $subject = 'Appointment Status Update';
            $body = 'Your appointment status has been updated to ' . $status;
            sendEmail($to, $subject, $body);
        }
        Appointment::updateAppointmentStatus($conn, $id, $status);
        jsonResponse(['message' => 'Appointment status updated successfully'], 200);
    }

    public function deleteAppointment($conn, $id)
    {
        Appointment::deleteAppointment($conn, $id);
        jsonResponse(['message' => 'Appointment deleted successfully'], 200);
    }
}
?>
