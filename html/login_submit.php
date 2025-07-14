<?php
include 'application.php'; // Database connection
session_start();

$email = $_POST['email'];
$password = $_POST['password'];
$full_name = $_POST['full_name'];

// Hash the password securely
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert into database
$sql = "INSERT INTO users (email, password, full_name) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sss", $email, $hashed_password, $full_name);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo "Registration successful!";
} else {
    echo "Registration failed: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
