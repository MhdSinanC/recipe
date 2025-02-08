<?php
header("Content-Type: application/json");

include('config/db_con.php');


$data = json_decode(file_get_contents("php://input"), true);

$name = $data['name'] ?? '';
$email = $data['email'] ?? '';
$phone = $data['phone'] ?? '';
$password = $data['password'] ?? '';

if (empty($name) || empty($email) || empty($password)) {
    echo json_encode(["success" => false, "message" => "All fields are required."]);
    exit();
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Insert data into the database
$sql = "INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)";
$stmt = $dbconnection->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $phone, $hashed_password);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "User registered successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Registration failed."]);
}

$stmt->close();
$dbconnection->close();
?>