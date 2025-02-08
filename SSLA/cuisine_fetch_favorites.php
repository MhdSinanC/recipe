<?php
// Include your DB connection
include("../config/db_con.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $userEmail = $data['userEmail'] ?? '';

    if (!empty($userEmail)) {
        $sql = "
            SELECT f.cuisine_id, c.name, c.image 
            FROM favorites f
            INNER JOIN cuisine c ON f.cuisine_id = c.cuisine_id
            INNER JOIN users u ON f.user_id = u.id
            WHERE u.email = ?";
        
        $stmt = $dbconnection->prepare($sql);

        if (!$stmt) {
            echo json_encode(["success" => false, "message" => "Error preparing statement: " . $dbconnection->error]);
            exit;
        }

        $stmt->bind_param("s", $userEmail);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $favorites = [];

            while ($row = $result->fetch_assoc()) {
                $favorites[] = $row;
            }

            echo json_encode(["success" => true, "favorites" => $favorites]);
        } else {
            echo json_encode(["success" => false, "message" => "Error executing query: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Invalid user email."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
