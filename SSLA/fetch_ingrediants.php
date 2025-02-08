<?php
header('Content-Type: application/json');
include("../config/db_con.php");

if (isset($_GET['meal_type_id'])) {
    $meal_type_id = intval($_GET['meal_type_id']);
    $sql = "SELECT * FROM ingredients WHERE meal_type_id = $meal_type_id";
    $result = $dbconnection->query($sql);

    $ingredients = [];
    while ($row = $result->fetch_assoc()) {
        $ingredients[] = $row;
    }

    echo json_encode($ingredients);
} else {
    echo json_encode(["error" => "meal_type_id is required"]);
}

$dbconnection->close();
?>
