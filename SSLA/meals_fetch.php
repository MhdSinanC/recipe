<?php
header('Content-Type: application/json');
include("../config/db_con.php");

$input = json_decode(file_get_contents('php://input'), true);

$type = $input['type'];
$ingredients = $input['ingredients'];
$equipment = $input['equipment'];
$cooking_time = $input['cooking_time'];

// Convert cooking time to minutes
$cooking_time_minutes = intval(explode(' ', $cooking_time)[0]);

// Query to fetch meals based on type, ingredients, equipment, and cooking time
$sql = "SELECT * FROM meals_planner WHERE type = ? AND equipment = ? AND cooking_time <= ?";
$stmt = $dbconnection->prepare($sql);
$stmt->bind_param("ssi", $type, $equipment, $cooking_time_minutes);
$stmt->execute();
$result = $stmt->get_result();

$meals = [];
while ($row = $result->fetch_assoc()) {
    // Check if the meal contains all selected ingredients
    $meal_ingredients = explode(',', $row['ingredients']);
    if (empty(array_diff($ingredients, $meal_ingredients))) {
        $meals[] = $row;
    }
}

echo json_encode($meals);
$stmt->close();
$dbconnection->close();
?>
