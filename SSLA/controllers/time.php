<?php
include("../../config/db_con.php");

// Handle the form submission for adding a new cooking time
if (isset($_POST["btnAddCookingTime"])) {
    $time_range = mysqli_real_escape_string($dbconnection, $_POST['time_range']);
    $status = mysqli_real_escape_string($dbconnection, $_POST['status']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    $insert_query = "INSERT INTO cooking_times (time_range, status, created_at, updated_at) 
                     VALUES ('$time_range', '$status', '$created_at', '$updated_at')";
    $insert_result = mysqli_query($dbconnection, $insert_query);

    if ($insert_result) {
        $msg = "Cooking time successfully added.";
        $msg_type = "Success";
    } else {
        $msg = "Error adding cooking time: " . mysqli_error($dbconnection);
        $msg_type = "Error";
    }
    echo "<script>location='../time_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
    exit();
}

// Handle the form submission for updating a cooking time
if (isset($_POST["btnCookingTimeUpdate"])) {
    $id = $_POST['id'];
    $time_range = $_POST['time_range'];
    $status = $_POST['status'];
    $updated_at = date('Y-m-d H:i:s');

    $update_query = "UPDATE cooking_times SET time_range = '$time_range', status = '$status', updated_at = '$updated_at' WHERE id = $id";
    $update_result = mysqli_query($dbconnection, $update_query);

    if ($update_result) {
        $msg = "Cooking time successfully updated.";
        $msg_type = "Success";
    } else {
        $msg = "Error updating cooking time: " . mysqli_error($dbconnection);
        $msg_type = "Error";
    }
    echo "<script>location='../cookingtime_view.php?cookingtime_id=$id&msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
    exit();
}

// Handle the form submission for deleting a cooking time
if (isset($_POST["btnCookingTimeDelete"])) {
    $id = $_POST['id_ref'];
    $sql = "DELETE FROM cooking_times WHERE id = $id";

    if (mysqli_query($dbconnection, $sql)) {
        $msg = "Cooking time successfully deleted.";
        $msg_type = "Success";
    } else {
        $msg = "Cooking time NOT deleted. Error: " . mysqli_error($dbconnection);
        $msg_type = "Error";
    }
    echo "<script>location='../cookingtime_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
    exit();
}
?>
