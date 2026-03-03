<?php
session_start();
include "../includes/db.php";

// 🔴 ส่วนของ "พ่อครัว" จะทำงานตอนกดปุ่มบันทึก
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title   = $_POST['title'];
    $content = $_POST['content'];
    $tuition = $_POST['tuition'];
    $color   = $_POST['color'];

    $imagePath = "";
    $pdfPath   = "";

    // 🔴 ทริคแยกพาธ ให้รูปโชว์หน้าเว็บได้เป๊ะๆ
    $uploadDir = "../assets/"; // พาธสำหรับ "วางไฟล์จริง"
    $dbPath    = "assets/";    // พาธสำหรับ "เซฟข้อความลง DB"

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
        $imagePath = $dbPath . $imageName; 
    }

    if (!empty($_FILES['pdf']['name'])) {
        $pdfName = time() . "_" . $_FILES['pdf']['name'];
        move_uploaded_file($_FILES['pdf']['tmp_name'], $uploadDir . $pdfName);
        $pdfPath = $dbPath . $pdfName; 
    }

    // 🔴 บันทึกลงฐานข้อมูลตาราง academic2
    $stmt = $conn->prepare("
        INSERT INTO academic2 
        (title, content, tuition, bg_color, image_path, pdf_path)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("ssssss", $title, $content, $tuition, $color, $imagePath, $pdfPath);

    if ($stmt->execute()) {
        // ถ้าเซฟสำเร็จ โชว์ป๊อปอัป
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - PhysIoT</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/adminacademic.css">
</head>
<body>

<div class="admin-container">
    <h1>Admin - PhysIoT</h1>

    <form method="POST" enctype="multipart/form-data">

        <label>หัวข้อหลัก</label>
        <input type="text" name="title" required>

        <label>รายละเอียดเนื้อหา</label>
        <textarea name="content" rows="6" required></textarea>

        <label>ค่าธรรมเนียม</label>
        <input type="number" name="tuition" required>

        <label>สีพื้นหลังกล่องเนื้อหา</label>
        <input type="color" name="color" value="#ffffff">

        <label>เปลี่ยนรูปแผนการศึกษา</label>
        <input type="file" name="image" accept="image/*">

        <label>อัปโหลดไฟล์ PDF หลักสูตร</label>
        <input type="file" name="pdf" accept="application/pdf">

        <button type="submit">บันทึกข้อมูลทั้งหมด</button>

    </form>
</div>

<?php if(isset($success) && $success == true): ?>
<div class="popup-overlay">
    <div class="popup-box">
        <div class="success-icon">✓</div>
        <h2>อัปเดตข้อมูลสำเร็จ!</h2>
        <p>ระบบได้บันทึกการเปลี่ยนแปลงของคุณแล้ว</p>
        <button onclick="window.location.href='adminacademic2.php'">
            ตกลง
        </button>
    </div>
</div>
<?php endif; ?>

</body>
</html>