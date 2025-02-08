<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_email'])) {
    $msg = "Session Timeout";
    $msg_type = "Error";
    echo "<script>location='../index.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
    exit();
}

$session_email = $_SESSION['user_email'];
$session_employee_id = "";
$session_name = "";
$session_branch_id = "";

$sql = "SELECT `employee_id`, `full_name`, `branch_id` FROM `employee_details` WHERE `email`=?";
$stmt = $dbconnection->prepare($sql);
$stmt->bind_param("s", $session_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $session_employee_id = $row["employee_id"];
    $session_name = $row["full_name"];
    $session_branch_id = $row["branch_id"];
} else {
    $msg = "Your session has timed out due to inactivity.";
    $msg_type = "Error";
    echo "<script>location='../index.php?msg=" . urlencode($msg) . "&msg_type=" . urlencode($msg_type) . "'</script>";
    exit();
}

$stmt->close();
?>


