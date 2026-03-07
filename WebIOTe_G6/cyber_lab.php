<?php 
session_start(); 
include 'includes/db.php'; 
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cybersecurity Laboratory</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="css/style.css"> <link rel="stylesheet" href="css/style_lab.css">
</head>
<body>

  <?php include 'includes/navbar.php'; ?>

  <div class="page-header">
      Cybersecurity Laboratory
  </div>

  <div class="page-background">
      <div class="content-card">
        <div class="lab-header" id="header-content"></div>
        <div id="desc-content" class="info-box"></div>
        <div id="members-container">
          <p style="text-align:center;">กำลังโหลด...</p>
        </div>
      </div>
  </div>

  <?php include 'includes/footer.php'; ?>

  <script src="js/lab.js"></script>
  <script src="js/script.js"></script>
</body>
</html>