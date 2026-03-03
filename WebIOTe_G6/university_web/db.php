<?php
$servername = "localhost";
$username = "root"; // XAMPP ตั้งค่าเริ่มต้นเป็น root
$password = ""; // XAMPP ตั้งค่าเริ่มต้นรหัสผ่านเป็นค่าว่าง
$dbname = "university_web"; // ชื่อ Database ที่คุณเพิ่งสร้าง

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// เช็คว่าเชื่อมต่อสำเร็จไหม
if ($conn->connect_error) {
  die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

// ตั้งค่าให้รองรับภาษาไทย
$conn->set_charset("utf8mb4");
?>