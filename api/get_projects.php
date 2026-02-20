<?php
// api/get_projects.php
// error_reporting(0);
// ini_set('display_errors', 0);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// เรียกใช้ไฟล์ config (รวม Header และ Connection ไว้ในนั้นแล้ว)
require_once '../config/db.php'; 

// Query ข้อมูล
$sql = "SELECT p.*, r.round_name AS round_title 
        FROM admission_projects p 
        LEFT JOIN admission_rounds r ON p.round_id = r.id 
        ORDER BY r.id, p.id";

$result = $conn->query($sql);

$projects = array();
if ($result) {
    while($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
}

echo json_encode($projects);
$conn->close();
?>