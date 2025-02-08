<?php
include("../config/db_con.php");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $userEmail = $data['userEmail'] ?? '';

    if (!empty($userEmail)) {
        $sql = "
            SELECT r.recipe_id, r.title, r.image, r.calories
            FROM favorites f
            INNER JOIN recipes r ON f.recipe_id = r.recipe_id
            INNER JOIN users u ON f.user_id = u.user_id
            WHERE u.email = ? AND r.status = 'active'";

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
                $row['image'] = !empty($row['image']) 
                    ? 'http://192.168.1.39/recipe/uploads/' . $row['image'] 
                    : null;
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
?>
