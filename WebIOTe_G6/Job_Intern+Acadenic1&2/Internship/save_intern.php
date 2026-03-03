<?php
$conn = new mysqli("localhost", "root", "", "university_db");

$company = $_POST['company'];
$position = $_POST['position'];
$date_range = $_POST['date_range'];
$details = $_POST['details'];

$imageName = "";

if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

    $imageName = time() . "_" . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);
}

$stmt = $conn->prepare("INSERT INTO internships (company, position, date_range, image, details) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $company, $position, $date_range, $imageName, $details);
$stmt->execute();

header("Location: AdminInternship.php?success=1");
exit;