<?php
include("../config/db_con.php");

header('Content-Type: application/json');

// Fetch Categories (Limit to 4 active categories)
$categoryQuery = "SELECT category_id, name, image FROM categories WHERE status='active' LIMIT 4";
$categoryResult = mysqli_query($conn, $categoryQuery);

$categories = [];
while ($row = mysqli_fetch_assoc($categoryResult)) {
    $categories[] = [
        'category_id' => $row['category_id'],
        'name' => $row['name'],
        'image' => $row['image']
    ];
}

// Fetch Recently Added Recipes (Limit to 4 active recipes)
$recipeQuery = "SELECT recipe_id, title, image, category_id, ingredients, steps, cooking_time FROM recipes WHERE status='active' ORDER BY created_at DESC LIMIT 4";
$recipeResult = mysqli_query($dbconnection, $recipeQuery);

$recipes = [];
while ($row = mysqli_fetch_assoc($recipeResult)) {
    $recipes[] = [
        'recipe_id' => $row['recipe_id'],
        'title' => $row['title'],
        'image' => $row['image'],
        'category_id' => $row['category_id'],
        'ingredients' => $row['ingredients'],
        'steps' => $row['steps'],
        'cooking_time' => $row['cooking_time']
    ];
}

// Return JSON Response
echo json_encode([
    'categories' => $categories,
    'recipes' => $recipes
]);

mysqli_close($dbconnection);
?>
