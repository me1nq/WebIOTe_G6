<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$editMode = false;
$editData = null;

if(isset($_GET['edit'])){
    $editMode = true;
    $id = intval($_GET['edit']);
    $res = $conn->query("SELECT * FROM internships WHERE id=$id");
    $editData = $res->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>จัดการประสบการณ์ฝึกงาน | Admin</title>
    <link rel="stylesheet" href="../css/admin_style.css"> <link rel="stylesheet" href="../css/admin_sidebar.css">
</head>
<body>

<?php include 'sidebar.php'; ?> <div class="admin-main-content">
    <div class="admin-container">
        
        <div class="top-panel">
            <div class="top-header">
                <h3>จัดการประสบการณ์ฝึกงาน</h3>
            </div>
        </div>

        <div class="main-editor">
            <h3 style="margin-top:0; border-bottom: 1px solid #eee; padding-bottom: 15px;">
                <?php echo $editMode ? 'แก้ไขข้อมูล' : '+ เพิ่มประสบการณ์ใหม่'; ?>
            </h3>
            <form action="<?php echo $editMode ? 'update_intern.php' : 'save_intern.php'; ?>" method="POST" enctype="multipart/form-data">
                <?php if($editMode): ?>
                    <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label>ชื่อบริษัท</label>
                    <input type="text" name="company" value="<?php echo $editMode ? htmlspecialchars($editData['company']) : ''; ?>" required>
                </div>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px;">
                    <div class="form-group">
                        <label>ตำแหน่ง</label>
                        <input type="text" name="position" value="<?php echo $editMode ? htmlspecialchars($editData['position']) : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>ช่วงเวลา</label>
                        <input type="text" name="date_range" value="<?php echo $editMode ? htmlspecialchars($editData['date_range']) : ''; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>รูปภาพโลโก้บริษัท</label>
                    <input type="file" name="image" <?php echo $editMode ? '' : 'required'; ?>>
                </div>

                <div class="form-group">
                    <label>รายละเอียด (ใช้คอมม่า , คั่นเพื่อแยกหัวข้อบรรทัด)</label>
                    <textarea name="details" rows="4" required><?php echo $editMode ? htmlspecialchars($editData['details']) : ''; ?></textarea>
                </div>

                <button type="submit" class="btn btn-add" style="width:100%;">
                    <?php echo $editMode ? 'อัปเดตข้อมูล' : 'บันทึกข้อมูล'; ?>
                </button>
            </form>
        </div>

        <div class="main-editor">
            <table>
                <thead>
                    <tr>
                        <th>รูป</th>
                        <th>บริษัท</th>
                        <th>ตำแหน่ง</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $result = $conn->query("SELECT * FROM internships ORDER BY id DESC");
                    while($row = $result->fetch_assoc()): 
                    ?>
                    <tr>
                        <td><img src="../assets/internship/<?php echo $row['image']; ?>" width="60" style="border-radius:8px;"></td>
                        <td><strong><?php echo htmlspecialchars($row['company']); ?></strong></td>
                        <td><?php echo htmlspecialchars($row['position']); ?></td>
                        <td style="text-align: center;">
                            <a href="admin_internship.php?edit=<?php echo $row['id']; ?>" class="btn btn-edit" style="text-decoration: none;">แก้ไข</a>

                            <form action="delete_intern.php" method="POST" style="display: inline-block; margin: 0;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('มึงแน่ใจนะว่าจะลบข้อมูลฝึกงานนี้?')">ลบ</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

</body>
</html>