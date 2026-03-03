<?php 
session_start(); 
session_destroy(); // ล้างความจำว่าเคยล็อกอิน (ออกจากระบบ)

// เช็คว่าระบบจำได้ไหมว่ามึงเพิ่งกดมาจากหน้าไหน
if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
    // ถ้าจำได้ ให้เด้งกลับไปหน้าที่เพิ่งจากมาเลย
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    // ถ้าจำไม่ได้ (กันเหนียวไว้ก่อน) ให้เด้งกลับไปหน้าแรก
    header("Location: index.php"); 
}
exit(); 
?>