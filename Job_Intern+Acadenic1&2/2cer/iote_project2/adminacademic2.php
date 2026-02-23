<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Admin - Physics + IoT</title>
    <link rel="stylesheet" href="adminacademic2.css">
</head>
<body>

<h1>Admin Panel - Physics + IoT</h1>

<div class="admin-container">

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

    <hr>

    <label>อัปโหลดไฟล์ PDF หลักสูตร</label>
    <input type="file" name="pdf" accept="application/pdf">

    <button type="submit">บันทึกข้อมูลทั้งหมด</button>

</form>

</div>

</body>
</html>