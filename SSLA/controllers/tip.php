<?php
include("../../config/db_con.php");

// Handle the form submission for adding a new cooking tip
if (isset($_POST["btnAddCookingTip"])) {
    // Get the form data
    $tip = mysqli_real_escape_string($dbconnection, $_POST['tip']);
    $status = mysqli_real_escape_string($dbconnection, $_POST['status']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    // Handle file upload for the image
    $image = $_FILES['image']['name']; // Get the name of the uploaded file
    $image_tmp = $_FILES['image']['tmp_name']; // Get the temporary file path
    $image_type = strtolower(pathinfo($image, PATHINFO_EXTENSION)); // Get the file extension

    // Allowed image types
    $allowed_types = ['jpg', 'jpeg', 'png'];

    if ($image) {
        // Check if the uploaded file is of a valid type
        if (in_array($image_type, $allowed_types)) {
            // Set the target directory for the uploaded file
            $target_dir = "../../uploads/";
            $target_file = $target_dir . basename($image); // Full path of the target file

            // Move the uploaded file to the target directory
            if (move_uploaded_file($image_tmp, $target_file)) {
                // If the file was successfully uploaded, insert data into the database
                $insert_query = "INSERT INTO cooking_tips (
                    tip, 
                    image, 
                    status, 
                    created_at, 
                    updated_at
                ) VALUES (
                    '$tip', 
                    '$image', 
                    '$status', 
                    '$created_at', 
                    '$updated_at'
                );";

                $insert_result = mysqli_query($dbconnection, $insert_query);

                // Check whether the query was successful
                if ($insert_result) {
                    $msg = "Cooking Tip successfully added.";
                    $msg_type = "Success";
                    echo "<script>location='../tip_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
                    exit();
                } else {
                    // Print MySQL error if query fails
                    die('Query failed: ' . mysqli_error($dbconnection));
                }
            } else {
                // If file upload fails
                $msg = "Sorry, there was an error uploading your file.";
                $msg_type = "Error";
                echo "<script>location='../tip_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
                exit();
            }
        } else {
            // If the uploaded file is not a valid image type
            $msg = "Invalid file format. Only JPG, JPEG, and PNG are allowed.";
            $msg_type = "Error";
            echo "<script>location='../tip_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
            exit();
        }
    } else {
        // If no image is uploaded
        $msg = "No image file uploaded.";
        $msg_type = "Error";
        echo "<script>location='../tip_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
        exit();
    }
}

if (isset($_POST["btnTipUpdate"])) {
    $id = $_POST['id'];
    $tip = $_POST['tip'];
    $status = $_POST['status'];
    $image = $_FILES['image']['name'] ? $_FILES['image']['name'] : $_POST['existing_image'];
    $updated_at = date('Y-m-d H:i:s');

    // Handle image upload
    if ($image) {
        $target_dir = "../../uploads/"; // Directory where images will be uploaded
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    }

    // Update the cooking tip record in the database
    $update_query = "UPDATE cooking_tips SET
        tip = '$tip',
        status = '$status',
        image = '$image',
        updated_at = '$updated_at'
      WHERE id = $id";

    $update_result = mysqli_query($dbconnection, $update_query);

    // Check whether the query was successful or not
    if ($update_result) {
        $msg = "Cooking Tip successfully updated.";
        $msg_type = "Success";
        echo "<script>location='../tip_view.php?tip_id=$id&msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
        exit();
    } else {
        $msg = "Something went wrong. Please try again.";
        $msg_type = "Error";
        echo "<script>location='../tip_view.php?tip_id=$id&msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
        exit();
    }
}
if (isset($_POST["btn_cooking_tip_delete"])) {
    $id_ref = $_POST['id_ref'];

    $sql = "DELETE FROM cooking_tips WHERE id = $id_ref";

    // Execute the query
    if (mysqli_query($dbconnection, $sql)) {
        $msg = "Cooking Tip successfully deleted.";
        $msg_type = "Success";
        echo "<script>location='../tip_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
        exit();
    } else {
        $msg = "Cooking Tip NOT deleted. Something went wrong.";
        $msg_type = "Error";
        echo "<script>location='../tip_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
        exit();
    }
}
?>