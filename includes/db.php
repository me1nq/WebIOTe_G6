<?php
$conn = mysqli_connect("localhost", "root", "", "webiote");
if (!$conn) { die("เชื่อมต่อฐานข้อมูลไม่ได้: " . mysqli_connect_error()); }
mysqli_set_charset($conn, "utf8");
?>