<?php
$conn = new mysqli("localhost","root","","university_db");

$id = intval($_POST['id']);

$result = $conn->query("SELECT image FROM internships WHERE id=$id");
$row = $result->fetch_assoc();
$image = $row['image'];

$conn->query("DELETE FROM internships WHERE id=$id");

if(file_exists("uploads/" . $image)){
    unlink("uploads/" . $image);
}

header("Location: AdminInternship.php");
exit;
?>