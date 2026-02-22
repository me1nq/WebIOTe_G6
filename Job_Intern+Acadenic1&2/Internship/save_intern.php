<?php
header('Content-Type: application/json');

// เปิด error ชั่วคราวเพื่อ debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli("localhost", "root", "", "university_db");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "error" => $conn->connect_error]);
    exit;
}

$company = $_POST['company'] ?? '';
$position = $_POST['position'] ?? '';
$date_range = $_POST['date_range'] ?? '';
$details = $_POST['details'] ?? '';

if (!$company || !$position || !$date_range || !$details) {
    echo json_encode(["success" => false, "error" => "Missing data"]);
    exit;
}

$imageName = "";

if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {

    $uploadDir = "uploads/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $imageName = time() . "_" . basename($_FILES["image"]["name"]);
    $targetFile = $uploadDir . $imageName;

    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo json_encode(["success" => false, "error" => "Upload failed"]);
        exit;
    }
} else {
    echo json_encode(["success" => false, "error" => "No image uploaded"]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO internships (company, position, date_range, image, details) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $company, $position, $date_range, $imageName, $details);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>