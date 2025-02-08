
<?php
header('Content-Type: application/json');
include("../config/db_con.php");


$sql = "SELECT * FROM cooking_times";
$result = $dbconnection->query($sql);

$cooking_times = [];
while ($row = $result->fetch_assoc()) {
    $cooking_times[] = $row;
}

echo json_encode($cooking_times);
$dbconnection->close();
?>
