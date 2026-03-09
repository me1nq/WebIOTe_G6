<?php
require '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_select = "SELECT * FROM personnel WHERE id = $id";
    $result = $conn->query($sql_select);
    if ($result->num_rows == 0) {
        header("Location: admin_faculty.php"); // 🚨
        exit;
    }
    $row = $result->fetch_assoc();
} else {
    header("Location: admin_faculty.php"); // 🚨
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
        $upload_dir = "../assets/faculty/"; 
        $db_path = "assets/faculty/"; 
        
        $file_extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $new_file_name = uniqid() . '.' . $file_extension;
        
        $target_upload = $upload_dir . $new_file_name;
        $target_db = $db_path . $new_file_name;

        if(getimagesize($_FILES["image"]["tmp_name"]) !== false) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_upload)) {
                if($image_path != 'assets/faculty/default.png' && file_exists("../" . $image_path)) {
                    unlink("../" . $image_path); 
                }
                $image_path = $target_db; 
            }
        }
    }

    if (isset($_FILES['research_image']) && $_FILES['research_image']['error'] == 0) {
        $upload_dir = "../assets/faculty/"; 
        $db_path = "assets/faculty/"; 
        
        $file_extension = strtolower(pathinfo($_FILES["research_image"]["name"], PATHINFO_EXTENSION));
        $new_research_file_name = 'research_' . uniqid() . '.' . $file_extension;
        
        $target_upload_research = $upload_dir . $new_research_file_name;
        $target_db_research = $db_path . $new_research_file_name;

        if(getimagesize($_FILES["research_image"]["tmp_name"]) !== false) {
            if (move_uploaded_file($_FILES["research_image"]["tmp_name"], $target_upload_research)) {
                if(!empty($research_image_path) && file_exists("../" . $research_image_path)) {
                    unlink("../" . $research_image_path); 
                }
                $research_image_path = $target_db_research; 
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
        echo "<!DOCTYPE html><html><head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script><link href='https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap' rel='stylesheet'><style>*{font-family:\"Kanit\", sans-serif;}</style></head><body><script>Swal.fire({icon: 'success', title: 'สำเร็จ', text: 'บันทึกแล้ว', confirmButtonColor: '#7b68ee', confirmButtonText: 'OK'}).then(() => { window.location.href = 'admin_faculty.php'; });</script></body></html>";
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
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/admin_sidebar.css">
    <link rel="stylesheet" href="../css/admin_faculty_edit.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="admin-main-content">
    <div class="admin-container">
        
        <div class="top-panel" style="padding-bottom: 25px;">
            <div class="top-header" style="border-bottom:none; padding-bottom:0;">
                <h3 style="margin:0; color:#4a4a4a;">แก้ไขข้อมูลบุคลากร</h3>
                <div class="top-actions">
                    <a href="admin_faculty.php" class="btn btn-cancel"><i class="fas fa-arrow-left"></i> กลับไปหน้าจัดการ</a>
                </div>
            </div>
        </div>
        
        <div class="main-editor">
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
                    <input type="text" name="popup_role" value="<?php echo htmlspecialchars($row['popup_role'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label>ประวัติความเชี่ยวชาญ:</label>
                    <textarea name="history" rows="4" required><?php echo htmlspecialchars($row['history']); ?></textarea>
                </div>

                <div class="research-section">
                    <h4 style="margin-top: 0; color: #FF6F00;">📚 ส่วนข้อมูลงานวิจัย</h4>
                    <div class="form-group">
                        <label>ชื่องานวิจัย / คำอธิบาย:</label>
                        <textarea name="research" rows="3"><?php echo htmlspecialchars($row['research'] ?? ''); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>ลิงก์ไปยังงานวิจัย (URL):</label>
                        <input type="text" name="research_link" value="<?php echo htmlspecialchars($row['research_link'] ?? ''); ?>">
                    </div>
                    
                    <?php if(!empty($row['research_image'])): ?>
                    <div style="margin-bottom: 10px; text-align: center;">
                        <p style="margin: 0 0 5px 0; font-size: 0.9rem; color: #555;">รูปปกวิจัยปัจจุบัน:</p>
                        <img src="../<?php echo htmlspecialchars($row['research_image']); ?>" width="100" style="object-fit: contain; border: 1px solid #ccc; background: #fff;">
                    </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label>เปลี่ยนรูปหน้าปกงานวิจัย (ปล่อยว่างถ้าใช้รูปเดิม):</label>
                        <div class="file-upload-box" style="border-color: #FF6F00; padding: 15px;">
                            <input type="file" name="research_image" accept="image/jpeg, image/png, image/webp">
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 15px; background: #f9f9f9; padding: 15px; border-radius: 5px; text-align: center;">
                    <p style="margin: 0 0 10px 0; font-weight: 500;">📷 รูปโปรไฟล์ปัจจุบัน:</p>
                    <img src="../<?php echo htmlspecialchars($row['image']); ?>" width="120" style="object-fit: cover; border-radius: 8px;">
                </div>

                <div class="form-group">
                    <label>เปลี่ยนรูปโปรไฟล์ใหม่ (ปล่อยว่างถ้าใช้รูปเดิม):</label>
                    <div class="file-upload-box">
                        <input type="file" name="image" accept="image/jpeg, image/png, image/webp">
                    </div>
                </div>

                <div style="margin-top: 30px; display: flex; gap: 10px;">
                    <button type="submit" name="submit_update" class="btn btn-save" style="flex: 1; padding: 15px; font-size: 1.1rem;">บันทึกการเปลี่ยนแปลง</button>
                    <a href="admin_faculty.php" class="btn btn-cancel" style="padding: 15px; font-size: 1.1rem; text-align: center; line-height: 25px;">ยกเลิก</a>
                </div>
            </form>
        </div>

    </div>
</div>
</body>
</html>