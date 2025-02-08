<?php

include("../config/db_con.php");

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$recipe_id = isset($_GET['recipe_id']) ? intval($_GET['recipe_id']) : 0;

if ($recipe_id <= 0) {
    echo json_encode([
        "error" => true,
        "message" => "Invalid recipe ID."
    ]);
    exit;
}

$sql = "SELECT title, image, description, ingredients, steps, calories, cooking_time 
        FROM recipes 
        WHERE recipe_id = $recipe_id AND status = 'active'";
$result = $dbconnection->query($sql);

if ($result && $result->num_rows > 0) {
    $cuisine_detail = $result->fetch_assoc();
    $cuisine_detail['image'] = !empty($cuisine_detail['image']) ? 'http://192.168.1.39/recipe/uploads/' . $cuisine_detail['image'] : null;

    echo json_encode($cuisine_detail);
} else {
    echo json_encode([
        "error" => true,
        "message" => "Cuisine not found or inactive."
    ]);
}

$dbconnection->close();

?>
