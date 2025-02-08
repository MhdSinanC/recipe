<?php
include("../../config/db_con.php");

// Handle the form submission for adding a new meal type
if (isset($_POST["btnAddMealType"])) {
    $name = mysqli_real_escape_string($dbconnection, $_POST['name']);
    $status = mysqli_real_escape_string($dbconnection, $_POST['status']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    $insert_query = "INSERT INTO meal_types (name, status, created_at, updated_at) VALUES ('$name', '$status', '$created_at', '$updated_at')";
    $insert_result = mysqli_query($dbconnection, $insert_query);

    if ($insert_result) {
        $msg = "Meal type successfully added.";
        $msg_type = "Success";
    } else {
        $msg = "Error adding meal type: " . mysqli_error($dbconnection);
        $msg_type = "Error";
    }
    echo "<script>location='../mealtype_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
    exit();
}

// Handle the form submission for updating a meal type
if (isset($_POST["btnMealTypeUpdate"])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $status = $_POST['status'];
    $updated_at = date('Y-m-d H:i:s');

    $update_query = "UPDATE meal_types SET name = '$name', status = '$status', updated_at = '$updated_at' WHERE id = $id";
    $update_result = mysqli_query($dbconnection, $update_query);

    if ($update_result) {
        $msg = "Meal type successfully updated.";
        $msg_type = "Success";
    } else {
        $msg = "Error updating meal type: " . mysqli_error($dbconnection);
        $msg_type = "Error";
    }
    echo "<script>location='../mealtype_view.php?mealtype_id=$id&msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
    exit();
}

// Handle the form submission for deleting a meal type
if (isset($_POST["btnMealTypeDelete"])) {
    $id = $_POST['id_ref'];
    $sql = "DELETE FROM meal_types WHERE id = $id";

    if (mysqli_query($dbconnection, $sql)) {
        $msg = "Meal type successfully deleted.";
        $msg_type = "Success";
    } else {
        $msg = "Meal type NOT deleted. Error: " . mysqli_error($dbconnection);
        $msg_type = "Error";
    }
    echo "<script>location='../mealtype_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
    exit();
}
?>
