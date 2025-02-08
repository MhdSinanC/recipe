<?php

include("../config/db_con.php");
;

header('Content-Type: application/json');

// Get current time (hour)
$currentHour = date('H');

// SQL query to fetch categories
$sql = "SELECT category_id, name, image FROM categories WHERE status = 'active' ORDER BY RAND() LIMIT 4";

$result = $dbconnection->query($sql);

if (!$result) {
    echo json_encode(["error" => "Query failed: " . $dbconnection->error]);
    exit;
}

$categories = [];

while ($row = $result->fetch_assoc()) {
    // Construct image URL
    $row['image'] = !empty($row['image']) 
        ? 'http://192.168.1.39/recipe/uploads/' . $row['image'] 
        : null;
    $categories[] = $row;
}

echo json_encode($categories);
$dbconnection->close();

?>
