<?php
header("Content-Type: application/json");

include('config/db_con.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);

    if (isset($input['email']) && isset($input['password'])) {
        $email = $dbconnection->real_escape_string($input['email']);
        $password = $dbconnection->real_escape_string($input['password']);

        // Query to fetch user details based on email
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = $dbconnection->query($query);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                echo json_encode([
                    "status" => "success",
                    "message" => "Login successful",
                    "user" => $user
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Invalid email or password"
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid email or password"
            ]);
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Missing email or password"
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method"
    ]);
}

$dbconnection->close();
?>
