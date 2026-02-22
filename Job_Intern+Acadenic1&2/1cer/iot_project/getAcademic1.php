<?php
$conn = new mysqli("localhost", "root", "", "university_db");

$result = $conn->query("SELECT * FROM academic1 ORDER BY id DESC LIMIT 1");
$row = $result->fetch_assoc();

echo json_encode($row);
?>