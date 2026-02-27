<?php
$conn = new mysqli("localhost", "root", "", "university_db");
$result = $conn->query("SELECT * FROM academic1 ORDER BY id DESC LIMIT 1");
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IoT Engineering</title>
<link rel="stylesheet" href="academic1.css">
</head>
<body>

<section class="hero">
    <h1>Bachelor of Engineering (IoT System and Information)</h1>
</section>

<section class="content-card">

    <h2><?= htmlspecialchars($data['title'] ?? '') ?></h2>

    <div class="info-box" 
         style="background-color: <?= $data['bg_color'] ?? '#f4b183' ?>">

        <div class="text">
            <?= nl2br(htmlspecialchars($data['content'] ?? '')) ?>
        </div>

        <div class="tuition">
            <p>ค่าธรรมเนียมการศึกษา</p>
            <h3><?= htmlspecialchars($data['tuition'] ?? '0') ?></h3>
            <span>บาท / ภาคการศึกษา</span>
        </div>

    </div>

    <div class="button-group">
        <?php if (!empty($data['pdf_path'])) : ?>
            <a href="<?= $data['pdf_path'] ?>" target="_blank" class="main-btn">
                ข้อมูลหลักสูตรวิศวกรรมระบบไอโอทีและสารสนเทศ
            </a>
        <?php endif; ?>
    </div>

    <div class="curriculum">
        <?php if (!empty($data['image_path'])) : ?>
            <img src="<?= $data['image_path'] ?>">
        <?php endif; ?>
    </div>

</section>

</body>
</html>