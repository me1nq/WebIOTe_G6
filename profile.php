<?php 
session_start(); 
include 'includes/db.php'; 

// เช็คว่าผู้ใช้ Login หรือยัง
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$username = mysqli_real_escape_string($conn, $_SESSION['username']);
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user_data = mysqli_fetch_assoc($result);
} else {
    $user_data = ['username' => 'Unknown', 'role' => 'user']; 
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile - IoT Engineering</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/profile.css">
</head>

<body>
  <?php include 'includes/navbar.php'; ?>

  <div class="page-header">
    My Profile
  </div>

  <div class="page-background">
    <div class="content-card">

      <div class="profile-container">

        <div class="profile-top">
          <div class="profile-left">
            <div class="profile-avatar">
              <?php echo substr($user_data['username'], 0, 1); ?>
            </div>
          </div>

          <div class="profile-info">
            <h1 class="profile-name"><?php echo htmlspecialchars($user_data['username']); ?></h1>
            <div class="profile-role <?php echo ($user_data['role'] === 'admin') ? 'role-admin' : ''; ?>">
              Role: <?php echo strtoupper(htmlspecialchars($user_data['role'])); ?>
            </div>
          </div>

          <div class="profile-action-top">
            <a href="reset_password.php" class="btn-custom btn-reset">รีเซ็ตรหัสผ่าน</a>
          </div>
        </div>

        <hr class="profile-divider">

        <div class="profile-bottom">
          <?php if($user_data['role'] === 'admin'): ?>
          <a href="admin/admin_index.php" class="btn-custom btn-primary">จัดการระบบหน้าหลัก (Admin Panel)</a>
          <a href="admin/admin_admission.php" class="btn-custom btn-primary">จัดการระบบการรับสมัคร</a>
          <a href="admin/admin_lab.php" class="btn-custom btn-primary">จัดการระบบห้องปฏิบัติการ</a>
          <a href="admin/admin_calculate.php" class="btn-custom btn-primary">จัดการระบบคำนวณหน่วยกิต</a>
          <?php else: ?>
          <a href="admission.php" class="btn-custom btn-primary">ตรวจสอบสถานะการรับสมัคร</a>
          <a href="calculate.php" class="btn-custom btn-primary">วางแผนการลงทะเบียนเรียน</a>
          <a href="cyber_lab.html" class="btn-custom btn-primary">ข้อมูลห้องปฏิบัติการ</a>
          <?php endif; ?>
        </div>

      </div>

    </div>
  </div>

  <?php include 'includes/footer.php'; ?>
  <script src="js/script.js"></script>
</body>

</html>