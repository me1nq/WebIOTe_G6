<?php 
session_start(); 
include 'includes/db.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$message = "";
$status = "";

// 2. เมื่อมีการกดปุ่ม "บันทึกรหัสผ่านใหม่"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset_pwd'])) {
    $old_password = mysqli_real_escape_string($conn, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // ดึงรหัสผ่านเดิมจากฐานข้อมูลมาเช็ค
    $query = "SELECT password FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row['password'] !== $old_password) {
        $status = "error";
        $message = "รหัสผ่านเดิมไม่ถูกต้อง!";
    } elseif ($new_password !== $confirm_password) {
        $status = "warning";
        $message = "รหัสผ่านใหม่และการยืนยันรหัสผ่านไม่ตรงกัน!";
    } elseif (strlen($new_password) < 4) {
        $status = "warning";
        $message = "รหัสผ่านใหม่ต้องมีอย่างน้อย 4 ตัวอักษร!";
    } else {
        // อัปเดตรหัสผ่านใหม่ลงฐานข้อมูล (ในระบบเดิมของเพื่อนคุณไม่ได้เข้ารหัส (Hash) ไว้ จึงบันทึกตรงๆ)
        $update_query = "UPDATE users SET password = '$new_password' WHERE username = '$username'";
        if (mysqli_query($conn, $update_query)) {
            $status = "success";
            $message = "เปลี่ยนรหัสผ่านสำเร็จ! ระบบจะให้คุณเข้าสู่ระบบใหม่";
        } else {
            $status = "error";
            $message = "เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password - IoT Engineering</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="css/style.css">

  <style>
  .reset-container {
    max-width: 500px;
    margin: 0 auto;
    padding: 40px 30px;
    text-align: left;
  }

  .reset-header {
    text-align: center;
    margin-bottom: 30px;
  }

  .reset-header h2 {
    color: #ff6600;
    margin-bottom: 10px;
  }

  .reset-header p {
    color: #666;
    font-size: 0.95rem;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #333;
  }

  .form-group input {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s;
    box-sizing: border-box;
  }

  .form-group input:focus {
    border-color: #ff6600;
    outline: none;
    box-shadow: 0 0 5px rgba(255, 102, 0, 0.2);
  }

  .btn-submit {
    width: 100%;
    background-color: #333;
    color: white;
    padding: 14px;
    border: none;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
    margin-top: 10px;
  }

  .btn-submit:hover {
    background-color: #ff6600;
  }

  .btn-back {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #666;
    text-decoration: none;
    font-size: 0.95rem;
    transition: 0.2s;
  }

  .btn-back:hover {
    color: #ff6600;
  }
  </style>
</head>

<body>
  <?php include 'includes/navbar.php'; ?>

  <div class="page-header">
    Security Settings
  </div>

  <div class="page-background">
    <div class="content-card">

      <div class="reset-container">
        <div class="reset-header">
          <h2>เปลี่ยนรหัสผ่าน</h2>
          <p>กรุณากรอกรหัสผ่านเดิม และตั้งรหัสผ่านใหม่ของคุณ</p>
        </div>

        <form method="POST" action="">
          <div class="form-group">
            <label>รหัสผ่านเดิม (Current Password)</label>
            <input type="password" name="old_password" required placeholder="พิมพ์รหัสผ่านเดิม">
          </div>
          <div class="form-group">
            <label>รหัสผ่านใหม่ (New Password)</label>
            <input type="password" name="new_password" required placeholder="พิมพ์รหัสผ่านใหม่">
          </div>
          <div class="form-group">
            <label>ยืนยันรหัสผ่านใหม่ (Confirm New Password)</label>
            <input type="password" name="confirm_password" required placeholder="พิมพ์รหัสผ่านใหม่อีกครั้ง">
          </div>

          <button type="submit" name="reset_pwd" class="btn-submit">บันทึกรหัสผ่านใหม่</button>
          <a href="profile.php" class="btn-back">← กลับไปหน้าโปรไฟล์</a>
        </form>
      </div>

    </div>
  </div>

  <?php include 'includes/footer.php'; ?>
  <script src="js/script.js"></script>

  <?php if($status != ""): ?>
  <script>
  Swal.fire({
    icon: '<?php echo $status; ?>',
    title: '<?php echo ($status === "success") ? "สำเร็จ!" : "แจ้งเตือน"; ?>',
    text: '<?php echo $message; ?>',
    confirmButtonColor: '#ff6600'
  }).then((result) => {
    <?php if($status === "success"): ?>
    // ถ้าเปลี่ยนรหัสผ่านสำเร็จ ให้เด้งไปหน้า Logout เพื่อบังคับเข้าระบบใหม่ด้วยรหัสใหม่
    window.location.href = 'logout.php';
    <?php endif; ?>
  });
  </script>
  <?php endif; ?>
</body>

</html>