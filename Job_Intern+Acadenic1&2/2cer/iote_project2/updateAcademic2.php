<?php
$conn = new mysqli("localhost", "root", "", "university_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$content = $_POST['content'];
$tuition = $_POST['tuition'];
$color = $_POST['color'];

$imagePath = "";
$pdfPath = "";

// สร้างโฟลเดอร์ uploads ถ้าไม่มี
if (!file_exists("uploads")) {
    mkdir("uploads", 0777, true);
}

if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
    $imageName = time() . "_" . $_FILES['image']['name'];
    $imagePath = "uploads/" . $imageName;
    move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
}

if(isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0){
    $pdfName = time() . "_" . $_FILES['pdf']['name'];
    $pdfPath = "uploads/" . $pdfName;
    move_uploaded_file($_FILES['pdf']['tmp_name'], $pdfPath);
}

$stmt = $conn->prepare("INSERT INTO academic2 
(title, content, tuition, bg_color, image_path, pdf_path)
VALUES (?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssss", 
$title, $content, $tuition, $color, $imagePath, $pdfPath);

$stmt->execute();

echo "success";
?>