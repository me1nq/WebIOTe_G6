<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['update_post'])) {
    $id = $_POST['id'];
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    mysqli_query($conn, "UPDATE home_detail SET content = '$content' WHERE id = $id");
    $msg = "อัปเดตข้อความสำเร็จ!";
}

if (isset($_POST['update_gallery'])) {
    $id = $_POST['id'];
    $path = mysqli_real_escape_string($conn, $_POST['image_path']);
    mysqli_query($conn, "UPDATE gallery SET image_path = '$path' WHERE id = $id");
    $msg = "อัปเดตรูปภาพสำเร็จ!";
}

// --- 3. จัดการข่าวสาร Announcement (เวอร์ชันอัปโหลดรูป) ---
if (isset($_POST['add_announcement'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $date = $_POST['date_posted'];
    $tags = mysqli_real_escape_string($conn, $_POST['tags']);
    
    // ตั้งค่าโฟลเดอร์เก็บรูป
    $target_dir = "../assets/newpic/";
    if (!file_exists($target_dir)) { mkdir($target_dir, 0777, true); } // สร้างโฟลเดอร์ถ้ายังไม่มี

    // ตั้งชื่อไฟล์ใหม่เพื่อกันชื่อซ้ำ (ใช้เวลาปัจจุบัน + ชื่อเดิม)
    $file_name = time() . "_" . basename($_FILES["news_image"]["name"]);
    $target_file = $target_dir . $file_name;
    $db_path = "newpic/" . $file_name; // พาธสำหรับเก็บลงฐานข้อมูล (จะเอาไปใช้คู่กับ assets/)

    if (move_uploaded_file($_FILES["news_image"]["tmp_name"], $target_file)) {
        mysqli_query($conn, "INSERT INTO announcements (title, content, date_posted, image_path, tags) 
                            VALUES ('$title', '$content', '$date', '$db_path', '$tags')");
        $msg = "เพิ่มประกาศข่าวสารและอัปโหลดรูปสำเร็จ!";
    } else {
        $msg = "เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ!";
    }
}

if (isset($_GET['delete_announcement'])) {
    $id = $_GET['delete_announcement'];
    
    // ดึงพาธรูปภาพมาลบไฟล์ในเครื่องก่อนลบข้อมูลใน DB
    $res = mysqli_query($conn, "SELECT image_path FROM announcements WHERE id = $id");
    if ($row = mysqli_fetch_assoc($res)) {
        $file_path = "../assets/" . $row['image_path'];
        if (file_exists($file_path)) { unlink($file_path); } // ลบไฟล์จริงออกจากโฟลเดอร์
    }
    
    mysqli_query($conn, "DELETE FROM announcements WHERE id = $id");
    $msg = "ลบประกาศข่าวสารและไฟล์รูปภาพเรียบร้อย!";
}

$announcements = mysqli_query($conn, "SELECT * FROM announcements ORDER BY date_posted DESC");

$posts = mysqli_query($conn, "SELECT * FROM home_detail");
$gallery = mysqli_query($conn, "SELECT * FROM gallery");

?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | WebIoT</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/admin_sidebar.css">
    <link rel="stylesheet" href="../css/admin_index.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="admin-main-content">
    <div class="admin-container">
        
        <div class="top-panel">
            <div class="top-header" style="border-bottom:none; padding-bottom:0;">
                <h3>ระบบจัดการหน้าหลัก (Home Page Editor)</h3>
            </div>
        </div>

        <?php if(isset($msg)) echo "<div class='alert-success'>$msg</div>"; ?>

        <div class="main-editor">
            <h3 style="margin-top:0; border-bottom: 1px solid #eee; padding-bottom: 15px; color:#4a4a4a;">1. ส่วนข้อความหลัก</h3>
            <?php while($post = mysqli_fetch_assoc($posts)): ?>
                <form method="POST" class="form-group" style="background: #fafafa; padding: 15px; border-radius: 8px; border: 1px solid #eee; margin-bottom: 15px;">
                    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                    <label>ส่วน: <?php echo $post['section']; ?></label>
                    <textarea name="content" rows="4"><?php echo $post['content']; ?></textarea>
                    <button type="submit" name="update_post" class="btn btn-save" style="margin-top: 10px;">บันทึกข้อความ</button>
                </form>
            <?php endwhile; ?>
        </div>

        <div class="main-editor">
            <h3 style="margin-top:0; border-bottom: 1px solid #eee; padding-bottom: 15px; color:#4a4a4a;">2. ส่วนรูปภาพกิจกรรม (Grid)</h3>
            <div class="grid-admin">
                <?php mysqli_data_seek($gallery, 0); // รีเซ็ตตัวอ่านข้อมูล ?>
                <?php while($img = mysqli_fetch_assoc($gallery)): ?>
                    <div class="grid-item-admin">
                        <img src="../<?php echo $img['image_path']; ?>">
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $img['id']; ?>">
                            <input type="text" name="image_path" value="<?php echo $img['image_path']; ?>" style="margin-bottom: 10px;">
                            <button type="submit" name="update_gallery" class="btn btn-edit" style="width: 100%;">เปลี่ยนรูป</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <div class="main-editor">
            <h3 style="margin-top:0; border-bottom: 1px solid #eee; padding-bottom: 15px; color:#4a4a4a;">3. ส่วนจัดการข่าวสาร (Announcements)</h3>
            
            <form method="POST" enctype="multipart/form-data" class="form-group" style="background: #fafafa; padding: 25px; border-radius: 12px; border: 1px solid #eee; margin-bottom: 30px;">
                <h4 style="margin-top:0; color:#FF6F00;">+ เพิ่มข่าวใหม่</h4>
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
                    <div class="form-group" style="margin-bottom:0;">
                        <label>หัวข้อข่าว :</label>
                        <input type="text" name="title" placeholder="ระบุหัวข้อข่าว" required>
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label>เลือกรูปภาพข่าว :</label>
                        <input type="file" name="news_image" accept="image/*" required style="background: #fff; padding: 8px;">
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label>วันที่ประกาศ :</label>
                        <input type="date" name="date_posted" required>
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label>Tags (แยกด้วยคอมม่า) :</label>
                        <input type="text" name="tags" placeholder="เช่น #Smart City, #Innovation">
                    </div>
                </div>
                <div class="form-group">
                    <label>เนื้อหาข่าวแบบย่อ :</label>
                    <textarea name="content" rows="3" placeholder="ระบุรายละเอียดข่าวสารเบื้องต้น..."></textarea>
                </div>
                <button type="submit" name="add_announcement" class="btn btn-add" style="width: 100%;">บันทึกข่าวสารและอัปโหลดรูป</button>
            </form>

            <div class="table-container" style="padding:0; box-shadow:none;">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 100px;">รูป</th>
                            <th>หัวข้อข่าว</th>
                            <th style="width: 120px;">วันที่</th>
                            <th style="width: 100px;">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $announcements = mysqli_query($conn, "SELECT * FROM announcements ORDER BY date_posted DESC");
                        while($ann = mysqli_fetch_assoc($announcements)): 
                        ?>
                        <tr>
                            <td><img src="../assets/<?php echo $ann['image_path']; ?>" style="width: 70px; height: 50px; object-fit: cover; border-radius: 6px;"></td>
                            <td>
                                <strong><?php echo $ann['title']; ?></strong><br>
                                <small style="color:#888;"><?php echo $ann['tags']; ?></small>
                            </td>
                            <td><?php echo date('d/m/Y', strtotime($ann['date_posted'])); ?></td>
                            <td style="text-align: center;">
                                <a href="?delete_announcement=<?php echo $ann['id']; ?>" class="btn btn-danger" onclick="return confirm('แน่ใจนะว่าจะลบข่าวนี้? ระบบจะลบไฟล์รูปทิ้งด้วยนะเว้ย!')" style="padding: 6px 12px; font-size: 0.85rem;">ลบ</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

</body>
</html>