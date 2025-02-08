<?php
// Include database connection
include("../config/db_con.php");

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if id is provided in the POST request
    if (isset($_POST['id'])) {
        $userId = intval($_POST['id']); // Fetch the `id` from POST request

        // Prepare the query to fetch user details
        $query = "SELECT id, name, email, phone FROM users WHERE id = ?";
        $stmt = $dbconnection->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                echo json_encode(['status' => 'success', 'data' => $user]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'User not found']);
            }

            $stmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Missing id parameter']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

// Close the database connection
mysqli_close($dbconnection);
?>
