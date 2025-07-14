<?php
include 'application.php'; // Database connection
session_start();

// Step 1: Get form values
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$cateogary = $_POST['cateogary'];

// Step 2: Securely hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Step 3: Prepare SQL query
$sql = "INSERT INTO users (full_name, email, password, phone, cateogary) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

// Step 4: Bind parameters
mysqli_stmt_bind_param($stmt, "sssss", $full_name, $email, $hashed_password, $phone, $cateogary);

// Step 5: Execute and check result
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo "✅ Registration successful!";
} else {
    echo "❌ Registration failed: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
