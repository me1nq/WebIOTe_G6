<?php
require 'db.php';

// 1. รับ ID ของอาจารย์ที่ต้องการแก้ไข
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // ดึงข้อมูลเดิมจาก Database มาแสดงในฟอร์ม
    $sql_select = "SELECT * FROM personnel WHERE id = $id";
    $result = $conn->query($sql_select);
    
    // ถ้าไม่เจอข้อมูล ให้กลับไปหน้า admin
    if ($result->num_rows == 0) {
        header("Location: admin.php");
        exit;
    }
    
    $row = $result->fetch_assoc();
} else {
    // ถ้าไม่มีการส่ง ID มา ให้เตะกลับไปหน้า admin
    header("Location: admin.php");
    exit;
}

// 2. จัดการเมื่อมีการกดปุ่ม "บันทึกการแก้ไข"
if (isset($_POST['submit_update'])) {
    $type = $conn->real_escape_string($_POST['type']);
    $program = $conn->real_escape_string($_POST['program']);
    $name = $conn->real_escape_string($_POST['name']);
    $role = $conn->real_escape_string($_POST['role']);
    $popup_role = $conn->real_escape_string($_POST['popup_role']);
    $history = $conn->real_escape_string($_POST['history']);
    
    // ตั้งค่ารูปภาพเริ่มต้นเป็น "รูปเดิม" จาก Database
    $image_path = $row['image']; 

    // ระบบจัดการไฟล์อัปโหลด (ถ้ามีการอัปโหลดรูปใหม่มา)
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "images/"; 
        $file_extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $new_file_name = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_file_name;

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            // ถ้าย้ายไฟล์ใหม่สำเร็จ
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                
                // เลือกลบรูปเก่าทิ้ง (เพื่อประหยัดพื้นที่เซิร์ฟเวอร์) **ถ้าไม่ใช่รูป default.png**
                if($image_path != 'images/default.png' && file_exists($image_path)) {
                    unlink($image_path); 
                }

                $image_path = $target_file; // อัปเดต Path เป็นรูปใหม่เตรียมลง Database
            } else {
                echo "<script>alert('เกิดข้อผิดพลาดในการเซฟไฟล์รูปลงเซิร์ฟเวอร์');</script>";
            }
        } else {
            echo "<script>alert('ไฟล์ที่อัปโหลดไม่ใช่รูปภาพ!');</script>";
        }
    }

    // คำสั่ง SQL สำหรับ Update (ใช้ $image_path ที่อัปเดตแล้ว)
    $sql_update = "UPDATE personnel SET 
                   type = '$type', 
                   program = '$program', 
                   name = '$name', 
                   role = '$role', 
                   popup_role = '$popup_role', 
                   history = '$history', 
                   image = '$image_path' 
                   WHERE id = $id";
    
    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('อัปเดตข้อมูลสำเร็จ'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูล - Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        /* สไตล์หลักให้เหมือนหน้า admin เป๊ะๆ */
        body { 
            font-family: 'Kanit', sans-serif; 
            background-color: #f5f6fa; 
            padding: 20px; 
            font-weight: 300;
        }
        
        h2, h3, label, strong { font-weight: 500; }

        .admin-container { max-width: 800px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        
        /* บังคับฟอนต์และสไตล์ช่องกรอกข้อมูล */
        .form-group input[type="text"], .form-group select, .form-group textarea { 
            font-family: 'Kanit', sans-serif;
            width: 100%; 
            padding: 8px; 
            box-sizing: border-box; 
            border: 1px solid #ccc; 
            border-radius: 4px; 
        }
        
        .btn { font-family: 'Kanit', sans-serif; font-weight: 400; padding: 10px 15px; background: #09c953; color: white; border: none; cursor: pointer; border-radius: 5px; font-size: 1rem; }
        .btn-cancel { font-family: 'Kanit', sans-serif; font-weight: 400; background: #6c757d; text-decoration: none; padding: 10px 15px; color: white; border-radius: 5px; display: inline-block; margin-left: 10px; }
        
        /* สไตล์กล่องอัปโหลดรูป */
        .file-upload-box {
            border: 2px dashed #999;
            padding: 20px;
            text-align: center;
            background-color: #fdfdfd;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .file-upload-box:hover {
            background-color: #f1f1f1;
            border-color: #007bff;
        }
        .file-upload-box input[type="file"] {
            display: block;
            margin: 10px auto;
            cursor: pointer;
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>
<body>

<div class="admin-container">
    <h2>แก้ไขข้อมูลบุคลากร</h2>
    
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label>ประเภทบุคลากร:</label>
            <select name="type" required>
                <option value="faculty" <?php echo ($row['type'] == 'faculty') ? 'selected' : ''; ?>>คณาจารย์ (Faculty)</option>
                <option value="staff" <?php echo ($row['type'] == 'staff') ? 'selected' : ''; ?>>บุคลากรสายสนับสนุน (Staff)</option>
            </select>
        </div>
        <div class="form-group">
            <label>หลักสูตร / สังกัด:</label>
            <select name="program" required>
                <option value="iot" <?php echo ($row['program'] == 'iot') ? 'selected' : ''; ?>>วิศวกรรมไอโอที (IoT)</option>
                <option value="science" <?php echo ($row['program'] == 'science') ? 'selected' : ''; ?>>วิทยาศาสตร์ (Science) - 2 ปริญญา</option>
                <option value="other" <?php echo ($row['program'] == 'other') ? 'selected' : ''; ?>>หลักสูตรอื่นๆ</option>
            </select>
        </div>
        <div class="form-group">
            <label>ชื่อ-นามสกุล:</label>
            <input type="text" name="name" required value="<?php echo htmlspecialchars($row['name']); ?>">
        </div>
        
        <div class="form-group">
            <label>ตำแหน่ง (โชว์ในการ์ดหน้าแรก):</label>
            <input type="text" name="role" required value="<?php echo htmlspecialchars($row['role']); ?>">
        </div>
        <div class="form-group">
            <label>ตำแหน่ง (โชว์ใน Pop-up):</label>
            <input type="text" name="popup_role" value="<?php echo htmlspecialchars($row['popup_role'] ?? ''); ?>" placeholder="เช่น อาจารย์ประจำหลักสูตร">
        </div>

        <div class="form-group">
            <label>ประวัติความเชี่ยวชาญ:</label>
            <textarea name="history" rows="4" required><?php echo htmlspecialchars($row['history']); ?></textarea>
        </div>
        
        <div style="margin-bottom: 15px; background: #f9f9f9; padding: 15px; border-radius: 5px; text-align: center;">
            <p style="margin: 0 0 10px 0; font-weight: 500;">รูปปัจจุบัน:</p>
            <img src="<?php echo htmlspecialchars($row['image']); ?>" width="120" style="object-fit: cover; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);" onerror="this.src=''; this.style.backgroundColor='#66ff33';">
        </div>

        <div class="form-group">
            <label>เปลี่ยนรูปโปรไฟล์ใหม่ (ปล่อยว่างไว้ถ้าต้องการใช้รูปเดิม):</label>
            <div class="file-upload-box">
                <p style="margin: 0; color: #555;">ลากไฟล์รูปใหม่มาวางที่นี่ หรือคลิกเพื่อเลือกไฟล์</p>
                <input type="file" name="image" accept="image/jpeg, image/png, image/webp">
            </div>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" name="submit_update" class="btn">บันทึกการเปลี่ยนแปลง</button>
            <a href="admin.php" class="btn-cancel">ยกเลิก</a>
        </div>
    </form>
</div>

</body>
</html>