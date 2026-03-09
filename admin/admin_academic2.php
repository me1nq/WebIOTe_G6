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
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
        $imagePath = $dbPath . $imageName; 
    }

    if (!empty($_FILES['pdf']['name'])) {
        $pdfName = time() . "_" . $_FILES['pdf']['name'];
        move_uploaded_file($_FILES['pdf']['tmp_name'], $uploadDir . $pdfName);
        $pdfPath = $dbPath . $pdfName; 
    }

    $stmt = $conn->prepare("
        INSERT INTO academic2 
        (title, content, tuition, bg_color, image_path, pdf_path)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param("ssssss", $title, $content, $tuition, $color, $imagePath, $pdfPath);

    if ($stmt->execute()) {
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Admin - PhysIoT Engineering</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/admin_sidebar.css">
    <link rel="stylesheet" href="../css/admin_academic.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="admin-main-content">
    <div class="admin-container">
        
        <div class="top-panel" style="padding-bottom: 25px;">
            <div class="top-header" style="border-bottom:none; padding-bottom:0;">
                <h3 style="margin:0; color:#4a4a4a;">Admin - PhysIoT</h3>
                
                <div class="top-actions">
                    <a href="admin_academic1.php" class="btn-switch">
                        <i class="fas fa-arrow-left"></i> สลับไปจัดการ IoT
                    </a>
                </div>
            </div>
        </div>

        <div class="main-editor">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>หัวข้อหลัก</label>
                    <input type="text" name="title" required>
                </div>

                <div class="form-group">
                    <label>รายละเอียดเนื้อหา</label>
                    <textarea name="content" rows="6" required></textarea>
                </div>

                <div style="display: flex; gap: 15px;">
                    <div class="form-group" style="flex: 1;">
                        <label>ค่าธรรมเนียม</label>
                        <input type="number" name="tuition" required>
                    </div>
                    <div class="form-group" style="flex: 1;">
                        <label>สีพื้นหลังกล่องเนื้อหา</label>
                        <input type="color" name="color" value="#f4b183" style="width: 100%; height: 45px; cursor: pointer; border: 1px solid #ccc; border-radius: 8px;">
                    </div>
                </div>

                <div class="form-group">
                    <label>เปลี่ยนรูปแผนการศึกษา</label>
                    <input type="file" name="image" accept="image/*" style="border: 1px dashed #ccc; background: #fafafa; padding: 10px;">
                </div>

                <div class="form-group">
                    <label>อัปโหลดไฟล์ PDF หลักสูตร</label>
                    <input type="file" name="pdf" accept="application/pdf" style="border: 1px dashed #ccc; background: #fafafa; padding: 10px;">
                </div>

                <button type="submit" class="btn btn-save" style="width: 100%; padding: 15px; font-size: 1.1rem; margin-top: 10px;">บันทึกข้อมูลทั้งหมด</button>
            </form>
        </div>

    </div>

    <?php if(isset($success) && $success == true): ?>
    <div class="popup-overlay" id="academicPopup">
        <div class="popup-box">
            <div class="success-icon">✓</div>
            <h2 style="margin-top:0;">อัปเดตข้อมูลสำเร็จ!</h2>
            <p>ระบบได้บันทึกการเปลี่ยนแปลงของคุณแล้ว</p>
            <button class="btn btn-save" onclick="closePopup()">ตกลง</button>
        </div>
    </div>
    <?php endif; ?>
</div>

<script src="../js/admin_academic.js"></script>
</body>
</html>