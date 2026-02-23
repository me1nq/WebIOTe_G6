<?php
$conn = new mysqli("localhost","root","","university_db");
$result = $conn->query("SELECT * FROM internships ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ประสบการณ์ฝึกงาน</title>
    <link rel="stylesheet" href="Internship.css">
</head>
<body>

<header>
    <h1>ประสบการณ์ฝึกงาน</h1>
    <p>Internship Experience</p>
</header>

<section class="container">

<?php while($row = $result->fetch_assoc()): ?>

    <?php
        $details = explode(",", $row['details']);
    ?>

    <div class="card">
        <img src="uploads/<?= $row['image'] ?>">
        <div class="content">
            <h2><?= htmlspecialchars($row['company']) ?></h2>
            <div class="position"><?= htmlspecialchars($row['position']) ?></div>
            <div class="date"><?= htmlspecialchars($row['date_range']) ?></div>

            <button onclick="this.nextElementSibling.style.maxHeight='500px'">
                ดูรายละเอียด
            </button>

            <div class="detail">
                <ul>
                    <?php foreach($details as $d): ?>
                        <li><?= trim(htmlspecialchars($d)) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

<?php endwhile; ?>

</section>

</body>
</html>