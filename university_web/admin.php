<?php
require 'db.php'; // เชื่อมต่อฐานข้อมูล

// -------------------------
// 1. จัดการการลบข้อมูล (Delete)
// -------------------------
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM personnel WHERE id = $id";
    if ($conn->query($sql_delete) === TRUE) {
        echo "<script>alert('ลบข้อมูลสำเร็จ'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . $conn->error . "');</script>";
    }
}

// -------------------------
// 2. จัดการการเพิ่มข้อมูล (Create)
// -------------------------
if (isset($_POST['submit_add'])) {
    $type = $conn->real_escape_string($_POST['type']);
    $program = $conn->real_escape_string($_POST['program']);
    $name = $conn->real_escape_string($_POST['name']);
    $role = $conn->real_escape_string($_POST['role']);
    $popup_role = $conn->real_escape_string($_POST['popup_role']); // รับค่า popup_role เพิ่ม
    $history = $conn->real_escape_string($_POST['history']);
    $image = $conn->real_escape_string($_POST['image']);

    // เพิ่ม popup_role ลงในคำสั่ง INSERT
    $sql_insert = "INSERT INTO personnel (type, program, name, role, popup_role, history, image) 
                   VALUES ('$type', '$program', '$name', '$role', '$popup_role', '$history', '$image')";
    
    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>alert('เพิ่มข้อมูลสำเร็จ'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . $conn->error . "');</script>";
    }
}

// -------------------------
// 3. ดึงข้อมูลมาแสดง (Read)
// -------------------------
$sql_select = "SELECT * FROM personnel ORDER BY id DESC";
$result = $conn->query($sql_select);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - จัดการบุคลากร</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background-color: #f4ece3; padding: 20px; }
        .admin-container { max-width: 1100px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 0.9rem; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #ffcc99; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 8px; box-sizing: border-box; }
        .btn { padding: 8px 15px; background: #28a745; color: white; border: none; cursor: pointer; text-decoration: none; border-radius: 5px; display: inline-block;} 
        .btn-danger { background: #dc3545; }
        .btn-edit { background: #ffc107; color: black; margin-right: 5px; }
    </style>
</head>
<body>

<div class="admin-container">
    <h2>🛠️ ระบบจัดการข้อมูลบุคลากร (Admin Panel)</h2>
    
    <div style="background: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 30px;">
        <h3>➕ เพิ่มข้อมูลใหม่</h3>
        <form method="POST" action="">
            <div class="form-group">
                <label>ประเภทบุคลากร:</label>
                <select name="type" required>
                    <option value="faculty">คณาจารย์ (Faculty)</option>
                    <option value="staff">บุคลากรสายสนับสนุน (Staff)</option>
                </select>
            </div>
            <div class="form-group">
                <label>หลักสูตร / สังกัด:</label>
                <select name="program" required>
                    <option value="iot">วิศวกรรมไอโอที (IoT)</option>
                    <option value="science">วิทยาศาสตร์ (Science) - 2 ปริญญา</option>
                    <option value="other">หลักสูตรอื่นๆ</option>
                </select>
            </div>
            <div class="form-group">
                <label>ชื่อ-นามสกุล (พร้อมคำนำหน้า):</label>
                <input type="text" name="name" required placeholder="เช่น ผศ.ดร.ใจดี เรียนเก่ง">
            </div>
            
            <div class="form-group">
                <label>ตำแหน่ง (โชว์ในการ์ดหน้าแรก):</label>
                <input type="text" name="role" required placeholder="เช่น หัวหน้าภาควิชา">
            </div>
            <div class="form-group">
                <label>ตำแหน่ง (โชว์ใน Pop-up):</label>
                <input type="text" name="popup_role" placeholder="เช่น อาจารย์ประจำหลักสูตร (ถ้าปล่อยว่างจะใช้ค่าเดียวกับการ์ด)">
            </div>
            
            <div class="form-group">
                <label>ประวัติความเชี่ยวชาญ:</label>
                <textarea name="history" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label>ชื่อไฟล์รูปภาพ (หรือ URL):</label>
                <input type="text" name="image" required value="images/default.png">
            </div>
            <button type="submit" name="submit_add" class="btn">บันทึกข้อมูล</button>
        </form>
    </div>

    <h3>📋 รายชื่อบุคลากรทั้งหมด</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>รูป</th>
                <th>ชื่อ</th>
                <th>ประเภท</th>
                <th>หลักสูตร</th>
                <th>ตำแหน่ง (การ์ด)</th>
                <th>ตำแหน่ง (Pop-up)</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><img src="<?php echo $row['image']; ?>" width="50" height="50" style="object-fit: cover;"></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['type']; ?></td>
                    <td><?php echo $row['program'] ? $row['program'] : '-'; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td><?php echo !empty($row['popup_role']) ? $row['popup_role'] : '<span style="color:#999;">(ไม่ได้ระบุ)</span>'; ?></td>
                    <td>
                        <a href="admin_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">แก้ไข</a>
                        <a href="admin.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบอาจารย์ท่านนี้?');">ลบ</a>
                    </td>
                </tr>
            <?php } 
            } else { ?>
                <tr><td colspan="8" style="text-align: center;">ไม่มีข้อมูลในระบบ</td></tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>