<?php
include("../config/db_con.php");

$recipe_id = $_POST['recipe_id'];
$user_id = $_POST['user_id'];

$query = "INSERT INTO favorites (user_id, recipe_id, created_at) VALUES ('$user_id', '$recipe_id', NOW())";
$result = mysqli_query($dbconnection, $query);

echo json_encode(['success' => $result]);
?>
