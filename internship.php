<?php 
session_start(); 
include 'includes/db.php'; // แนะนำให้ใช้ไฟล์เชื่อมต่อกลางแบบหน้าอื่นๆ
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประสบการณ์ฝึกงาน | IoT Engineering</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="css/style.css"> <link rel="stylesheet" href="css/Internship.css"> </head>
<body>

    <?php include 'includes/navbar.php'; ?> <div class="page-header">
        Internship Experience
    </div>

    <div class="page-background">
        <div class="content-card">
            
            <section class="container" style="width: 100%; margin: 0;">
                <?php 
                $result = $conn->query("SELECT * FROM internships ORDER BY id DESC");
                while($row = $result->fetch_assoc()): 
                    $details = explode(",", $row['details']);
                ?>
                    <div class="card">
                        <img src="assets/internship/<?= $row['image'] ?>">
                        <div class="content">
                            <h2><?= htmlspecialchars($row['company']) ?></h2>
                            <div class="position"><?= htmlspecialchars($row['position']) ?></div>
                            <div class="date"><?= htmlspecialchars($row['date_range']) ?></div>

                            <button onclick="this.nextElementSibling.style.maxHeight='500px'">
                                ดูรายละเอียด
                            </button>

                            <div class="detail">
                                <p class="detail-text">
                                    <?= nl2br(htmlspecialchars(implode("\n", $details))) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </section>

        </div>
    </div>

    <?php include 'includes/footer.php'; ?> <script src="js/script.js"></script>
</body>
</html>