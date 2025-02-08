<?php
// Include the database connection file
include("../config/db_con.php");

// Define the query to fetch favorites
$query = "
    SELECT 
        favorites.id, 
        favorites.user_id, 
        favorites.art_id, 
        favorites.cuisine_id, 
        favorites.cultural_id, 
        favorites.created_at 
    FROM favorites
";

// Execute the query
$result = mysqli_query($dbconnection, $query);

// Check if the query execution was successful
if (!$result) {
    die("Error fetching data: " . mysqli_error($dbconnection));
}

// Fetch data and store in an array
$favorites = [];
while ($row = mysqli_fetch_assoc($result)) {
    $favorites[] = $row;
}

// Close the database connection
mysqli_close($dbconnection);

// Display the data in JSON format
header('Content-Type: application/json');
echo json_encode($favorites);
?>
