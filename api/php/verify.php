<?php
include("../../db/db_con.php");
header("Content-Type: application/json");

// Check if the request is from the HTML form or direct API request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['HTTP_REFERER'] === 'http://localhost/ai2gi/cp/') {
    // HTML form request
    $data = $_POST; // Use $_POST for form data

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Direct API request
    $data = json_decode(file_get_contents("php://input"), true);

} else {
    // Invalid request method
    echo json_encode(['error' => 'Invalid request method']);
    exit;
}

// Validate and sanitize data
$username = isset($data['username']) ? htmlspecialchars($data['username']) : null;
$password = isset($data['password']) ? htmlspecialchars($data['password']) : null;


// Call the stored procedure
//Reg Check
$register_check="SELECT * FROM  `login` WHERE username='$email'";
$result_register_check = mysqli_query($dbconnection,$register_check);  
$row_register_check = $result_register_check->num_rows;

$user = $result_register_check->fetch_assoc();

if ($user) {
    echo json_encode(['message' => 'Login successful']);
} else {
    echo json_encode(['error' => 'Invalid username or password']);
}
