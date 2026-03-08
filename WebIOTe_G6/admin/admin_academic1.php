<?php
session_start();
include "../includes/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title   = $_POST['title'];
    $content = $_POST['content'];
    $tuition = $_POST['tuition'];
    $color   = $_POST['color'];

    $imagePath = "";
    $pdfPath   = "";

    $uploadDir = "../assets/";
    $dbPath    = "assets/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . $_FILES['image']['name'];
        // เอาไฟล์ไปวางด้วย $uploadDir
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
        // แต่เซฟชื่อลง DB ด้วย $dbPath
        $imagePath = $dbPath . $imageName; 
    }

    if (!empty($_FILES['pdf']['name'])) {
        $pdfName = time() . "_" . $_FILES['pdf']['name'];
        // เอาไฟล์ไปวางด้วย $uploadDir
        move_uploaded_file($_FILES['pdf']['tmp_name'], $uploadDir . $pdfName);
        // แต่เซฟชื่อลง DB ด้วย $dbPath
        $pdfPath = $dbPath . $pdfName; 
    }

    // บันทึกลงฐานข้อมูล
    $stmt = $conn->prepare("
        INSERT INTO academic1
        (title, content, tuition, bg_color, image_path, pdf_path)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("ssssss", $title, $content, $tuition, $color, $imagePath, $pdfPath);

    if ($stmt->execute()) {
        // ถ้าเซฟสำเร็จ ให้สร้างตัวแปรนี้ไว้เพื่อไปเปิดป๊อปอัปสีเขียวด้านล่าง
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - IoT</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/admin_academic.css">
</head>
<body>

<div class="admin-container">
    <h1>Admin - IoT Engineering</h1>

    <form method="POST" enctype="multipart/form-data">

        <label>หัวข้อหลัก</label>
        <input type="text" name="title" required>

        <label>รายละเอียดเนื้อหา</label>
        <textarea name="content" rows="6" required></textarea>

        <label>ค่าธรรมเนียม</label>
        <input type="number" name="tuition" required>

        <label>สีพื้นหลังกล่องเนื้อหา</label>
        <input type="color" name="color" value="#f4b183">

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
        <button onclick="window.location.href='admin_academic1.php'">
            ตกลง
        </button>
    </div>
</div>
<?php endif; ?>

</body>
</html>