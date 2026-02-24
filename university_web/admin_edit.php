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
    $image = $conn->real_escape_string($_POST['image']);

    // คำสั่ง SQL สำหรับ Update
    $sql_update = "UPDATE personnel SET 
                   type = '$type', 
                   program = '$program', 
                   name = '$name', 
                   role = '$role', 
                   popup_role = '$popup_role', 
                   history = '$history', 
                   image = '$image' 
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
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background-color: #f4ece3; padding: 20px; }
        .admin-container { max-width: 800px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 8px; box-sizing: border-box; }
        .btn { padding: 10px 15px; background: #007bff; color: white; border: none; cursor: pointer; border-radius: 5px; font-size: 1rem; }
        .btn-cancel { background: #6c757d; text-decoration: none; padding: 10px 15px; color: white; border-radius: 5px; display: inline-block; margin-left: 10px; }
    </style>
</head>
<body>

<div class="admin-container">
    <h2>✏️ แก้ไขข้อมูลบุคลากร</h2>
    
    <form method="POST" action="">
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
        <div class="form-group">
            <label>ชื่อไฟล์รูปภาพ (หรือ URL):</label>
            <input type="text" name="image" required value="<?php echo htmlspecialchars($row['image']); ?>">
        </div>
        
        <div style="margin-bottom: 15px;">
            <p style="margin: 0 0 5px 0; font-weight: bold;">รูปปัจจุบัน:</p>
            <img src="<?php echo htmlspecialchars($row['image']); ?>" width="100" style="object-fit: cover; border-radius: 5px;" onerror="this.src=''; this.style.backgroundColor='#66ff33';">
        </div>

        <button type="submit" name="submit_update" class="btn">💾 บันทึกการเปลี่ยนแปลง</button>
        <a href="admin.php" class="btn-cancel">✖️ ยกเลิก</a>
    </form>
</div>

</body>
</html>