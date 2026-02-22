<?php
$conn = new mysqli("localhost", "root", "", "university_db");

$result = $conn->query("SELECT * FROM academic2 ORDER BY id DESC LIMIT 1");

$data = $result->fetch_assoc();

echo json_encode($data);
?>