<?php
header('Content-Type: application/json');
include("../config/db_con.php");

$sql = "SELECT * FROM equipments";
$result = $dbconnection->query($sql);

$equipments = [];
while ($row = $result->fetch_assoc()) {
    $equipments[] = $row;
}

echo json_encode($equipments);
$dbconnection->close();
?>
