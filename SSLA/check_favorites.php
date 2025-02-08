<?php
include("../config/db_con.php");

$recipe_id = $_GET['recipe_id'];
$user_id = $_GET['user_id'];

$query = "SELECT 1 FROM favorites WHERE user_id = '$user_id' AND recipe_id = '$recipe_id'";
$result = mysqli_query($dbconnection, $query);

echo json_encode(['isFavorite' => mysqli_num_rows($result) > 0]);
?>
