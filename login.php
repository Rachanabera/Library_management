<?php
session_start();
include "db_connect.php"; // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    // Fetch user from database
    $query = "SELECT * FROM library_users WHERE username = ? AND role = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Check password (for now, using plain text, but use password_verify() in real projects)
        if ($password === $user["password"]) {
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $role;

            // Redirect based on role
            if ($role === "student") {
                header("Location: student.html");
                exit();
            } elseif ($role === "admin") {
                header("Location: admin.html");
                exit();
            }
        } else {
            echo "<script>alert('Invalid Password'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid Username or Role'); window.location.href='login.html';</script>";
    }
}
?>
