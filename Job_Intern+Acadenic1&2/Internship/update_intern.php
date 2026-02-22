<?php
$conn = new mysqli("localhost","root","","university_db");

$id = $_POST['id'];
$company = $_POST['company'];
$position = $_POST['position'];
$date_range = $_POST['date_range'];
$details = $_POST['details'];

// ดึงรูปเดิม
$result = $conn->query("SELECT image FROM internships WHERE id=$id");
$row = $result->fetch_assoc();
$oldImage = $row['image'];

$imageName = $oldImage;

// ถ้ามีอัปโหลดรูปใหม่
if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

    $imageName = time() . "_" . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);

    // ลบรูปเก่า
    if(file_exists("uploads/" . $oldImage)){
        unlink("uploads/" . $oldImage);
    }
}

$sql = "UPDATE internships 
        SET company=?, position=?, date_range=?, details=?, image=? 
        WHERE id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $company, $position, $date_range, $details, $imageName, $id);

if($stmt->execute()){
    echo json_encode(["success"=>true]);
}else{
    echo json_encode(["success"=>false,"error"=>$conn->error]);
}
?>