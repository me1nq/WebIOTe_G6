<?php
session_start();
include '../includes/db.php'; // ปรับ Path ให้เหมือน admin_index.php

// เช็คสิทธิ์ Admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

// --- ส่วนเพิ่มโปรเจค ---
if (isset($_POST['add_project'])) {
    $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
    
    // สร้างโฟลเดอร์ถ้ายังไม่มี
    $img_dir = "../assets/projects/images/";
    $pdf_dir = "../assets/projects/pdfs/";
    if (!file_exists($img_dir)) mkdir($img_dir, 0777, true);
    if (!file_exists($pdf_dir)) mkdir($pdf_dir, 0777, true);

    $img_name = time() . '_' . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $img_dir . $img_name);

    $pdf_name = time() . '_' . $_FILES['pdf']['name'];
    move_uploaded_file($_FILES['pdf']['tmp_name'], $pdf_dir . $pdf_name);

    $sql = "INSERT INTO projects (project_name, image_file, pdf_file) VALUES ('$project_name', '$img_name', '$pdf_name')";
    if(mysqli_query($conn, $sql)){
        $msg = "เพิ่มโปรเจคเรียบร้อยแล้ว";
    }
}

// --- ส่วนลบโปรเจค ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $res = mysqli_query($conn, "SELECT image_file, pdf_file FROM projects WHERE id=$id");
    $row = mysqli_fetch_assoc($res);
    if($row) {
        if(file_exists("../assets/projects/images/" . $row['image_file'])) unlink("../assets/projects/images/" . $row['image_file']);
        if(file_exists("../assets/projects/pdfs/" . $row['pdf_file'])) unlink("../assets/projects/pdfs/" . $row['pdf_file']);
    }
    mysqli_query($conn, "DELETE FROM projects WHERE id=$id");
    $msg = "ลบข้อมูลเรียบร้อย";
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>จัดการคลังความรู้ | Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/admin_sidebar.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="admin-main-content">
    <div class="admin-container">
        
        <div class="top-panel">
            <div class="top-header">
                <h3>จัดการคลังความรู้ (Projects Inventory)</h3>
            </div>
        </div>

        <?php if(isset($msg)): ?>
            <div class="alert-success" style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid #28a745;">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>

        <div class="main-editor">
            <h3 style="margin-top:0; border-bottom: 1px solid #eee; padding-bottom: 15px; color:#4a4a4a;">+ เพิ่มหัวข้อใหม่</h3>
            <form method="post" enctype="multipart/form-data" class="form-group">
                <div style="margin-bottom: 15px;">
                    <label>ชื่อหัวข้อโปรเจค :</label>
                    <input type="text" name="project_name" required placeholder="กรอกชื่อโครงงาน...">
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
                    <div>
                        <label>รูปภาพปก :</label>
                        <input type="file" name="image" accept="image/*" required>
                    </div>
                    <div>
                        <label>ไฟล์เอกสาร (PDF) :</label>
                        <input type="file" name="pdf" accept=".pdf" required>
                    </div>
                </div>
                <button type="submit" name="add_project" class="btn btn-add" style="width: 100%;">บันทึกข้อมูลโปรเจค</button>
            </form>
        </div>

        <div class="main-editor">
            <h3 style="margin-top:0; border-bottom: 1px solid #eee; padding-bottom: 15px; color:#4a4a4a;">รายการโปรเจคทั้งหมด</h3>
            <div class="table-container" style="padding:0; box-shadow:none;">
                <table>
                    <thead>
                        <tr>
                            <th width="120">รูปภาพ</th>
                            <th>ชื่อโครงงาน</th>
                            <th width="180" style="text-align: center;">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $res = mysqli_query($conn, "SELECT * FROM projects ORDER BY id DESC");
                        while ($row = mysqli_fetch_assoc($res)):
                        ?>
                        <tr>
                            <td><img src="../assets/projects/images/<?php echo $row['image_file']; ?>" width="80" style="border-radius:6px; height: 50px; object-fit: cover;"></td>
                            <td><strong><?php echo htmlspecialchars($row['project_name']); ?></strong></td>
                            <td style="text-align: center;">
                                <a href="admin_projects_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-edit" style="text-decoration: none; padding: 6px 12px; font-size: 0.85rem;">แก้ไข</a>
                                <button onclick="confirmDelete(<?php echo $row['id']; ?>)" class="btn btn-danger" style="padding: 6px 12px; font-size: 0.85rem;">ลบ</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'ยืนยันการลบ?',
        text: "มึงจะไม่สามารถกู้คืนข้อมูลโปรเจคนี้ได้นะเว้ย!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#FF6F00',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'ใช่, ลบเลย!',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'admin_projects.php?delete=' + id;
        }
    })
}
</script>
</body>
</html>