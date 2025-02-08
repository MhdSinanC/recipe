<?php
include("../../config/db_con.php");

// Handle the form submission for adding a new category
if (isset($_POST["btnAddCategory"])) {
    // Get the form data
    $name = mysqli_real_escape_string($dbconnection, $_POST['name']);
    $status = mysqli_real_escape_string($dbconnection, $_POST['status']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    // Handle file upload for image
    $image = $_FILES['image']['name'];  // Get the name of the uploaded file
    $image_tmp = $_FILES['image']['tmp_name'];  // Get the temporary file path
    $image_type = strtolower(pathinfo($image, PATHINFO_EXTENSION)); // Get file extension

    // Allowed image types
    $allowed_types = ['jpg', 'jpeg', 'png'];

    if ($image) {
        // Check if the uploaded file is of a valid type
        if (in_array($image_type, $allowed_types)) {
            // Set the target directory for the uploaded file
            $target_dir = "../../uploads/";
            $target_file = $target_dir . basename($image);  // Full path of the target file

            // Move the uploaded file to the target directory
            if (move_uploaded_file($image_tmp, $target_file)) {
                // If the file was successfully uploaded, insert data into the database
                $insert_query = "INSERT INTO categories (
                    name, 
                    image, 
                    status, 
                    created_at, 
                    updated_at
                ) VALUES (
                    '$name', 
                    '$image', 
                    '$status', 
                    '$created_at', 
                    '$updated_at'
                );";

                $insert_result = mysqli_query($dbconnection, $insert_query);

                // Check whether the query was successful
                if ($insert_result) {
                    $msg = "Category successfully added.";
                    $msg_type = "Success";
                    echo "<script>location='../cuisine_category_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
                    exit();
                } else {
                    // Print MySQL error if query fails
                    die('Query failed: ' . mysqli_error($dbconnection));
                }
            } else {
                // If file upload fails
                $msg = "Sorry, there was an error uploading your file.";
                $msg_type = "Error";
                echo "<script>location='../cuisine_category_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
                exit();
            }
        } else {
            // If the uploaded file is not a valid image type
            $msg = "Invalid file format. Only JPG, JPEG, and PNG are allowed.";
            $msg_type = "Error";
            echo "<script>location='../cuisine_category_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
            exit();
        }
    } else {
        // If no image is uploaded
        $msg = "No image file uploaded.";
        $msg_type = "Error";
        echo "<script>location='../cuisine_category_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
        exit();
    }
}

// Handle the form submission for updating a category
if (isset($_POST["btnCategoryUpdate"])) {
    $id = $_POST['category_id'];
    $name = $_POST['name'];
    $status = $_POST['status'];
    $image = $_FILES['image']['name'] ? $_FILES['image']['name'] : $_POST['existing_image'];
    $updated_at = date('Y-m-d H:i:s');

    // Handle the image upload
    if ($image) {
        $target_dir = "../../uploads/"; // Directory where images will be uploaded
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    }

    // Update the category record in the database
    $update_query = "UPDATE categories SET
        name = '$name',
        status = '$status',
        image = '$image',
        updated_at = '$updated_at'
      WHERE category_id = $id";

    $update_result = mysqli_query($dbconnection, $update_query);

    // Check whether the query was successful or not
    if ($update_result) {
        $msg = "Category successfully updated.";
        $msg_type = "Success";
        echo "<script>location='../cuisine_category_view.php?category_id=$id&msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
        exit();
    } else {
        $msg = "Something went wrong. Please try again.";
        $msg_type = "Error";
        echo "<script>location='../cuisine_category_view.php?category_id=$id&msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
        exit();
    }
}

// Handle the form submission for deleting a category
if (isset($_POST["btn_category_delete"])) {
    $id_ref = $_POST['id_ref'];

    $sql = "DELETE FROM categories WHERE category_id = $id_ref";

    // Execute the query
    if (mysqli_query($dbconnection, $sql)) {
        $msg = "Category successfully deleted.";
        $msg_type = "Success";
        echo "<script>location='../cuisine_category_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
        exit();
    } else {
        $msg = "Category NOT deleted. Something went wrong.";
        $msg_type = "Error";
        echo "<script>location='../cuisine_category_view.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
        exit();
    }
}
?>
