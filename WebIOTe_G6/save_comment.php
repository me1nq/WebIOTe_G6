<?php
session_start();
require 'includes/db.php'; // เรียกใช้งาน Database

// 🔴 เช็คความปลอดภัยชั้นที่ 1: ล็อกอินหรือยัง? (อย่าลืมเปลี่ยน 'user_id' ให้ตรงกับของมึง)
if (!isset($_SESSION['user_id'])) {
    echo "กรุณาเข้าสู่ระบบก่อนคอมเมนต์";
    exit(); // สั่งหยุดการทำงานทันที
}

// เช็คว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // รับค่าที่ส่งมาจาก Javascript
    $personnel_id = $_POST['personnel_id'];
    $comment_text = $_POST['comment_text'];

    // ป้องกันการโจมตี (SQL Injection) 
    $personnel_id = $conn->real_escape_string($personnel_id);
    $comment_text = $conn->real_escape_string($comment_text);

    // ตรวจสอบว่าไม่ได้ส่งค่าว่างมา
    if(!empty($personnel_id) && !empty($comment_text)) {
        
        // คำสั่ง SQL เอาข้อมูลลงตาราง reviews
        $sql = "INSERT INTO reviews (personnel_id, comment_text) VALUES ('$personnel_id', '$comment_text')";

        if ($conn->query($sql) === TRUE) {
            echo "success"; // ส่งคำว่า success กลับไปให้ Javascript
        } else {
            echo "Error: " . $conn->error;
        }

    } else {
        echo "ข้อมูลไม่ครบถ้วน";
    }

} else {
    echo "ไม่อนุญาตให้เข้าถึงหน้านี้โดยตรง";
}

$conn->close();
?>