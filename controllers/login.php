<?php
session_start();
include '../config/db_con.php'; // Include the db connection

$msg = "";
$msg_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_employees_login'])) {
    // Use mysqli_real_escape_string with the $dbconnection from db_con.php
    $username = mysqli_real_escape_string($dbconnection, $_POST['username']);
    $password = mysqli_real_escape_string($dbconnection, $_POST['userpassword']);

    // Hardcoded credentials
    $hardcoded_username = "admin@gmail.com";
    $hardcoded_password = "recipe";

    // Check if the provided username and password match the hardcoded credentials
    if ($username === $hardcoded_username && $password === $hardcoded_password) {
        // Regenerate session ID to prevent session fixation attacks
        session_regenerate_id(true);

        // Set session variables
        $_SESSION['user_email'] = $hardcoded_username;
        $_SESSION['user_name'] = "Admin"; // You can change this if you'd like
        $_SESSION['user_role'] = 'admin'; // Hardcoded role (admin)

        // Redirect to admin dashboard
        header("Location: ../SSLA/dashboard.php");
        exit();
    } else {
        $msg = "Invalid username or password!";
        $msg_type = "Error";
    }
}

// Redirect back to login page with error message
if (!empty($msg)) {
    header("Location: ../index.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type));
    exit();
}
?>
