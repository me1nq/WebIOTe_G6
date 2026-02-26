<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - PhysIoT</title>
<link rel="stylesheet" href="adminacademic2.css">
</head>
<body>

<div class="admin-container">
    <h1>Admin - PhysIoT</h1>

    <form action="updateAcademic2.php" method="POST" enctype="multipart/form-data">

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

<?php if(isset($_GET['success'])): ?>
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