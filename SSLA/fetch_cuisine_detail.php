<?php

include("../config/db_con.php");

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$recipe_id = isset($_GET['recipe_id']) ? intval($_GET['recipe_id']) : 0;
$people = isset($_GET['people']) ? intval($_GET['people']) : 1;

if ($recipe_id <= 0) {
    echo json_encode([
        "error" => true,
        "message" => "Invalid recipe ID."
    ]);
    exit;
}

$sql = "SELECT title, image, description, ingredients, steps, calories, cooking_time, default_serving 
        FROM recipes 
        WHERE recipe_id = $recipe_id AND status = 'active'";
$result = $dbconnection->query($sql);

if ($result && $result->num_rows > 0) {
    $cuisine_detail = $result->fetch_assoc();
    $cuisine_detail['image'] = !empty($cuisine_detail['image']) ? 'http://192.168.1.39/recipe/uploads/' . $cuisine_detail['image'] : null;

    // Adjust ingredients based on number of people
    $defaultServing = max(1, intval($cuisine_detail['default_serving']));
    $multiplier = $people / $defaultServing;

    $ingredients = explode("\n", $cuisine_detail['ingredients']);
    foreach ($ingredients as &$ingredient) {
        if (preg_match('/(\d+(\.\d+)?)\s*(\w.*)/', $ingredient, $matches)) {
            $quantity = floatval($matches[1]) * $multiplier;
            $ingredient = round($quantity, 2) . ' ' . $matches[3];
        }
    }
    $cuisine_detail['ingredients'] = implode("\n", $ingredients);

    echo json_encode($cuisine_detail);
} else {
    echo json_encode([
        "error" => true,
        "message" => "Cuisine not found or inactive."
    ]);
}

$dbconnection->close();

?>
