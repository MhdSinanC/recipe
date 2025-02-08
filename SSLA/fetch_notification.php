<?php
header('Content-Type: application/json');
include("../config/db_con.php");

$currentDate = date('Y-m-d');

// Query to fetch events happening tomorrow
$sql = "
    SELECT 
        t.theyyam_id,
        t.name AS event_name,
        t.date AS event_date,
        t.timing AS event_time,
        temp.name AS temple_name,
        temp.location AS temple_location
    FROM 
        theyyam t
    INNER JOIN 
        temples temp ON t.temple_id = temp.temple_id
    WHERE 
        DATEDIFF(t.date, ?) = 1 
        AND t.status = 'active' 
        AND temp.status = 'active'
    ORDER BY 
        t.date ASC, t.timing ASC
";

$stmt = $dbconnection->prepare($sql);
$stmt->bind_param('s', $currentDate);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $events = [];

    while ($row = $result->fetch_assoc()) {
        $events[] = [
            'theyyam_id' => $row['theyyam_id'],
            'event_name' => $row['event_name'],
            'event_date' => $row['event_date'],
            'event_time' => $row['event_time'],
            'temple_name' => $row['temple_name'],
            'temple_location' => $row['temple_location'],
        ];
    }

    echo json_encode([
        'status' => 'success',
        'data' => $events,
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to fetch notifications',
    ]);
}

$stmt->close();
$dbconnection->close();
?>
