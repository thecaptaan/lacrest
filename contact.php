<?php
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Validate form data
    $errors = [];
    if (empty($fullName)) {
        $errors[] = "Full name is required";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    if (empty($message)) {
        $errors[] = "Message is required";
    }

    // If there are no errors, send the email
    if (empty($errors)) {
        // Outlook SMTP settings
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp-mail.outlook.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = 'automate.lacrest@outlook.com'; // Replace with your Outlook email
        $mail->Password = 'MicATMaNsaTHA';
        $mail->setFrom($email, $fullName);
        $mail->addAddress($email);
        $mail->Subject = "New message from $fullName";
        $mail->Body = "Full Name: $fullName\nEmail: $email\nMessage:\n$message";

        // Try to send the email
        try {
            $mail->send();
            $response = array('success' => true, 'message' => 'Email sent successfully!');
            echo json_encode($response);
        } catch (Exception $e) {
            $response = array('success' => false, 'message' => 'Failed to send email. Please try again later.');
            echo json_encode($response);
        }
    } else {
        // Return errors in JSON format
        $response = array('success' => false, 'errors' => $errors);
        echo json_encode($response);
    }
}
?>