<?php 
session_start(); 
include 'includes/db.php'; 

// เพิ่มการเช็คการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$res = mysqli_query($conn, "SELECT * FROM posts WHERE id = 1");

// เช็คว่ามีข้อมูลไหมก่อนจะ fetch
if ($res && mysqli_num_rows($res) > 0) {
    $data = mysqli_fetch_assoc($res);
} else {
    $data = ['content' => 'ยังไม่มีข้อมูลในระบบ']; // กันเหนียวไว้ก่อน
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admission Projects</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="assets/css/style_admission.css">
</head>

<body>
  <?php include 'includes/navbar.php'; ?>
  <div class="container" id="project-container">
    <p style="text-align:center;">กำลังโหลดข้อมูล...</p>
  </div>

  <script src="assets/js/admission.js">
  </script>

  </div> </div> <?php include 'includes/footer.php'; ?>
</body>

</html>