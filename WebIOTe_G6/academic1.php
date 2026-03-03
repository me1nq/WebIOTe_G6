<?php
session_start();
include 'includes/db.php'; 

$result = $conn->query("SELECT * FROM academic1 ORDER BY id DESC LIMIT 1");
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academics - IoTe</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/academic.css">
</head>
<body>

    <?php include 'includes/navbar.php'; ?>

    <div class="page-header">
        Bachelor of Engineering (IoT System and Information)
    </div>

    <div class="page-background">
        <div class="content-card">

            <h2 class="academic-title"><?= htmlspecialchars($data['title'] ?? 'ยังไม่มีข้อมูล') ?></h2>

            <div class="info-box" style="background-color: <?= htmlspecialchars($data['bg_color'] ?? '#f4b183') ?>">
                
                <div class="text">
                    <?= nl2br(htmlspecialchars($data['content'] ?? 'ยังไม่มีเนื้อหาในระบบ')) ?>
                </div>

                <div class="tuition">
                    <p>ค่าธรรมเนียมการศึกษา</p>
                    <h3><?= number_format((float)($data['tuition'] ?? 0)) ?></h3>
                    <span>บาท / ภาคการศึกษา</span>
                </div>

            </div>

            <div class="button-group">
                <?php if (!empty($data['pdf_path'])) : ?>
                    <a href="<?= htmlspecialchars($data['pdf_path']) ?>" target="_blank" class="main-btn">
                        ข้อมูลหลักสูตรวิศวกรรมระบบไอโอทีและสารสนเทศ
                    </a>
                <?php endif; ?>
            </div>

            <div class="curriculum">
                <?php if (!empty($data['image_path'])) : ?>
                    <img src="<?= htmlspecialchars($data['image_path']) ?>" alt="แผนการศึกษา">
                <?php endif; ?>
            </div>

        </div> </div> <?php include 'includes/footer.php'; ?>

    <script src="js/script.js"></script>
</body>
</html>