<?php
include("../../config/db_con.php");

// Handle the form submission for adding a new meal
if (isset($_POST["btnAddMealPlanner"])) {
    $name = mysqli_real_escape_string($dbconnection, $_POST['name']);
    $type = mysqli_real_escape_string($dbconnection, $_POST['type']);
    $ingredients = mysqli_real_escape_string($dbconnection, $_POST['ingredients']);
    $equipment = mysqli_real_escape_string($dbconnection, $_POST['equipment']);
    $cooking_time = intval($_POST['cooking_time']);
    $preparation_method = mysqli_real_escape_string($dbconnection, $_POST['preparation_method']);
    $status = mysqli_real_escape_string($dbconnection, $_POST['status']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    // Insert query for adding a new meal
    $insert_query = "INSERT INTO meals_planner (name, type, ingredients, equipment, cooking_time, preparation_method, status, created_at, updated_at) 
                     VALUES ('$name', '$type', '$ingredients', '$equipment', '$cooking_time', '$preparation_method', '$status', '$created_at', '$updated_at')";
    $insert_result = mysqli_query($dbconnection, $insert_query);

    if ($insert_result) {
        $msg = "Meal successfully added.";
        $msg_type = "Success";
    } else {
        $msg = "Error adding meal: " . mysqli_error($dbconnection);
        $msg_type = "Error";
    }
    echo "<script>location='../meals_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
    exit();
}

// Handle the form submission for updating a meal
if (isset($_POST["btnMealUpdate"])) {
    $id = intval($_POST['meal_id']);
    $name = mysqli_real_escape_string($dbconnection, $_POST['name']);
    $type = mysqli_real_escape_string($dbconnection, $_POST['type']);
    $ingredients = mysqli_real_escape_string($dbconnection, $_POST['ingredients']);
    $equipment = mysqli_real_escape_string($dbconnection, $_POST['equipment']);
    $cooking_time = intval($_POST['cooking_time']);
    $preparation_method = mysqli_real_escape_string($dbconnection, $_POST['preparation_method']);
    $status = mysqli_real_escape_string($dbconnection, $_POST['status']);
    $updated_at = date('Y-m-d H:i:s');

    // Update query for updating a meal
    $update_query = "UPDATE meals_planner SET name = '$name', type = '$type', ingredients = '$ingredients', 
                     equipment = '$equipment', cooking_time = '$cooking_time', preparation_method = '$preparation_method',
                     status = '$status', updated_at = '$updated_at' WHERE id = $id";
    $update_result = mysqli_query($dbconnection, $update_query);

    if ($update_result) {
        $msg = "Meal successfully updated.";
        $msg_type = "Success";
    } else {
        $msg = "Error updating meal: " . mysqli_error($dbconnection);
        $msg_type = "Error";
    }
    echo "<script>location='../meals_view.php?meal_id=$id&msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
    exit();
}

// Handle the form submission for deleting a meal
if (isset($_POST["btnMealDelete"])) {
    $id = intval($_POST['id_ref']);
    $sql = "DELETE FROM meals_planner WHERE id = $id";

    if (mysqli_query($dbconnection, $sql)) {
        $msg = "Meal successfully deleted.";
        $msg_type = "Success";
    } else {
        $msg = "Meal NOT deleted. Error: " . mysqli_error($dbconnection);
        $msg_type = "Error";
    }
    echo "<script>location='../meals_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
    exit();
}
?>
