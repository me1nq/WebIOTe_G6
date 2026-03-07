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
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/style.css">

  <style>
  .profile-container {
    padding: 20px 10px;
    max-width: 900px;
    margin: 0 auto;
  }

  /* --- ส่วนบน: รูป - ข้อมูล - ปุ่มรีเซ็ต --- */
  .profile-top {
    display: flex;
    align-items: center;
    gap: 30px;
    margin-bottom: 30px;
  }

  .profile-avatar {
    width: 120px;
    height: 120px;
    background-color: #ff6600;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 50px;
    font-weight: bold;
    text-transform: uppercase;
    box-shadow: 0 8px 20px rgba(255, 102, 0, 0.2);
    flex-shrink: 0;
  }

  .profile-info {
    flex-grow: 1;
    /* ดันปุ่มรีเซ็ตไปขวาสุด */
    text-align: left;
  }

  .profile-name {
    font-size: 2rem;
    color: #333;
    margin: 0 0 5px 0;
  }

  .profile-role {
    display: inline-block;
    background-color: #eee;
    color: #555;
    padding: 4px 15px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
  }

  .profile-action-top {
    flex-shrink: 0;
  }

  .profile-divider {
    border: 0;
    height: 1px;
    background: #eee;
    margin: 20px 0 30px 0;
  }

  /* --- ส่วนล่าง: ปุ่มฟังก์ชันแบบกว้างเต็มจอและเรียงลงมา --- */
  .profile-bottom {
    display: flex;
    flex-direction: column;
    /* เรียงจากบนลงล่าง */
    gap: 15px;
    /* ระยะห่างระหว่างปุ่ม */
    width: 100%;
  }

  .btn-custom {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 15px 25px;
    /* เพิ่มความสูงปุ่มให้ดูเต็มๆ */
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    width: 100%;
    /* กว้างเต็มพื้นที่ Card */
    box-sizing: border-box;
    font-size: 1.1rem;
  }

  .btn-primary {
    background-color: #ff6600;
    color: white;
    box-shadow: 0 4px 15px rgba(255, 102, 0, 0.2);
  }

  .btn-primary:hover {
    background-color: #e65c00;
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(255, 102, 0, 0.3);
  }

  /* ปุ่มรีเซ็ต (ขนาดปกติ) */
  .btn-reset {
    background-color: #fff;
    color: #666;
    border: 1px solid #ddd;
    padding: 8px 15px;
    font-size: 0.9rem;
    min-width: auto;
  }

  .btn-reset:hover {
    border-color: #ff6600;
    color: #ff6600;
  }

  /* Responsive สำหรับมือถือ */
  @media (max-width: 600px) {
    .profile-top {
      flex-direction: column;
      text-align: center;
    }

    .profile-info {
      text-align: center;
    }

    .profile-action-top {
      width: 100%;
    }
  }
  </style>
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
          <a href="admin/edit_index.php" class="btn-custom btn-primary">จัดการระบบหน้าหลัก (Admin Panel)</a>
          <a href="admin/admin_admission.html" class="btn-custom btn-primary">จัดการระบบการรับสมัคร</a>
          <a href="admin/admin_lab.html" class="btn-custom btn-primary">จัดการระบบห้องปฏิบัติการ</a>
          <a href="admin/admin_calculate.html" class="btn-custom btn-primary">จัดการระบบคำนวณหน่วยกิต</a>
          <?php else: ?>
          <a href="admission.php" class="btn-custom btn-primary">ตรวจสอบสถานะการรับสมัคร</a>
          <a href="calculate.html" class="btn-custom btn-primary">วางแผนการลงทะเบียนเรียน</a>
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