<?php
include("../config/db_con.php");
$query = "SELECT * FROM meal_types WHERE status = 'active'";
$result = mysqli_query($dbconnection, $query);
$meal_types = mysqli_fetch_all($result, MYSQLI_ASSOC);
echo json_encode($meal_types);
?>
