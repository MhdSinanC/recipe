<?php
include("../config/db_con.php");

// Get the category_id from the query string and sanitize it
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

// Validate category_id
if ($category_id <= 0) {
    echo json_encode(["error" => "Invalid category ID"]);
    exit;
}

// SQL query to fetch recipes in the given category
$sql = "SELECT recipe_id, title, image, calories FROM recipes WHERE category_id = $category_id AND status = 'active'";
$result = $dbconnection->query($sql);

// Check if the query was successful
if (!$result) {
    echo json_encode(["error" => "Query failed: " . $dbconnection->error]);
    exit;
}

$cuisines = array();

while ($row = $result->fetch_assoc()) {
    $row['image'] = !empty($row['image']) ? 'http://192.168.1.39/recipe/uploads/' . $row['image'] : null;
    $cuisines[] = $row;
}

// Return the JSON response
echo json_encode($cuisines);

$dbconnection->close(); // Close the connection
?>
