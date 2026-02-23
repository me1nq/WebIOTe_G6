<?php include "config.php"; ?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Admin Academic 1</title>
    <link rel="stylesheet" href="adminacademic1.css">
</head>
<body>

<div class="admin-box">
    <h2>Admin - Academic 1</h2>

    <form action="save_academic1.php" method="POST" enctype="multipart/form-data">

        <label>หัวข้อ</label>
        <input type="text" name="title" required>

        <label>เนื้อหา</label>
        <textarea name="content" required></textarea>

        <label>ค่าเทอม</label>
        <input type="text" name="tuition">

        <label>สีพื้นหลัง</label>
        <input type="color" name="color" value="#f4b183">

        <label>รูปภาพ</label>
        <input type="file" name="image">

        <label>ไฟล์ PDF</label>
        <input type="file" name="pdf">

        <button type="submit">บันทึก</button>

    </form>
</div>

</body>
</html>