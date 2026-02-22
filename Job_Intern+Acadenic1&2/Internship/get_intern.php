<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "university_db");

if ($conn->connect_error) {
    echo json_encode(["error" => $conn->connect_error]);
    exit;
}

$result = $conn->query("SELECT * FROM internships ORDER BY id DESC");

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conn->close();
?>