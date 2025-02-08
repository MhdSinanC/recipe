<?php
include("../config/db_con.php");

$recipe_id = $_POST['recipe_id'];
$user_id = $_POST['user_id'];

$query = "DELETE FROM favorites WHERE user_id = '$user_id' AND recipe_id = '$recipe_id'";
$result = mysqli_query($dbconnection, $query);

echo json_encode(['success' => $result]);
?>
