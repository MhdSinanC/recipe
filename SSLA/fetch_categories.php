<?php

include("../config/db_con.php");

// SQL query to fetch categories
$sql = "SELECT category_id, name, image FROM categories WHERE status = 'active'";

$result = $dbconnection->query($sql);

// Check if the query was successful
if (!$result) {
    // Output the error and exit
    echo json_encode(["error" => "Query failed: " . $dbconnection->error]);
    exit;
}

$categories = array();

while ($row = $result->fetch_assoc()) {
    // Assuming 'image' is stored as a file path, construct a full URL or path to access it
    $row['image'] = !empty($row['image']) ? 'http://192.168.1.39/recipe/uploads/' . $row['image'] : null;
    $categories[] = $row;
}

// Send the response as JSON
echo json_encode($categories);

$dbconnection->close(); // Close the connection

?>
