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
  
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/lab.css">
</head>
<body>

  <?php include 'includes/navbar.php'; ?>

  <div class="page-header">
      Cybersecurity Laboratory
  </div>

  <div class="page-background">
      <div class="content-card">
        <div class="lab-header" id="header-content"></div>
        
        <div class="lab-intro-section">
          <div id="desc-content" class="lab-description-text"></div>
        </div>

        <hr class="minimal-divider">
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