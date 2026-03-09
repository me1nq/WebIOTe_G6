<?php 
session_start(); 
include 'includes/db.php'; 

// เพิ่มการเช็คการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
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

  <link rel="stylesheet" href="css/style.css"> <link rel="stylesheet" href="css/admission.css">
</head>

<body>
  <?php include 'includes/navbar.php'; ?>

  <div class="page-header">
      Admission & Projects
  </div>

  <div class="page-background">
      <div class="content-card"> 
        
        <div id="project-container" style="max-width: 900px; margin: 0 auto;">
          <p style="text-align:center;">กำลังโหลดข้อมูล...</p>
        </div>

      </div>
  </div> 

  <?php include 'includes/footer.php'; ?>

  <script src="js/admission.js"></script>
  <script src="js/script.js"></script>
</body>

</html>