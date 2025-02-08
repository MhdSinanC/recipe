<?php
include("../config/db_con.php");

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch cooking tips with active status and latest created_at first
$sql = "SELECT id, tip, image, created_at 
        FROM cooking_tips 
        WHERE status = 'active' 
        ORDER BY created_at DESC";

$result = $dbconnection->query($sql);

if ($result && $result->num_rows > 0) {
    $cooking_tips = [];
    while ($row = $result->fetch_assoc()) {
        $row['image'] = !empty($row['image']) ? 'http://192.168.1.39/recipe/uploads/' . $row['image'] : null;
        $cooking_tips[] = $row;
    }
    
    echo json_encode([
        "error" => false,
        "cooking_tips" => $cooking_tips
    ]);
} else {
    echo json_encode([
        "error" => true,
        "message" => "No active cooking tips found."
    ]);
}

$dbconnection->close();
?>
