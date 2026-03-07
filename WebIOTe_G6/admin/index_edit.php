<?php
session_start();
include '../includes/db.php';

// เช็คสิทธิ์ Admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Logic การอัปเดตข้อมูล (ทำในหน้าเดียวกันเลย)
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

// ดึงข้อมูลทั้งหมด
$posts = mysqli_query($conn, "SELECT * FROM home_detail");
$gallery = mysqli_query($conn, "SELECT * FROM gallery");
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | WebIoT</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .admin-panel { max-width: 1000px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 20px; }
        .edit-section { border-bottom: 1px solid #eee; padding-bottom: 30px; margin-bottom: 30px; }
        .grid-admin { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; }
        .grid-item-admin { border: 1px solid #ddd; padding: 10px; border-radius: 10px; text-align: center; }
        .grid-item-admin img { width: 100%; height: 100px; object-fit: cover; margin-bottom: 10px; }
        .alert { background: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 20px; }
    </style>
</head>
<body style="background: #f4f4f4;">

    <div class="admin-panel">
        <h1>ระบบจัดการหน้าหลัก (Home Page Editor)</h1>
        <?php if(isset($msg)) echo "<div class='alert'>$msg</div>"; ?>
        <a href="../index.php" style="color: blue;">← กลับหน้าเว็บหลัก</a> | <a href="logout.php" style="color: red;">ออกจากระบบ</a>
        <hr>

        <div class="edit-section">
            <h2>1. ส่วนข้อความหลัก</h2>
            <?php while($post = mysqli_fetch_assoc($posts)): ?>
                <form method="POST" style="margin-bottom: 20px;">
                    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                    <label><strong>ส่วน: <?php echo $post['section']; ?></strong></label>
                    <textarea name="content" style="width:100%; height:100px; margin: 10px 0;"><?php echo $post['content']; ?></textarea>
                    <button type="submit" name="update_post" class="btn-save">บันทึกข้อความ</button>
                </form>
            <?php endwhile; ?>
        </div>

        <div class="edit-section">
            <h2>2. ส่วนรูปภาพกิจกรรม (Grid)</h2>
            <div class="grid-admin">
                <?php while($img = mysqli_fetch_assoc($gallery)): ?>
                    <div class="grid-item-admin">
                        <img src="../<?php echo $img['image_path']; ?>">
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $img['id']; ?>">
                            <input type="text" name="image_path" value="<?php echo $img['image_path']; ?>" style="width: 100%; font-size: 10px;">
                            <button type="submit" name="update_gallery" style="margin-top:5px; background: #007bff; color:white; border:none; cursor:pointer;">เปลี่ยนรูป</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

</body>
</html>