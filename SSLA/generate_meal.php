<?php
// generate_meal.php

// Enable error reporting for debugging (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../config/db_con.php"); // This file must set up $dbconnection

// Retrieve POST parameters (or default to empty strings/arrays)
$meal_type_id    = isset($_POST['meal_type_id']) ? $_POST['meal_type_id'] : '';
$cooking_time_id = isset($_POST['cooking_time_id']) ? $_POST['cooking_time_id'] : '';

$ingredients_json = isset($_POST['ingredients']) ? $_POST['ingredients'] : '[]';
$equipments_json  = isset($_POST['equipments'])  ? $_POST['equipments']  : '[]';

// Decode JSON arrays
$selected_ingredients_array = json_decode($ingredients_json, true);
$selected_equipments_array  = json_decode($equipments_json, true);

if (!is_array($selected_ingredients_array)) {
    $selected_ingredients_array = [];
}
if (!is_array($selected_equipments_array)) {
    $selected_equipments_array = [];
}

// DEBUG: Log the input parameters
error_log("DEBUG: meal_type_id = $meal_type_id");
error_log("DEBUG: cooking_time_id = $cooking_time_id");
error_log("DEBUG: ingredients = " . print_r($selected_ingredients_array, true));
error_log("DEBUG: equipments = " . print_r($selected_equipments_array, true));

// Build filters only if values are provided

// 1. Ingredients filter
$ingredients_filter = "";
if (!empty($selected_ingredients_array)) {
    $selected_ingredients = implode(",", $selected_ingredients_array);
    $ingredients_filter = " AND id IN (
                              SELECT recipe_id 
                              FROM recipe_ingredients 
                              WHERE ingredient_id IN ($selected_ingredients)
                           )";
}

// 2. Equipments filter
$equipments_filter = "";
if (!empty($selected_equipments_array)) {
    $selected_equipments = implode(",", $selected_equipments_array);
    $equipments_filter = " AND id IN (
                              SELECT recipe_id 
                              FROM recipe_equipments 
                              WHERE equipment_id IN ($selected_equipments)
                           )";
}

// 3. Cooking time filter
$cooking_time_filter = "";
if (!empty($cooking_time_id)) {
    $cooking_time_filter = " AND id IN (
                                SELECT recipe_id 
                                FROM recipe_cooking_times 
                                WHERE cooking_time_id = '$cooking_time_id'
                             )";
}

// Build the final query
$query = "SELECT name, preparation_method 
          FROM mealrecipe 
          WHERE meal_type_id = '$meal_type_id' 
            $ingredients_filter 
            $cooking_time_filter 
            $equipments_filter 
            AND status = 'active'";

// DEBUG: Log the generated query
error_log("DEBUG: Generated Query: " . $query);

$result = mysqli_query($dbconnection, $query);
if (!$result) {
    echo json_encode(["error" => mysqli_error($dbconnection)]);
    exit;
}

$recipes = mysqli_fetch_all($result, MYSQLI_ASSOC);

// DEBUG: Log the number of recipes found
error_log("DEBUG: Number of recipes found: " . count($recipes));

// Set JSON header and output
header('Content-Type: application/json');
echo json_encode($recipes);
?>
