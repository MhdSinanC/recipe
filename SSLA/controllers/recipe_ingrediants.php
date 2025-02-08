<?php
include("../../config/db_con.php");

// Handle adding a new recipe ingredient entry
if (isset($_POST["btnAddRecipeIngredient"])) {
    $recipe_id = mysqli_real_escape_string($dbconnection, $_POST['recipe_id']);
    $ingredient_ids = $_POST['ingredient_id']; // Array of ingredient IDs
    $status = mysqli_real_escape_string($dbconnection, $_POST['status']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');
    
    foreach ($ingredient_ids as $ingredient_id) {
        $ingredient_id = mysqli_real_escape_string($dbconnection, $ingredient_id);
        $insert_query = "INSERT INTO recipe_ingredients (recipe_id, ingredient_id, status, created_at, updated_at) 
                         VALUES ('$recipe_id', '$ingredient_id', '$status', '$created_at', '$updated_at')";
        mysqli_query($dbconnection, $insert_query);
    }
    echo "<script>location='../recipe_ingrediants_view.php?msg=Recipe Ingredients Added Successfully&msg_type=Success'</script>";
    exit();
}

// Handle updating a recipe ingredient entry
if (isset($_POST["btnUpdateRecipeIngredient"])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $updated_at = date('Y-m-d H:i:s');

    $update_query = "UPDATE recipe_ingredients SET status = '$status', updated_at = '$updated_at' WHERE id = $id";
    mysqli_query($dbconnection, $update_query);

    echo "<script>location='../recipe_ingrediants_view.php?msg=Recipe Ingredient Updated Successfully&msg_type=Success'</script>";
    exit();
}

// Handle deleting a recipe ingredient entry
if (isset($_POST["btnDeleteRecipeIngredient"])) {
    $id = $_POST['id_ref'];
    $delete_query = "DELETE FROM recipe_ingredients WHERE id = $id";
    mysqli_query($dbconnection, $delete_query);

    echo "<script>location='../recipe_ingredients_view.php?msg=Recipe Ingredient Deleted Successfully&msg_type=Success'</script>";
    exit();
}
?>
