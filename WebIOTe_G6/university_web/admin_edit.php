<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_select = "SELECT * FROM personnel WHERE id = $id";
    $result = $conn->query($sql_select);
    if ($result->num_rows == 0) {
        header("Location: admin.php");
        exit;
    }
    $row = $result->fetch_assoc();
} else {
    header("Location: admin.php");
    exit;
}

if (isset($_POST['submit_update'])) {
    $type = $conn->real_escape_string($_POST['type']);
    $program = $conn->real_escape_string($_POST['program']);
    $name = $conn->real_escape_string($_POST['name']);
    $role = $conn->real_escape_string($_POST['role']);
    $popup_role = $conn->real_escape_string($_POST['popup_role']);
    $history = $conn->real_escape_string($_POST['history']);
    
    $research = $conn->real_escape_string($_POST['research']);
    $research_link = $conn->real_escape_string($_POST['research_link']);
    
    $image_path = $row['image']; 
    $research_image_path = $row['research_image']; 

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "images/"; 
        $file_extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $new_file_name = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_file_name;

        if(getimagesize($_FILES["image"]["tmp_name"]) !== false) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                if($image_path != 'images/default.png' && file_exists($image_path)) {
                    unlink($image_path); 
                }
                $image_path = $target_file; 
            }
        }
    }

    if (isset($_FILES['research_image']) && $_FILES['research_image']['error'] == 0) {
        $target_dir = "images/"; 
        $file_extension = strtolower(pathinfo($_FILES["research_image"]["name"], PATHINFO_EXTENSION));
        $new_research_file_name = 'research_' . uniqid() . '.' . $file_extension;
        $target_research_file = $target_dir . $new_research_file_name;

        if(getimagesize($_FILES["research_image"]["tmp_name"]) !== false) {
            if (move_uploaded_file($_FILES["research_image"]["tmp_name"], $target_research_file)) {
                if(!empty($research_image_path) && file_exists($research_image_path)) {
                    unlink($research_image_path); 
                }
                $research_image_path = $target_research_file; 
            }
        }
    }

    $sql_update = "UPDATE personnel SET 
                   type = '$type', 
                   program = '$program', 
                   name = '$name', 
                   role = '$role', 
                   popup_role = '$popup_role', 
                   history = '$history', 
                   research = '$research',
                   research_link = '$research_link',
                   research_image = '$research_image_path',
                   image = '$image_path' 
                   WHERE id = $id";
    
    if ($conn->query($sql_update) === TRUE) {
        // 🚨 เรียกใช้ SweetAlert2 ตอนอัปเดตสำเร็จ
        echo "<!DOCTYPE html><html><head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script><link href='https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap' rel='stylesheet'><style>*{font-family:\"Kanit\", sans-serif;}</style></head><body><script>Swal.fire({icon: 'success', title: 'สำเร็จ', text: 'บันทึกแล้ว', confirmButtonColor: '#7b68ee', confirmButtonText: 'OK'}).then(() => { window.location.href = 'admin.php'; });</script></body></html>";
        exit;
    } else {
        echo "<!DOCTYPE html><html><head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script><link href='https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap' rel='stylesheet'><style>*{font-family:\"Kanit\", sans-serif;}</style></head><body><script>Swal.fire({icon: 'error', title: 'ผิดพลาด', text: '" . $conn->error . "', confirmButtonColor: '#dc3545'}).then(() => { window.history.back(); });</script></body></html>";
        exit;
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
        body { font-family: 'Kanit', sans-serif; background-color: #f5f6fa; padding: 20px; font-weight: 300; }
        h2, h3, label, strong { font-weight: 500; }
        .admin-container { max-width: 800px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input[type="text"], .form-group select, .form-group textarea { 
            font-family: 'Kanit', sans-serif; width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; 
        }
        .btn { font-family: 'Kanit', sans-serif; font-weight: 400; padding: 10px 15px; background: #09c953; color: white; border: none; cursor: pointer; border-radius: 5px; font-size: 1rem; }
        .btn-cancel { font-family: 'Kanit', sans-serif; font-weight: 400; background: #6c757d; text-decoration: none; padding: 10px 15px; color: white; border-radius: 5px; display: inline-block; margin-left: 10px; }
        
        .file-upload-box {
            border: 2px dashed #999; padding: 20px; text-align: center; background-color: #fdfdfd; border-radius: 8px; cursor: pointer; transition: background 0.3s;
        }
        .file-upload-box:hover { background-color: #f1f1f1; border-color: #007bff; }
        .file-upload-box input[type="file"] { display: block; margin: 10px auto; cursor: pointer; font-family: 'Kanit', sans-serif; }
        .research-section { background-color: #fff3e0; padding: 15px; border-radius: 8px; border: 1px solid #ffe0b2; margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="admin-container">
    <h2>✏️ แก้ไขข้อมูลบุคลากร</h2>
    
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

        <div class="research-section">
            <h4 style="margin-top: 0; color: #FF6F00;">📚 ส่วนข้อมูลงานวิจัย (ถ้ามี)</h4>
            <div class="form-group">
                <label>ชื่องานวิจัย / คำอธิบาย:</label>
                <textarea name="research" rows="3" placeholder="เช่น พัฒนาระบบ IoT สำหรับสมาร์ทฟาร์ม..."><?php echo htmlspecialchars($row['research'] ?? ''); ?></textarea>
            </div>
            <div class="form-group">
                <label>ลิงก์ไปยังงานวิจัย (URL):</label>
                <input type="text" name="research_link" value="<?php echo htmlspecialchars($row['research_link'] ?? ''); ?>" placeholder="เช่น https://www.researchgate.net/...">
            </div>
            
            <?php if(!empty($row['research_image'])): ?>
            <div style="margin-bottom: 10px; text-align: center;">
                <p style="margin: 0 0 5px 0; font-size: 0.9rem; color: #555;">รูปปกวิจัยปัจจุบัน:</p>
                <img src="<?php echo htmlspecialchars($row['research_image']); ?>" width="100" style="object-fit: contain; border: 1px solid #ccc; background: #fff;">
            </div>
            <?php endif; ?>

            <div class="form-group">
                <label>เปลี่ยนรูปหน้าปกงานวิจัย (ปล่อยว่างถ้าใช้รูปเดิม):</label>
                <div class="file-upload-box" style="border-color: #FF6F00; padding: 15px;">
                    <input type="file" name="research_image" accept="image/jpeg, image/png, image/webp">
                </div>
            </div>
        </div>
        
        <hr style="border: 0; height: 1px; background: #eee; margin: 20px 0;">

        <div style="margin-bottom: 15px; background: #f9f9f9; padding: 15px; border-radius: 5px; text-align: center;">
            <p style="margin: 0 0 10px 0; font-weight: 500;">📷 รูปโปรไฟล์ปัจจุบัน:</p>
            <img src="<?php echo htmlspecialchars($row['image']); ?>" width="120" style="object-fit: cover; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);" onerror="this.src=''; this.style.backgroundColor='#66ff33';">
        </div>

        <div class="form-group">
            <label>เปลี่ยนรูปโปรไฟล์ใหม่ (ปล่อยว่างถ้าใช้รูปเดิม):</label>
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