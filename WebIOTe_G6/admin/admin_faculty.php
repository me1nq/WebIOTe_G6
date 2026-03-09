<?php
require '../includes/db.php'; // เชื่อมต่อฐานข้อมูล

// -------------------------
// 1. จัดการการลบข้อมูล (Delete)
// -------------------------
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM personnel WHERE id = $id";
    if ($conn->query($sql_delete) === TRUE) {
        // 🚨 เปลี่ยนกลับมาหน้า faculty.php
        echo "<!DOCTYPE html><html><head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script><link href='https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap' rel='stylesheet'><style>*{font-family:\"Kanit\", sans-serif;}</style></head><body><script>Swal.fire({icon: 'success', title: 'สำเร็จ', text: 'ลบข้อมูลเรียบร้อยแล้ว', confirmButtonColor: '#7b68ee', confirmButtonText: 'OK'}).then(() => { window.location.href = 'admin_faculty.php'; });</script></body></html>";
        exit;
    } else {
        echo "<!DOCTYPE html><html><head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script><link href='https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap' rel='stylesheet'><style>*{font-family:\"Kanit\", sans-serif;}</style></head><body><script>Swal.fire({icon: 'error', title: 'ผิดพลาด', text: '" . $conn->error . "', confirmButtonColor: '#dc3545'}).then(() => { window.history.back(); });</script></body></html>";
        exit;
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
    $popup_role = $conn->real_escape_string($_POST['popup_role']); 
    $history = $conn->real_escape_string($_POST['history']);
    $research = $conn->real_escape_string($_POST['research']); 
    $research_link = $conn->real_escape_string($_POST['research_link']); 
    
    $image_path = "assets/faculty/default.png"; 
    $research_image_path = ""; 

    // 🔴 จัดการรูปโปรไฟล์ (อัปโหลดจริงมี ../ แต่เซฟลง DB ไม่มี)
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = "../assets/faculty/"; 
        $db_path = "assets/faculty/";       
        
        $file_extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $new_file_name = uniqid() . '.' . $file_extension;
        
        $target_upload = $upload_dir . $new_file_name; 
        $target_db = $db_path . $new_file_name;        

        if(getimagesize($_FILES["image"]["tmp_name"]) !== false) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_upload)) {
                $image_path = $target_db; 
            }
        }
    }

    // 🔴 จัดการรูปงานวิจัย (ใช้หลักการเดียวกัน)
    if (isset($_FILES['research_image']) && $_FILES['research_image']['error'] == 0) {
        $upload_dir = "../assets/faculty/"; 
        $db_path = "assets/faculty/"; 
        
        $file_extension = strtolower(pathinfo($_FILES["research_image"]["name"], PATHINFO_EXTENSION));
        $new_research_file_name = 'research_' . uniqid() . '.' . $file_extension;
        
        $target_upload_research = $upload_dir . $new_research_file_name;
        $target_db_research = $db_path . $new_research_file_name;

        if(getimagesize($_FILES["research_image"]["tmp_name"]) !== false) {
            if (move_uploaded_file($_FILES["research_image"]["tmp_name"], $target_upload_research)) {
                $research_image_path = $target_db_research; 
            }
        }
    }

    $sql_insert = "INSERT INTO personnel (type, program, name, role, popup_role, history, image, research, research_link, research_image) 
                   VALUES ('$type', '$program', '$name', '$role', '$popup_role', '$history', '$image_path', '$research', '$research_link', '$research_image_path')";
    
    if ($conn->query($sql_insert) === TRUE) {
        // 🚨 เด้งกลับหน้า faculty.php
        echo "<!DOCTYPE html><html><head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script><link href='https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap' rel='stylesheet'><style>*{font-family:\"Kanit\", sans-serif;}</style></head><body><script>Swal.fire({icon: 'success', title: 'สำเร็จ', text: 'บันทึกแล้ว', confirmButtonColor: '#7b68ee', confirmButtonText: 'OK'}).then(() => { window.location.href = 'faculty.php'; });</script></body></html>";
        exit;
    } else {
        echo "<!DOCTYPE html><html><head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script><link href='https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap' rel='stylesheet'><style>*{font-family:\"Kanit\", sans-serif;}</style></head><body><script>Swal.fire({icon: 'error', title: 'ผิดพลาด', text: '" . $conn->error . "', confirmButtonColor: '#dc3545'}).then(() => { window.history.back(); });</script></body></html>";
        exit;
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
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/admin_sidebar.css">
    <link rel="stylesheet" href="../css/admin_faculty.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="admin-main-content">
    <div class="admin-container">
        
        <div class="top-panel" style="padding-bottom: 25px;">
            <div class="top-header" style="border-bottom:none; padding-bottom:0;">
                <h3 style="margin:0; color:#4a4a4a;">ระบบจัดการข้อมูลบุคลากร</h3>
                <div class="top-actions">
                    <a href="admin_faculty_reviews.php" class="btn btn-edit"><i class="fas fa-comments"></i> ดูรีวิวความคิดเห็น</a>
                </div>
            </div>
        </div>
        
        <div class="main-editor" style="margin-bottom: 20px;">
            <h3 style="margin-top:0; border-bottom: 1px solid #eee; padding-bottom: 15px; color:#4a4a4a;">เพิ่มข้อมูลใหม่</h3>
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

                <div class="research-section">
                    <h4 style="margin-top: 0; color: #FF6F00;">📚 ส่วนข้อมูลงานวิจัย (ถ้ามี)</h4>
                    <div class="form-group">
                        <label>ชื่องานวิจัย / คำอธิบาย:</label>
                        <textarea name="research" rows="2" placeholder="เช่น พัฒนาระบบ IoT..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>ลิงก์ไปยังงานวิจัย (URL):</label>
                        <input type="text" name="research_link" placeholder="เช่น https://www.researchgate.net/...">
                    </div>
                    <div class="form-group">
                        <label>อัปโหลดรูปหน้าปกงานวิจัย:</label>
                        <div class="file-upload-box" style="border-color: #FF6F00;">
                            <input type="file" name="research_image" accept="image/jpeg, image/png, image/webp">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>อัปโหลดรูปโปรไฟล์อาจารย์:</label>
                    <div class="file-upload-box">
                        <input type="file" name="image" accept="image/jpeg, image/png, image/webp">
                    </div>
                </div>

                <button type="submit" name="submit_add" class="btn btn-save" style="width:100%; padding:15px; font-size:1.1rem;">บันทึกข้อมูล</button>
            </form>
        </div>

        <div class="table-container">
            <h3 style="margin-top:0; color:#4a4a4a; margin-bottom: 15px;">รายชื่อบุคลากรทั้งหมด</h3>
            <div style="display: flex; gap: 10px; margin-bottom: 20px; background: #fafafa; padding: 15px; border-radius: 8px; border: 1px solid #eee;">
                <div class="form-group" style="margin:0; flex:1;">
                    <label style="margin-bottom: 5px; font-size: 0.9rem;">กรองตามหลักสูตร:</label>
                    <select id="tableFilter" onchange="filterTable()">
                        <option value="all">แสดงทั้งหมด</option>
                        <option value="iot">วิศวกรรมไอโอที (IoT)</option>
                        <option value="science">วิทยาศาสตร์ (Science) - 2 ปริญญา</option>
                        <option value="other">หลักสูตรอื่นๆ</option>
                    </select>
                </div>
                <div class="form-group" style="margin:0; flex:2;">
                    <label style="margin-bottom: 5px; font-size: 0.9rem;">ค้นหาชื่อ:</label>
                    <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="พิมพ์ชื่อเพื่อค้นหา...">
                </div>
            </div>

            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>รูป</th><th>ชื่อ</th><th>ประเภท</th><th>หลักสูตร</th><th>ตำแหน่ง (การ์ด)</th><th>ตำแหน่ง (Pop-up)</th><th style="text-align: center;">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody id="personnelTableBody">
                        <?php if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) { 
                        ?>
                            <tr class="data-row" data-program="<?php echo htmlspecialchars($row['program']); ?>" data-name="<?php echo strtolower(htmlspecialchars($row['name'])); ?>">
                                <td><img src="../<?php echo htmlspecialchars($row['image']); ?>" width="50" height="50" style="object-fit: cover; border-radius: 5px;"></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['type']); ?></td>
                                <td><?php echo $row['program'] ? htmlspecialchars($row['program']) : '-'; ?></td>
                                <td><?php echo htmlspecialchars($row['role']); ?></td>
                                <td><?php echo !empty($row['popup_role']) ? htmlspecialchars($row['popup_role']) : '<span style="color:#999;">(ไม่ได้ระบุ)</span>'; ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="admin_faculty_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-edit">แก้ไข</a>
                                        <a href="#" onclick="confirmDelete(<?php echo $row['id']; ?>); return false;" class="btn btn-danger">ลบ</a>
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
        </div>

    </div>
</div>

<script src="../js/admin_faculty.js"></script>
</body>
</html>