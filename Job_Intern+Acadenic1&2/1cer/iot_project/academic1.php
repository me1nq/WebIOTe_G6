<?php
include "config.php";

$result = $conn->query("SELECT * FROM academic1 ORDER BY id DESC LIMIT 1");
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>IoT Engineering</title>
    <link rel="stylesheet" href="academic1.css">
</head>
<body>

<section class="hero">
    <h1>Bachelor of Engineering (IoT System and Information)</h1>
</section>

<section class="content-card">

    <h2><?= $data['title'] ?></h2>

    <div class="info-box" style="background: <?= $data['bg_color'] ?>;">
        <div class="text">
            <p><?= $data['content'] ?></p>
        </div>

        <div class="tuition">
            <p>ค่าธรรมเนียมการศึกษา</p>
            <h3><?= $data['tuition'] ?></h3>
            <span>บาท / ภาคการศึกษา</span>
        </div>
    </div>

    <?php if ($data['pdf_path']) : ?>
        <a href="<?= $data['pdf_path'] ?>" target="_blank" class="main-btn">
            ข้อมูลหลักสูตรวิศวกรรมระบบไอโอทีและสารสนเทศ
        </a>
    <?php endif; ?>

    <div class="curriculum">
        <?php if ($data['image_path']) : ?>
            <img src="<?= $data['image_path'] ?>">
        <?php endif; ?>
    </div>

</section>

</body>
</html>