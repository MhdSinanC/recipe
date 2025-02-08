<?php
include("../config/db_con.php");
$query = "SELECT * FROM equipments WHERE status = 'active'";
$result = mysqli_query($dbconnection, $query);
$equipments = mysqli_fetch_all($result, MYSQLI_ASSOC);
echo json_encode($equipments);
?>