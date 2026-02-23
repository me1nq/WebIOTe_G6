<?php
$conn = new mysqli("localhost","root","","university_db");

$editMode = false;
$editData = null;

// ถ้ามีการกดแก้ไข
if(isset($_GET['edit'])){
    $editMode = true;
    $id = intval($_GET['edit']);
    $resultEdit = $conn->query("SELECT * FROM internships WHERE id=$id");
    $editData = $resultEdit->fetch_assoc();
}

$result = $conn->query("SELECT * FROM internships ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Admin - Internship</title>
    <link rel="stylesheet" href="AdminInternship.css">
</head>
<body>

<header>
    <h1>Admin - จัดการประสบการณ์ฝึกงาน</h1>
</header>

<section class="admin-container">

<!-- ================= FORM ================= -->
<form action="<?= $editMode ? 'update_intern.php' : 'save_intern.php' ?>" 
      method="POST" 
      enctype="multipart/form-data">

    <?php if($editMode): ?>
        <input type="hidden" name="id" value="<?= $editData['id'] ?>">
    <?php endif; ?>

    <input type="text" 
           name="company" 
           placeholder="ชื่อบริษัท"
           value="<?= $editMode ? htmlspecialchars($editData['company']) : '' ?>"
           required>

    <input type="text" 
           name="position" 
           placeholder="ตำแหน่ง"
           value="<?= $editMode ? htmlspecialchars($editData['position']) : '' ?>"
           required>

    <input type="text" 
           name="date_range" 
           placeholder="ช่วงเวลา"
           value="<?= $editMode ? htmlspecialchars($editData['date_range']) : '' ?>"
           required>

    <input type="file" name="image" <?= $editMode ? '' : 'required' ?>>

    <textarea name="details" placeholder="รายละเอียด (คั่นด้วย , )" required><?= 
        $editMode ? htmlspecialchars($editData['details']) : '' 
    ?></textarea>

    <button type="submit">
        <?= $editMode ? 'อัปเดตข้อมูล' : 'บันทึก' ?>
    </button>

</form>

<h2>รายการทั้งหมด</h2>

<!-- ================= LIST ================= -->
<?php while($row = $result->fetch_assoc()): ?>
    <div class="item">
        <strong><?= htmlspecialchars($row['company']) ?></strong><br>
        <?= htmlspecialchars($row['position']) ?><br>
        <img src="uploads/<?= $row['image'] ?>" width="120"><br><br>

        <!-- ปุ่มแก้ไข -->
        <a href="AdminInternship.php?edit=<?= $row['id'] ?>">
            <button style="background:#007bff;">แก้ไข</button>
        </a>

        <!-- ปุ่มลบ -->
        <form action="delete_intern.php" method="POST" style="display:inline;">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <button style="background:red;">ลบ</button>
        </form>
    </div>
<?php endwhile; ?>

</section>

</body>
</html>