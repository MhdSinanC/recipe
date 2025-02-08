<?php
include("../../config/db_con.php");

// Handle the form submission for adding a new ingredient
if (isset($_POST["btnAddIng"])) {
    $name = mysqli_real_escape_string($dbconnection, $_POST['name']);
    $status = mysqli_real_escape_string($dbconnection, $_POST['status']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    // Insert query for adding a new ingredient
    $insert_query = "INSERT INTO ingredients (name, status, created_at, updated_at) 
                     VALUES ('$name','$status', '$created_at', '$updated_at')";
    $insert_result = mysqli_query($dbconnection, $insert_query);

    if ($insert_result) {
        $msg = "Ingredient successfully added.";
        $msg_type = "Success";
    } else {
        $msg = "Error adding ingredient: " . mysqli_error($dbconnection);
        $msg_type = "Error";
    }
    echo "<script>location='../ingrediants_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
    exit();
}

// Handle the form submission for updating an ingredient
if (isset($_POST["btnIngredientUpdate"])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
 
    $status = $_POST['status'];
    $updated_at = date('Y-m-d H:i:s');

    // Update query for updating an ingredient
    $update_query = "UPDATE ingredients SET name = '$name', 
                     status = '$status', updated_at = '$updated_at' WHERE id = $id";
    $update_result = mysqli_query($dbconnection, $update_query);

    if ($update_result) {
        $msg = "Ingredient successfully updated.";
        $msg_type = "Success";
    } else {
        $msg = "Error updating ingredient: " . mysqli_error($dbconnection);
        $msg_type = "Error";
    }
    echo "<script>location='../ingredients_view.php?ingredient_id=$id&msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
    exit();
}

// Handle the form submission for deleting an ingredient
if (isset($_POST["btnIngredientDelete"])) {
    $id = $_POST['id_ref'];
    $sql = "DELETE FROM ingredients WHERE id = $id";

    if (mysqli_query($dbconnection, $sql)) {
        $msg = "Ingredient successfully deleted.";
        $msg_type = "Success";
    } else {
        $msg = "Ingredient NOT deleted. Error: " . mysqli_error($dbconnection);
        $msg_type = "Error";
    }
    echo "<script>location='../ingredients_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
    exit();
}
?>
