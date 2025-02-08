<?php
include("../../config/db_con.php");

// Handle the form submission for adding a new equipment
if (isset($_POST["btnAddEquipment"])) {
    $name = mysqli_real_escape_string($dbconnection, $_POST['name']);
    $status = mysqli_real_escape_string($dbconnection, $_POST['status']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    $insert_query = "INSERT INTO equipments (name, status, created_at, updated_at) 
                     VALUES ('$name', '$status', '$created_at', '$updated_at')";
    $insert_result = mysqli_query($dbconnection, $insert_query);

    if ($insert_result) {
        $msg = "Equipment successfully added.";
        $msg_type = "Success";
    } else {
        $msg = "Error adding equipment: " . mysqli_error($dbconnection);
        $msg_type = "Error";
    }
    echo "<script>location='../equipments_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
    exit();
}

// Handle the form submission for updating an equipment
if (isset($_POST["btnEquipmentUpdate"])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $status = $_POST['status'];
    $updated_at = date('Y-m-d H:i:s');

    $update_query = "UPDATE equipments SET name = '$name', status = '$status', updated_at = '$updated_at' WHERE id = $id";
    $update_result = mysqli_query($dbconnection, $update_query);

    if ($update_result) {
        $msg = "Equipment successfully updated.";
        $msg_type = "Success";
    } else {
        $msg = "Error updating equipment: " . mysqli_error($dbconnection);
        $msg_type = "Error";
    }
    echo "<script>location='../equipment_view.php?equipment_id=$id&msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
    exit();
}

// Handle the form submission for deleting an equipment
if (isset($_POST["btnEquipmentDelete"])) {
    $id = $_POST['id_ref'];
    $sql = "DELETE FROM equipments WHERE id = $id";

    if (mysqli_query($dbconnection, $sql)) {
        $msg = "Equipment successfully deleted.";
        $msg_type = "Success";
    } else {
        $msg = "Equipment NOT deleted. Error: " . mysqli_error($dbconnection);
        $msg_type = "Error";
    }
    echo "<script>location='../equipment_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
    exit();
}
?>
