<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) { header("Location: admin_projects.php"); exit(); }
$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM projects WHERE id = $id");
$row = mysqli_fetch_assoc($res);

$update_success = false;

if (isset($_POST['update_project'])) {
    $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
    $update_sql = "UPDATE projects SET project_name = '$project_name'";
    
    $img_dir = "../assets/projects/images/";
    $pdf_dir = "../assets/projects/pdfs/";

    if (!empty($_FILES['image']['name'])) {
        if(file_exists($img_dir . $row['image_file'])) unlink($img_dir . $row['image_file']);
        $new_img = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $img_dir . $new_img);
        $update_sql .= ", image_file = '$new_img'";
    }
    
    if (!empty($_FILES['pdf']['name'])) {
        if(file_exists($pdf_dir . $row['pdf_file'])) unlink($pdf_dir . $row['pdf_file']);
        $new_pdf = time() . '_' . $_FILES['pdf']['name'];
        move_uploaded_file($_FILES['pdf']['tmp_name'], $pdf_dir . $new_pdf);
        $update_sql .= ", pdf_file = '$new_pdf'";
    }
    
    $update_sql .= " WHERE id = $id";
    if (mysqli_query($conn, $update_sql)) { 
        $update_success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขโปรเจค | Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/admin_sidebar.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="admin-main-content">
    <div class="admin-container" style="max-width: 800px;">
        
        <div class="top-panel">
            <div class="top-header">
                <h3><i class="fa-solid fa-pen-to-square"></i> แก้ไขข้อมูลโปรเจค</h3>
            </div>
        </div>

        <div class="main-editor">
            <form method="post" enctype="multipart/form-data" class="form-group">
                <div class="form-group">
                    <label>ชื่อโครงงาน :</label>
                    <input type="text" name="project_name" value="<?php echo htmlspecialchars($row['project_name']); ?>" required>
                </div>

                <div class="form-group">
                    <label>เปลี่ยนรูปภาพหน้าปก <span style="color: #FF6F00; font-size:0.85rem;">(ถ้าไม่เปลี่ยนให้เว้นว่าง)</span></label>
                    <input type="file" name="image" accept="image/*">
                    <div style="margin-top: 10px; background: #fff3e6; padding: 10px; border-radius: 8px; display: flex; align-items: center; gap: 15px;">
                        <img src="../assets/projects/images/<?php echo $row['image_file']; ?>" style="height: 50px; border-radius: 4px; border: 1px solid #ddd;">
                        <span style="font-size: 0.9rem; color: #666;">รูปภาพปัจจุบัน</span>
                    </div>
                </div>

                <div class="form-group">
                    <label>เปลี่ยนไฟล์เอกสาร (PDF) <span style="color: #FF6F00; font-size:0.85rem;">(ถ้าไม่เปลี่ยนให้เว้นว่าง)</span></label>
                    <input type="file" name="pdf" accept=".pdf">
                    <div style="margin-top: 10px; background: #f0f0f0; padding: 10px; border-radius: 8px;">
                        <i class="fa-regular fa-file-pdf" style="color: #dc3545;"></i> 
                        <span style="font-size: 0.9rem; color: #666;">ไฟล์ปัจจุบัน: <strong><?php echo htmlspecialchars($row['pdf_file']); ?></strong></span>
                    </div>
                </div>

                <div style="display: flex; gap: 10px; margin-top: 30px;">
                    <button type="submit" name="update_project" class="btn btn-save" style="flex: 2;">บันทึกการแก้ไข</button>
                    <a href="admin_projects.php" class="btn" style="flex: 1; background: #eee; color: #555; text-align: center; text-decoration: none;">ยกเลิก</a>
                </div>
            </form>
        </div>

    </div>
</div>

<?php if($update_success): ?>
    <script>
        Swal.fire({
            title: 'อัปเดตสำเร็จ!',
            text: 'ข้อมูลโปรเจคถูกบันทึกเรียบร้อยแล้ว',
            icon: 'success',
            confirmButtonColor: '#FF6F00'
        }).then(() => { window.location = 'admin_projects.php'; });
    </script>
<?php endif; ?>

</body>
</html>