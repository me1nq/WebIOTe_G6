<?php
require_once 'db.php';

// ใช้ SweetAlert2 สำหรับแจ้งเตือน
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

// --- เพิ่มข้อมูล (Add) ---
if (isset($_POST['add_project'])) {
    $project_name = $conn->real_escape_string($_POST['project_name']);
    
    $img_name = time() . '_' . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $img_name);

    $pdf_name = time() . '_' . $_FILES['pdf']['name'];
    move_uploaded_file($_FILES['pdf']['tmp_name'], "uploads/pdfs/" . $pdf_name);

    $sql = "INSERT INTO projects (project_name, image_file, pdf_file) VALUES ('$project_name', '$img_name', '$pdf_name')";
    if($conn->query($sql)){
        echo "<script>
            setTimeout(function() {
                Swal.fire({
                    title: 'สำเร็จ',
                    text: 'เพิ่มโปรเจคเรียบร้อยแล้ว',
                    icon: 'success',
                    confirmButtonColor: '#FF6F00'
                }).then(() => { window.location='admin.php'; });
            }, 100);
        </script>";
    }
}

// --- ลบข้อมูล (Delete) ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $res = $conn->query("SELECT image_file, pdf_file FROM projects WHERE id=$id");
    $row = $res->fetch_assoc();
    if($row) {
        if(file_exists("uploads/images/" . $row['image_file'])) unlink("uploads/images/" . $row['image_file']);
        if(file_exists("uploads/pdfs/" . $row['pdf_file'])) unlink("uploads/pdfs/" . $row['pdf_file']);
    }
    $conn->query("DELETE FROM projects WHERE id=$id");
    echo "<script>
        setTimeout(function() {
            Swal.fire({
                title: 'สำเร็จ',
                text: 'ลบข้อมูลเรียบร้อย',
                icon: 'success',
                confirmButtonColor: '#FF6F00'
            }).then(() => { window.location='admin.php'; });
        }, 100);
    </script>";
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจัดการแอดมิน</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-orange: #FF6F00; /* เปลี่ยนสีตามสั่ง */
            --primary-dark: #1a1a1a;
            --bg-gray: #f5f6fa;
            --text-dark: #333;
        }
        
        * { box-sizing: border-box; font-family: 'Kanit', sans-serif; }
        body { padding: 30px 20px; background-color: var(--bg-gray); margin: 0; color: var(--text-dark); }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px solid #f0f0f0; }
        .back-link { color: #777; text-decoration: none; font-weight: 500; transition: 0.3s; }
        .back-link:hover { color: var(--primary-orange); }
        .form-box { background: #fafafa; padding: 30px; border-radius: 12px; margin-bottom: 40px; border: 1px solid #eee; }
        input[type="text"], input[type="file"] { width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .btn-add { background: var(--primary-orange); width: 100%; padding: 12px; color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 1.1rem; }
        .btn-edit { background: #2ecc71; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; margin-right: 5px; }
        .btn-del { background: #e74c3c; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #fdfdfd; }
    </style>
</head>
<body>
<div class="container">
    <div class="top-bar">
        <h2>จัดการโปรเจค</h2>
        <a href="index.php" class="back-link"><i class="fa-solid fa-arrow-left"></i> กลับหน้าหลัก</a>
    </div>

    <div class="form-box">
        <h3>+ เพิ่มโปรเจคใหม่</h3>
        <form method="post" enctype="multipart/form-data">
            <label>ชื่อโครงงาน:</label>
            <input type="text" name="project_name" required placeholder="กรอกชื่อโครงงาน...">
            <label>รูปภาพปก:</label>
            <input type="file" name="image" accept="image/*" required>
            <label>ไฟล์ PDF:</label>
            <input type="file" name="pdf" accept=".pdf" required>
            <button type="submit" name="add_project" class="btn-add">บันทึกข้อมูล</button>
        </form>
    </div>

    <h3>รายการทั้งหมด</h3>
    <div style="overflow-x:auto;">
        <table>
            <tr>
                <th width="120">รูปภาพ</th>
                <th>ชื่อโครงงาน</th>
                <th width="180">จัดการ</th>
            </tr>
            <?php
            $res = $conn->query("SELECT * FROM projects ORDER BY id DESC");
            while ($row = $res->fetch_assoc()) {
                echo "<tr>";
                echo "<td><img src='uploads/images/" . $row['image_file'] . "' width='80' style='border-radius:6px;'></td>";
                echo "<td>" . htmlspecialchars($row['project_name']) . "</td>";
                echo "<td>
                        <a href='edit.php?id=" . $row['id'] . "' class='btn btn-edit'>แก้ไข</a>
                        <a href='#' onclick=\"confirmDelete(" . $row['id'] . ")\" class='btn btn-del'>ลบ</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'ยืนยันการลบ?',
        text: "คุณจะไม่สามารถกู้คืนข้อมูลนี้ได้!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#FF6F00',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่, ลบเลย!',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'admin.php?delete=' + id;
        }
    })
}
</script>
</body>
</html>