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
        
        <div class="top-panel" style="padding-bottom: 25px;">
            <div class="top-header" style="border-bottom:none; padding-bottom:0;">
                <h3 style="margin:0; color:#4a4a4a;">ระบบจัดการหน้าหลัก (Home Page Editor)</h3>
            </div>
        </div>

        <?php if(isset($msg)) echo "<div class='alert-success'>$msg</div>"; ?>

        <div class="main-editor" style="margin-bottom: 20px;">
            <h3 style="margin-top:0; border-bottom: 1px solid #eee; padding-bottom: 15px; color:#4a4a4a;">1. ส่วนข้อความหลัก</h3>
            <?php while($post = mysqli_fetch_assoc($posts)): ?>
                <form method="POST" class="form-group" style="background: #fafafa; padding: 15px; border-radius: 8px; border: 1px solid #eee;">
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

    </div>
</div>
</body>
</html>