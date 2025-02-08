<?php
include("../../config/db_con.php");

// Handle adding a new recipe equipment entry
if (isset($_POST["btnAddRecipeEquipment"])) {
    $recipe_id = mysqli_real_escape_string($dbconnection, $_POST['recipe_id']);
    $equipment_ids = $_POST['equipment_id']; // Array of equipment IDs
    $status = mysqli_real_escape_string($dbconnection, $_POST['status']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');
    
    foreach ($equipment_ids as $equipment_id) {
        $equipment_id = mysqli_real_escape_string($dbconnection, $equipment_id);
        $insert_query = "INSERT INTO recipe_equipments (recipe_id, equipment_id, status, created_at, updated_at) 
                         VALUES ('$recipe_id', '$equipment_id', '$status', '$created_at', '$updated_at')";
        mysqli_query($dbconnection, $insert_query);
    }
    echo "<script>location='../recipe_equipments_view.php?msg=Recipe Equipments Added Successfully&msg_type=Success'</script>";
    exit();
}

// Handle updating a recipe equipment entry
if (isset($_POST["btnUpdateRecipeEquipment"])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $updated_at = date('Y-m-d H:i:s');

    $update_query = "UPDATE recipe_equipments SET status = '$status', updated_at = '$updated_at' WHERE id = $id";
    mysqli_query($dbconnection, $update_query);

    echo "<script>location='../recipe_equipments_view.php?msg=Recipe Equipment Updated Successfully&msg_type=Success'</script>";
    exit();
}

// Handle deleting a recipe equipment entry
if (isset($_POST["btnDeleteRecipeEquipment"])) {
    $id = $_POST['id_ref'];
    $delete_query = "DELETE FROM recipe_equipments WHERE id = $id";
    mysqli_query($dbconnection, $delete_query);

    echo "<script>location='../recipe_equipments_view.php?msg=Recipe Equipment Deleted Successfully&msg_type=Success'</script>";
    exit();
}
?>
