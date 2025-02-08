<?php
include("../config/db_con.php");
$query = "SELECT * FROM cooking_times WHERE status = 'active'";
$result = mysqli_query($dbconnection, $query);
$cooking_times = mysqli_fetch_all($result, MYSQLI_ASSOC);
echo json_encode($cooking_times);
?>