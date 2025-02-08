<?php
include("../config/db_con.php");
$meal_type_id = $_GET['meal_type_id'];
$query = "SELECT * FROM ingredients WHERE status = 'active'";
$result = mysqli_query($dbconnection, $query);
$ingredients = mysqli_fetch_all($result, MYSQLI_ASSOC);
echo json_encode($ingredients);
?>