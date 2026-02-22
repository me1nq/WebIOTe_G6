<?php
$conn = new mysqli("localhost","root","","university_db");

$id = $_POST['id'];

// ดึงชื่อรูปก่อนลบ
$result = $conn->query("SELECT image FROM internships WHERE id=$id");
$row = $result->fetch_assoc();
$image = $row['image'];

// ลบข้อมูลจาก DB
if($conn->query("DELETE FROM internships WHERE id=$id")){

    // ลบไฟล์รูป
    if(file_exists("uploads/" . $image)){
        unlink("uploads/" . $image);
    }

    echo json_encode(["success"=>true]);
}else{
    echo json_encode(["success"=>false,"error"=>$conn->error]);
}
?>