<?php
header('Content-Type: application/json');

// Include the database connection
include("../config/db_con.php");

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $userId = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;
    $artId = isset($_POST['art_id']) ? intval($_POST['art_id']) : null;

    // Validate input
    if (!$userId || !$artId) {
        $response['message'] = 'Invalid parameters. Both user_id and art_id are required.';
        echo json_encode($response);
        exit;
    }

    try {
        // Check if user exists
        $userCheckQuery = "SELECT id FROM users WHERE id = ?";
        $stmt = $dbconnection->prepare($userCheckQuery);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            $response['message'] = 'User not found. Please ensure the user exists.';
            echo json_encode($response);
            exit;
        }

        // Check if the art item is already in favorites
        $checkFavoriteQuery = "SELECT id FROM favorites WHERE user_id = ? AND art_id = ?";
        $stmt = $dbconnection->prepare($checkFavoriteQuery);
        $stmt->bind_param('ii', $userId, $artId);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $response['message'] = 'This item is already in your favorites.';
            echo json_encode($response);
            exit;
        }

        // Add the art item to the favorites table
        $insertFavoriteQuery = "INSERT INTO favorites (user_id, art_id, created_at) VALUES (?, ?, NOW())";
        $stmt = $dbconnection->prepare($insertFavoriteQuery);
        $stmt->bind_param('ii', $userId, $artId);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Art item added to your favorites successfully.';
        } else {
            $response['message'] = 'Failed to add the art item to your favorites.';
        }
    } catch (Exception $e) {
        $response['message'] = 'Error: ' . $e->getMessage();
    }
} else {
    $response['message'] = 'Invalid request method. Please use POST.';
}

echo json_encode($response);
?>
