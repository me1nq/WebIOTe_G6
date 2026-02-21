<?php
require_once 'db.php';

// ... (โค้ด PHP ส่วนเดิมทั้งหมด ไม่มีการเปลี่ยนแปลง Logic) ...
// ตรวจสอบ ID, ดึงข้อมูลเก่า, อัปเดตชื่อ, อัปเดตรูป, อัปเดต PDF
if (!isset($_GET['id'])) { header("Location: admin.php"); exit(); }
$id = $_GET['id'];
$sql = "SELECT * FROM projects WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (isset($_POST['update_project'])) {
    $project_name = $conn->real_escape_string($_POST['project_name']);
    $update_sql = "UPDATE projects SET project_name = '$project_name'";
    if (!empty($_FILES['image']['name'])) {
        if(file_exists("uploads/images/" . $row['image_file'])) { unlink("uploads/images/" . $row['image_file']); }
        $new_img = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $new_img);
        $update_sql .= ", image_file = '$new_img'";
    }
    if (!empty($_FILES['pdf']['name'])) {
        if(file_exists("uploads/pdfs/" . $row['pdf_file'])) { unlink("uploads/pdfs/" . $row['pdf_file']); }
        $new_pdf = time() . '_' . $_FILES['pdf']['name'];
        move_uploaded_file($_FILES['pdf']['tmp_name'], "uploads/pdfs/" . $new_pdf);
        $update_sql .= ", pdf_file = '$new_pdf'";
    }
    $update_sql .= " WHERE id = $id";
    if ($conn->query($update_sql) === TRUE) { echo "<script>alert('อัปเดตข้อมูลสำเร็จ!'); window.location='admin.php';</script>"; } else { echo "Error: " . $conn->error; }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลโปรเจค</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-orange: #f39c12;
            --bg-gray: #f5f6fa;
            --text-dark: #333;
        }
        * { box-sizing: border-box; font-family: 'Kanit', sans-serif; }
        body { padding: 30px 20px; background-color: var(--bg-gray); margin: 0; color: var(--text-dark); }
        
        .container { 
            max-width: 700px; margin: 0 auto; background: white; padding: 40px; 
            border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border-top: 5px solid var(--primary-orange);
        }
        
        h2 { text-align: center; margin-top: 0; color: var(--primary-orange); font-weight: 500; margin-bottom: 30px; }
        
        .form-group { margin-bottom: 25px; }
        label { display: block; margin-bottom: 10px; font-weight: 500; color: var(--text-dark); }
        input[type="text"], input[type="file"] { 
            width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; 
            transition: border-color 0.3s;
        }
        input[type="text"]:focus, input[type="file"]:focus { border-color: var(--primary-orange); outline: none; }
        
        .current-file { 
            font-size: 0.9rem; color: #666; margin-top: 10px; 
            background: #fff0d9; padding: 10px; border-radius: 8px; /* พื้นหลังสีส้มอ่อน */
            display: flex; align-items: center;
        }
        .current-file img { max-height: 50px; border-radius: 4px; margin-left: 15px; border: 1px solid #ddd; }
        .current-file strong { color: var(--primary-orange); margin-left: 5px; }
        
        .btn { padding: 12px; width: 100%; border: none; border-radius: 8px; cursor: pointer; font-size: 1.1rem; text-align: center; display: block; text-decoration: none; font-weight: 500; transition: all 0.3s; }
        .btn-save { 
            background: var(--primary-orange); color: white; margin-bottom: 15px; 
            box-shadow: 0 4px 10px rgba(243, 156, 18, 0.3);
        }
        .btn-save:hover { background: #d35400; transform: translateY(-2px); }
        .btn-cancel { background: #e0e0e0; color: #555; }
        .btn-cancel:hover { background: #d0d0d0; }
    </style>
</head>
<body>

<div class="container">
    <h2><i class="fa-solid fa-pen-to-square"></i> แก้ไขข้อมูลโปรเจค</h2>
    
    <form method="post" enctype="multipart/form-data">
        
        <div class="form-group">
            <label>ชื่อโครงงาน:</label>
            <input type="text" name="project_name" value="<?php echo htmlspecialchars($row['project_name']); ?>" required>
        </div>

        <div class="form-group">
            <label>เปลี่ยนรูปภาพหน้าปก <span style="color: var(--primary-orange); font-size:0.9rem;">(ถ้าไม่เปลี่ยนให้เว้นว่าง)</span></label>
            <input type="file" name="image" accept="image/*">
            <div class="current-file">
                <i class="fa-regular fa-image"></i> รูปปัจจุบัน: <img src="uploads/images/<?php echo $row['image_file']; ?>" alt="Current Image">
            </div>
        </div>

        <div class="form-group">
            <label>เปลี่ยนไฟล์เอกสาร (PDF) <span style="color: var(--primary-orange); font-size:0.9rem;">(ถ้าไม่เปลี่ยนให้เว้นว่าง)</span></label>
            <input type="file" name="pdf" accept=".pdf">
            <div class="current-file">
                <i class="fa-regular fa-file-pdf"></i> ไฟล์ปัจจุบัน: <strong><?php echo $row['pdf_file']; ?></strong>
            </div>
        </div>

        <button type="submit" name="update_project" class="btn btn-save">บันทึกการแก้ไข</button>
        <a href="admin.php" class="btn btn-cancel">ยกเลิก / กลับไปหน้าแอดมิน</a>
        
    </form>
</div>

</body>
</html>