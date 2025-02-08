<?php
header('Content-Type: application/json');
include("../config/db_con.php");

// Define the base URL for the images
$image_base_url = "http://192.168.1.39/recipe/uploads/"; // Replace with your actual domain and image folder path

// Get temple_id from the request
$temple_id = isset($_GET['temple_id']) ? intval($_GET['temple_id']) : 0;

// Debug: Check if temple_id is received
if ($temple_id <= 0) {
    echo json_encode(["status" => "error", "message" => "Invalid temple ID"]);
    exit;
}

// Debug: Log the received temple_id
error_log("Received temple_id: " . $temple_id);

// Query to fetch temple-specific events
$sql = "SELECT event_id, temple_id, start_date, end_date, location, 
        description, CONCAT('$image_base_url', image) AS image 
        FROM temple_events 
        WHERE temple_id = ? AND status = 'active' 
        ORDER BY created_at DESC";

$stmt = mysqli_prepare($dbconnection, $sql);
mysqli_stmt_bind_param($stmt, 'i', $temple_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if there are events
if (mysqli_num_rows($result) > 0) {
    $events = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }
    echo json_encode(["status" => "success", "data" => $events]);
} else {
    echo json_encode(["status" => "error", "message" => "No events found for this temple"]);
}

// Debug: Check if the query was successful
if (!$result) {
    error_log("SQL error: " . mysqli_error($dbconnection));
}

mysqli_stmt_close($stmt);
mysqli_close($dbconnection);
?>
