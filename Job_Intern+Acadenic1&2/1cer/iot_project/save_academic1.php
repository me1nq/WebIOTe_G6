<?php
include "config.php";

$title   = $_POST['title'];
$content = $_POST['content'];
$tuition = $_POST['tuition'];
$color   = $_POST['color'];

$imagePath = "";
$pdfPath   = "";

$uploadDir = "uploads/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (!empty($_FILES['image']['name'])) {
    $imageName = time() . "_" . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
    $imagePath = $uploadDir . $imageName;
}

if (!empty($_FILES['pdf']['name'])) {
    $pdfName = time() . "_" . $_FILES['pdf']['name'];
    move_uploaded_file($_FILES['pdf']['tmp_name'], $uploadDir . $pdfName);
    $pdfPath = $uploadDir . $pdfName;
}

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

$stmt->execute();

header("Location: adminacademic1.php?success=1");
exit();
?>