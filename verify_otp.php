<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredOtp = $_POST['otp'];
    
    if (!isset($_SESSION['otp'])) {
        echo json_encode(["status" => "error", "message" => "No OTP session found"]);
        exit();
    }

    if ($enteredOtp == $_SESSION['otp']) {
        echo json_encode(["status" => "success", "message" => "OTP verified!"]);
        unset($_SESSION['otp']); // Remove OTP from session after verification
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid OTP"]);
    }
}
?>
