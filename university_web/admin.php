<?php
require 'db.php'; // เชื่อมต่อฐานข้อมูล

// -------------------------
// 1. จัดการการลบข้อมูล (Delete)
// -------------------------
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    
    // ออปชันเสริม: ถ้าอยากให้ลบรูปออกจากโฟลเดอร์ด้วยเมื่อกดลบข้อมูล
    /*
    $sql_get_img = "SELECT image FROM personnel WHERE id = $id";
    $res_img = $conn->query($sql_get_img);
    if($res_img->num_rows > 0) {
        $img_row = $res_img->fetch_assoc();
        if($img_row['image'] != 'images/default.png' && file_exists($img_row['image'])) {
            unlink($img_row['image']); // ลบไฟล์รูป
        }
    }
    */

    $sql_delete = "DELETE FROM personnel WHERE id = $id";
    if ($conn->query($sql_delete) === TRUE) {
        echo "<script>alert('ลบข้อมูลสำเร็จ'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . $conn->error . "');</script>";
    }
}

// -------------------------
// 2. จัดการการเพิ่มข้อมูล (Create) พร้อมระบบอัปโหลดรูป
// -------------------------
if (isset($_POST['submit_add'])) {
    $type = $conn->real_escape_string($_POST['type']);
    $program = $conn->real_escape_string($_POST['program']);
    $name = $conn->real_escape_string($_POST['name']);
    $role = $conn->real_escape_string($_POST['role']);
    $popup_role = $conn->real_escape_string($_POST['popup_role']); 
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
// 3. ดึงข้อมูลมาแสดง (Read) - ดึงมาทั้งหมดรอไว้ก่อน
// -------------------------
$sql_select = "SELECT * FROM personnel ORDER BY id DESC";
$result = $conn->query($sql_select);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - จัดการบุคลากร</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        /* 🚨 เปลี่ยนฟอนต์หลักของหน้าเว็บเป็น Kanit */
        body { 
            font-family: 'Kanit', sans-serif; 
            background-color: #f5f6fa; 
            padding: 20px; 
            font-weight: 300;
        }
        
        /* ปรับให้หัวข้อหนาขึ้นนิดนึงเพื่อให้ดูชัดเจน */
        h2, h3, label, th, strong {
            font-weight: 500; 
        }

        .admin-container { max-width: 1100px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 0.9rem; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #FF6F00; color: white;} /* เพิ่มสีตัวหนังสือขาวบนหัวตารางเผื่อให้อ่านง่าย */
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        
        /* บังคับให้ช่องกรอกข้อมูลใช้ฟอนต์ Kanit ด้วย */
        .form-group input[type="text"], .form-group select, .form-group textarea, .filter-section input, .filter-section select { 
            font-family: 'Kanit', sans-serif;
            width: 100%; 
            padding: 8px; 
            box-sizing: border-box; 
            border: 1px solid #ccc; 
            border-radius: 4px; 
        }
        
        .btn { font-family: 'Kanit', sans-serif; font-weight: 400; padding: 8px 15px; background: #28a745; color: white; border: none; cursor: pointer; text-decoration: none; border-radius: 5px; display: inline-block;} 
        .btn-danger { background: #dc3545; }
        .btn-edit { background: #11b65b; }
        
        .filter-section { background-color: #e9ecef; padding: 15px; border-radius: 5px; margin-bottom: 20px; display: flex; align-items: center; flex-wrap: wrap; gap: 15px; }
        .filter-section select { width: 250px; }
        .filter-section input { width: 300px; }
        
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
            border-color: #FF6F00;
        }
        .file-upload-box input[type="file"] {
            display: block;
            margin: 10px auto;
            cursor: pointer;
            font-family: 'Kanit', sans-serif; /* บังคับฟอนต์ที่ปุ่มอัปโหลดไฟล์ด้วย */
        }

        .action-buttons {
            display: flex;
            gap: 5px; 
            justify-content: center; 
        }
    </style>
</head>
<body>

<div class="admin-container">
    <h2>ระบบจัดการข้อมูลบุคลากร (Admin Panel)</h2>
    
    <div style="background: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 30px;">
        <h3>เพิ่มข้อมูลใหม่</h3>
        <form method="POST" action="" enctype="multipart/form-data">
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
                <label>อัปโหลดรูปโปรไฟล์:</label>
                <div class="file-upload-box">
                    <p style="margin: 0; color: #555;">ลากไฟล์รูปมาวางที่นี่ หรือคลิกปุ่มด้านล่างเพื่อเลือกไฟล์</p>
                    <input type="file" name="image" accept="image/jpeg, image/png, image/webp">
                </div>
            </div>

            <button type="submit" name="submit_add" class="btn">บันทึกข้อมูล</button>
        </form>
    </div>

    <h3>รายชื่อบุคลากรทั้งหมด</h3>
    
    <div class="filter-section">
        <label for="tableFilter"><strong>กรองตามหลักสูตร:</strong></label>
        <select id="tableFilter" onchange="filterTable()">
            <option value="all">แสดงทั้งหมด</option>
            <option value="iot">วิศวกรรมไอโอที (IoT)</option>
            <option value="science">วิทยาศาสตร์ (Science) - 2 ปริญญา</option>
            <option value="other">หลักสูตรอื่นๆ</option>
        </select>
        
        <label for="searchInput" style="margin-left: 10px;"><strong>ค้นหาชื่อ:</strong></label>
        <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="พิมพ์ชื่อเพื่อค้นหา...">
    </div>

    <table>
        <thead>
            <tr>
                <th>รูป</th>
                <th>ชื่อ</th>
                <th>ประเภท</th>
                <th>หลักสูตร</th>
                <th>ตำแหน่ง (การ์ด)</th>
                <th>ตำแหน่ง (Pop-up)</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody id="personnelTableBody">
            <?php if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) { 
            ?>
                <tr class="data-row" data-program="<?php echo htmlspecialchars($row['program']); ?>" data-name="<?php echo strtolower(htmlspecialchars($row['name'])); ?>">
                    <td><img src="<?php echo htmlspecialchars($row['image']); ?>" width="50" height="50" style="object-fit: cover;"></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['type']); ?></td>
                    <td><?php echo $row['program'] ? htmlspecialchars($row['program']) : '-'; ?></td>
                    <td><?php echo htmlspecialchars($row['role']); ?></td>
                    <td><?php echo !empty($row['popup_role']) ? htmlspecialchars($row['popup_role']) : '<span style="color:#999;">(ไม่ได้ระบุ)</span>'; ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="admin_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">แก้ไข</a>
                            <a href="admin.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบอาจารย์ท่านนี้?');">ลบ</a>
                        </div>
                    </td>
                </tr>
            <?php } 
            } else { ?>
                <tr id="noDataRow"><td colspan="7" style="text-align: center;">ไม่มีข้อมูลในระบบ</td></tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
function filterTable() {
    let filterValue = document.getElementById("tableFilter").value;
    let searchValue = document.getElementById("searchInput").value.toLowerCase();
    let rows = document.querySelectorAll(".data-row");
    
    rows.forEach(row => {
        let rowProgram = row.getAttribute("data-program");
        let rowName = row.getAttribute("data-name");
        
        let matchProgram = (filterValue === "all" || filterValue === rowProgram);
        let matchName = (rowName.includes(searchValue)); 
        
        if (matchProgram && matchName) {
            row.style.display = ""; 
        } else {
            row.style.display = "none"; 
        }
    });
}
</script>

</body>
</html>