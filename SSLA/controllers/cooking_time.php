<?php
include("../../config/db_con.php");

// Handle adding a new recipe cooking time entry
if (isset($_POST["btnAddRecipeCookingTime"])) {
    $recipe_id = mysqli_real_escape_string($dbconnection, $_POST['recipe_id']);
    $cooking_time_ids = $_POST['cooking_time_id']; // Array of cooking time IDs
    $status = mysqli_real_escape_string($dbconnection, $_POST['status']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');
    
    foreach ($cooking_time_ids as $cooking_time_id) {
        $cooking_time_id = mysqli_real_escape_string($dbconnection, $cooking_time_id);
        $insert_query = "INSERT INTO recipe_cooking_times (recipe_id, cooking_time_id, status, created_at, updated_at) 
                         VALUES ('$recipe_id', '$cooking_time_id', '$status', '$created_at', '$updated_at')";
        mysqli_query($dbconnection, $insert_query);
    }
    echo "<script>location='../recipe_cooking_time_view.php?msg=Recipe Cooking Times Added Successfully&msg_type=Success'</script>";
    exit();
}

// Handle updating a recipe cooking time entry
if (isset($_POST["btnUpdateRecipeCookingTime"])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $updated_at = date('Y-m-d H:i:s');

    $update_query = "UPDATE recipe_cooking_times SET status = '$status', updated_at = '$updated_at' WHERE id = $id";
    mysqli_query($dbconnection, $update_query);

    echo "<script>location='../recipe_cooking_times_view.php?msg=Recipe Cooking Time Updated Successfully&msg_type=Success'</script>";
    exit();
}

// Handle deleting a recipe cooking time entry
if (isset($_POST["btnDeleteRecipeCookingTime"])) {
    $id = $_POST['id_ref'];
    $delete_query = "DELETE FROM recipe_cooking_times WHERE id = $id";
    mysqli_query($dbconnection, $delete_query);

    echo "<script>location='../recipe_cooking_times_view.php?msg=Recipe Cooking Time Deleted Successfully&msg_type=Success'</script>";
    exit();
}
?>
