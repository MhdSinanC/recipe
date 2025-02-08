<?php
include("../../config/db_con.php");

// Handle the form submission for adding a new meal
if (isset($_POST["btnAddMeal"])) {
    $name = mysqli_real_escape_string($dbconnection, $_POST['name']);
    $meal_type_id = mysqli_real_escape_string($dbconnection, $_POST['meal_type_id']);
    $preparation_method = mysqli_real_escape_string($dbconnection, $_POST['preparation_method']);
    $status = mysqli_real_escape_string($dbconnection, $_POST['status']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    // Insert query for adding a new meal
    $insert_query = "INSERT INTO mealrecipe (name, meal_type_id, preparation_method, status, created_at, updated_at) 
                     VALUES ('$name', '$meal_type_id','$preparation_method', '$status', '$created_at', '$updated_at')";
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
    $id = $_POST['id'];
    $name = $_POST['name'];
    $meal_type_id = $_POST['meal_type_id'];
   
    $preparation_method = $_POST['preparation_method'];
    $status = $_POST['status'];
    $updated_at = date('Y-m-d H:i:s');

    // Update query for updating a meal
    $update_query = "UPDATE mealrecipe SET name = '$name', meal_type_id = '$meal_type_id', 
                     preparation_method= '$preparation_method', status = '$status', updated_at = '$updated_at' WHERE id = $id";
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
    $id = $_POST['id_ref'];
    $sql = "DELETE FROM mealrecipe WHERE id = $id";

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
