<?php
// Include your DB connection
include("../config/db_con.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $userEmail = $data['userEmail'] ?? '';
    $artId = $data['artId'] ?? '';

    if (!empty($userEmail) && !empty($artId)) {
        // Check if the art item is in the user's favorites
        $sql = "
            SELECT * FROM favorites 
            WHERE user_email = ? AND art_id = ?";
        $stmt = $dbconnection->prepare($sql);
        $stmt->bind_param("si", $userEmail, $artId);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Remove the art item from favorites
                $sql = "DELETE FROM favorites WHERE user_email = ? AND art_id = ?";
                $stmt = $dbconnection->prepare($sql);
                $stmt->bind_param("si", $userEmail, $artId);

                if ($stmt->execute()) {
                    echo json_encode(["success" => true, "message" => "Art item removed from your favorites."]);
                } else {
                    echo json_encode(["success" => false, "message" => "Error removing from favorites."]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "Art item is not in your favorites."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Error executing query."]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Invalid input."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
