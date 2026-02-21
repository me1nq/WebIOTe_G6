<?php
require_once 'db.php';

// --- เพิ่มข้อมูล (Add) ---
if (isset($_POST['add_project'])) {
    $project_name = $conn->real_escape_string($_POST['project_name']);
    
    $img_name = time() . '_' . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $img_name);

    $pdf_name = time() . '_' . $_FILES['pdf']['name'];
    move_uploaded_file($_FILES['pdf']['tmp_name'], "uploads/pdfs/" . $pdf_name);

    $sql = "INSERT INTO projects (project_name, image_file, pdf_file) VALUES ('$project_name', '$img_name', '$pdf_name')";
    if($conn->query($sql)){
        echo "<script>alert('เพิ่มโปรเจคสำเร็จ!'); window.location='admin.php';</script>";
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
    echo "<script>alert('ลบข้อมูลเรียบร้อย'); window.location='admin.php';</script>";
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
            --primary-orange: #f39c12;
            --primary-dark: #1a1a1a;
            --bg-gray: #f5f6fa;
            --text-dark: #333;
        }
        
        * { box-sizing: border-box; font-family: 'Kanit', sans-serif; }
        body { padding: 30px 20px; background-color: var(--bg-gray); margin: 0; color: var(--text-dark); }
        
        .container { 
            max-width: 1000px; margin: 0 auto; background: white; padding: 40px; 
            border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
        }
        
        h2, h3 { color: var(--primary-dark); font-weight: 600; }
        h2 { margin-bottom: 0; font-size: 1.8rem; }
        h3 { margin-top: 0; font-size: 1.3rem; }

        .top-bar { 
            display: flex; justify-content: space-between; align-items: center; 
            margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px solid #f0f0f0; 
        }
        .back-link { color: #777; text-decoration: none; font-weight: 500; transition: color 0.3s; }
        .back-link:hover { color: var(--primary-orange); }
        
        .form-box { 
            background: #fafafa; padding: 30px; border-radius: 12px; margin-bottom: 40px; 
            border: 1px solid #eee;
        }
        
        label { font-weight: 500; margin-bottom: 8px; display: block; color: var(--text-dark); }
        input[type="text"], input[type="file"] { 
            width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ddd; 
            border-radius: 8px; transition: border-color 0.3s; background: white;
        }
        input[type="text"]:focus, input[type="file"]:focus { border-color: var(--primary-orange); outline: none; }
        
        /* สไตล์ปุ่มกด */
        .btn { 
            padding: 10px 18px; border: none; border-radius: 8px; cursor: pointer; 
            color: white; text-align: center; text-decoration: none; display: inline-block; 
            font-weight: 500; transition: all 0.3s ease; 
        }
        
        /* ปุ่มบันทึกข้อมูล (ส้มไล่เฉด) */
        .btn-add { 
            background: linear-gradient(135deg, #fbc531, #f39c12);
            width: 100%; 
            font-size: 1.1rem; 
            padding: 12px;
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
            color: white;
            border-radius: 8px;
        }
        .btn-add:hover { 
            background: linear-gradient(135deg, #f39c12, #e67e22);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(243, 156, 18, 0.4);
        }
        
        /* ปุ่มในตาราง */
        .btn-edit { background: var(--primary-orange); font-size: 0.9rem; padding: 8px 16px; margin-right: 5px; }
        .btn-edit:hover { background: #d35400; }
        .btn-del { background: #e74c3c; font-size: 0.9rem; padding: 8px 16px; }
        .btn-del:hover { background: #c0392b; }

        /* ตาราง */
        .table-responsive { overflow-x: auto; border-radius: 12px; border: 1px solid #f0f0f0; }
        table { width: 100%; border-collapse: collapse; min-width: 600px; background: white; }
        th, td { padding: 15px; text-align: left; vertical-align: middle; }
        th { background: #fafafa; color: var(--text-dark); font-weight: 600; border-bottom: 2px solid #eee; }
        tr:not(:last-child) td { border-bottom: 1px solid #f0f0f0; }
        
        @media (max-width: 600px) {
            .container { padding: 20px; }
            .form-box { padding: 20px; }
            .top-bar { flex-direction: column; align-items: flex-start; gap: 15px; }
        }
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
        <br>
        <form method="post" enctype="multipart/form-data">
            <label>ชื่อโครงงาน:</label>
            <input type="text" name="project_name" required placeholder="กรอกชื่อโครงงาน...">
            
            <label>รูปภาพปก (Image):</label>
            <input type="file" name="image" accept="image/*" required>
            
            <label>ไฟล์เอกสาร (PDF):</label>
            <input type="file" name="pdf" accept=".pdf" required>
            
            <button type="submit" name="add_project" class="btn btn-add">บันทึกข้อมูล</button>
        </form>
    </div>

    <h3 style="margin-bottom: 20px;">รายการทั้งหมด</h3>
    <div class="table-responsive">
        <table>
            <tr>
                <th width="50">ID</th>
                <th width="120">รูปภาพ</th>
                <th>ชื่อโครงงาน</th>
                <th width="180">จัดการ</th>
            </tr>
            <?php
            $res = $conn->query("SELECT * FROM projects ORDER BY id DESC");
            while ($row = $res->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td><img src='uploads/images/" . $row['image_file'] . "' width='80' style='border-radius:6px; object-fit:cover; box-shadow: 0 2px 5px rgba(0,0,0,0.1);'></td>";
                echo "<td style='font-weight:500;'>" . htmlspecialchars($row['project_name']) . "</td>";
                echo "<td>
                        <a href='edit.php?id=" . $row['id'] . "' class='btn btn-edit'>แก้ไข</a>
                        <a href='admin.php?delete=" . $row['id'] . "' class='btn btn-del' onclick=\"return confirm('ยืนยันการลบโปรเจคนี้?');\">ลบ</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>