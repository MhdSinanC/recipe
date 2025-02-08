<?php
header('Content-Type: application/json');
include("../config/db_con.php");


$sql = "SELECT * FROM meal_types";
$result = $dbconnection->query($sql);

$meal_types = [];
while ($row = $result->fetch_assoc()) {
    $meal_types[] = $row;
}

echo json_encode($meal_types);
$dbconnection->close();
?>
