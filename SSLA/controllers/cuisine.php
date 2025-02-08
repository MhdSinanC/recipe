<?php
include("../../config/db_con.php");

// Handle the form submission for adding a new recipe
if (isset($_POST["btnAddCuisine"])) {
    // Get the form data
    $title = mysqli_real_escape_string($dbconnection, $_POST['title']);
    $description = mysqli_real_escape_string($dbconnection, $_POST['description']);
    $category_id = mysqli_real_escape_string($dbconnection, $_POST['category_id']);
    $ingredients = mysqli_real_escape_string($dbconnection, $_POST['ingredients']);
    $steps = mysqli_real_escape_string($dbconnection, $_POST['steps']);
    $calories = mysqli_real_escape_string($dbconnection, $_POST['calories']);
    $cooking_time = mysqli_real_escape_string($dbconnection, $_POST['cooking_time']);
    $status = mysqli_real_escape_string($dbconnection, $_POST['status']);
    $created_at = date('Y-m-d H:i:s');

    // Handle file upload
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_type = strtolower(pathinfo($image, PATHINFO_EXTENSION));

    // Allowed image types
    $allowed_types = ['jpg', 'jpeg', 'png'];

    if ($image) {
        if (in_array($image_type, $allowed_types)) {
            $target_dir = "../../uploads/";
            $target_file = $target_dir . basename($image);

            if (move_uploaded_file($image_tmp, $target_file)) {
                $insert_query = "INSERT INTO recipes (
                    title, 
                    description, 
                    category_id, 
                    ingredients, 
                    steps, 
                    calories, 
                    cooking_time,
                    image, 
                    status, 
                    created_at
                ) VALUES (
                    '$title', 
                    '$description', 
                    '$category_id', 
                    '$ingredients', 
                    '$steps', 
                    '$calories',
                    '$cooking_time', 

                    '$image', 
                    '$status', 
                    '$created_at'
                );";

                $insert_result = mysqli_query($dbconnection, $insert_query);

                if ($insert_result) {
                    $msg = "Recipe successfully added.";
                    $msg_type = "Success";
                    echo "<script>location='../cuisine_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
                    exit();
                } else {
                    die('Query failed: ' . mysqli_error($dbconnection));
                }
            } else {
                $msg = "Error uploading the file.";
                $msg_type = "Error";
                echo "<script>location='../cuisine_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
                exit();
            }
        } else {
            $msg = "Invalid file format. Only JPG, JPEG, and PNG are allowed.";
            $msg_type = "Error";
            echo "<script>location='../cuisine_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
            exit();
        }
    } else {
        $msg = "No image file uploaded.";
        $msg_type = "Error";
        echo "<script>location='../cuisine_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
        exit();
    }
}

// Handle the form submission for updating a recipe
if (isset($_POST["btnCuisineUpdate"])) {
    $recipe_id = $_POST['recipe_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $ingredients = $_POST['ingredients'];
    $steps = $_POST['steps'];
    $calories = $_POST['calories'];
    $cooking_time = $_POST['cooking_time'];
    $status = $_POST['status'];
    $image = $_FILES['image']['name'] ? $_FILES['image']['name'] : $_POST['existing_image'];
    $updated_at = date('Y-m-d H:i:s');

    if ($_FILES['image']['name']) {
        $target_dir = "../../uploads/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    }

    $update_query = "UPDATE recipes SET
        title = '$title',
        description = '$description',
        category_id = '$category_id',
        ingredients = '$ingredients',
        steps = '$steps',
        calories = '$calories',
        cooking_time = '$cooking_time',

        status = '$status',
        image = '$image',
        updated_at = '$updated_at'
      WHERE recipe_id = $recipe_id";

    $update_result = mysqli_query($dbconnection, $update_query);

    if ($update_result) {
        $msg = "Recipe successfully updated.";
        $msg_type = "Success";
        echo "<script>location='../cuisine_view.php?recipe_id=$recipe_id&msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
        exit();
    } else {
        $msg = "Something went wrong. Please try again.";
        $msg_type = "Error";
        echo "<script>location='../cuisine_view.php?recipe_id=$recipe_id&msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
        exit();
    }
}

// Handle the form submission for deleting a recipe
if (isset($_POST["btn_recipe_delete"])) {
    $id_ref = $_POST['id_ref'];

    $sql = "DELETE FROM recipes WHERE recipe_id = $id_ref";

    if (mysqli_query($dbconnection, $sql)) {
        $msg = "Recipe deleted successfully.";
        $msg_type = "Success";
        echo "<script>location='../cuisine_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
        exit();
    } else {
        $msg = "Recipe NOT deleted. Something went wrong.";
        $msg_type = "Error";
        echo "<script>location='../cuisine_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
        exit();
    }
}
?>