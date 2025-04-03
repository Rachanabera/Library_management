<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Check if email belongs to DYPATIL
    if (!preg_match("/@dypatil\.edu$/", $email)) {
        echo "Only DYPATIL emails are allowed!";
        exit;
    }

    // Generate OTP
    $otp = rand(100000, 999999);

    // Save OTP to session (or database)
    session_start();
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;

    // PHPMailer Setup
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP Server (e.g., Gmail, Outlook, etc.)
        $mail->SMTPAuth = true;
        $mail->Username = 'rachanabera6@gmail.com'; // Your email
        $mail->Password = 'cfhz izry gwhf ngsx'; // App password (Not your email password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender & Recipient
        $mail->setFrom('your-email@gmail.com', 'Library Management');
        $mail->addAddress($email);

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body = "Your OTP for verification is <strong>$otp</strong>. Do not share it with anyone.";

        if ($mail->send()) {
            echo "OTP sent successfully!";
        } else {
            echo "OTP sending failed!";
        }
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
