<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "university_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title   = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';
$tuition = $_POST['tuition'] ?? '';
$color   = $_POST['color'] ?? '';

$imagePath = "";
$pdfPath   = "";

/* =========================
   IMAGE UPLOAD
========================= */
if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {

    $imageName = time() . "_" . basename($_FILES['image']['name']);
    $uploadDir = __DIR__ . "/uploads/";
    $targetPath = $uploadDir . $imageName;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
        $imagePath = "uploads/" . $imageName;
    }
}

/* =========================
   PDF UPLOAD
========================= */
if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === 0) {

    $pdfName = time() . "_" . basename($_FILES['pdf']['name']);
    $uploadDir = __DIR__ . "/uploads/";
    $targetPath = $uploadDir . $pdfName;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($_FILES['pdf']['tmp_name'], $targetPath)) {
        $pdfPath = "uploads/" . $pdfName;
    }
}

/* =========================
   INSERT DATABASE
========================= */
$stmt = $conn->prepare("
    INSERT INTO academic1 
    (title, content, tuition, bg_color, image_path, pdf_path)
    VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->bind_param("ssssss",
    $title,
    $content,
    $tuition,
    $color,
    $imagePath,
    $pdfPath
);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "Database error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>