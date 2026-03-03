<?php 
session_start(); 
include 'includes/db.php'; 

// เพิ่มการเช็คการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$res = mysqli_query($conn, "SELECT * FROM home_detail WHERE id = 1");

// เช็คว่ามีข้อมูลไหมก่อนจะ fetch
if ($res && mysqli_num_rows($res) > 0) {
    $data = mysqli_fetch_assoc($res);
} else {
    $data = ['content' => 'ยังไม่มีข้อมูลในระบบ']; // กันเหนียวไว้ก่อน
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IoT Engineering</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="page-header">
        Department of IoT and Information Engineering
    </div>

    <div class="page-background">
        <div class="content-card">
            
            <div class="info-grid">
                <div class="content-left">
                    <h1>IoT and Information Engineering</h1>
                    <div class="description-iot">
                        <?php echo nl2br($data['content']); ?>
                    </div>
                    
                    <?php if(isset($_SESSION['is_admin'])): ?>
                        <a href="admin/edit_index.php" style="display:inline-block; margin-top:20px; color: #ff6600; font-weight:bold;">
                            [ Edit Content ]
                        </a>
                    <?php endif; ?>

                    <a href="admission.php" class="btn-admission">
                        <span>กดเพื่อดูรายละเอียดการสมัคร</span>
                        <div class="btn-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="4" y="2" width="16" height="20" rx="2" stroke="black" stroke-width="2"/>
                                <path d="M8 8H16" stroke="black" stroke-width="2" stroke-linecap="round"/>
                                <path d="M8 12H16" stroke="black" stroke-width="2" stroke-linecap="round"/>
                                <path d="M8 16H12" stroke="black" stroke-width="2" stroke-linecap="round"/>
                                <circle cx="16" cy="16" r="4" fill="black"/>
                                <path d="M14.5 16H17.5M16 14.5V17.5" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </a>
                </div> <div class="stats-right">
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-header">
                                <img src="assets/icon1.png" alt="icon" class="stat-img">
                            </div>
                            <div class="stat-desc">ปริญญาตรี วิศวกรรมศาสตรบัณฑิต (วิศวกรรมไอโอทีและสารสนเทศ)</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-header">
                                <img src="assets/icon2.png" alt="icon" class="stat-img">
                            </div>
                            <div class="stat-desc">วศ.บ. ฟิสิกส์อุตสาหกรรม และ วศ.บ. วิศวกรรมระบบไอโอทีและสารสนเทศ (หลักสูตรสองปริญญา)</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-header">
                                <img src="assets/icon3.png" alt="icon" class="stat-img">
                            </div>
                            <div class="stat-desc">ปริญญาตรี วิศวกรรมศาสตรบัณฑิต (คอมพิวเตอร์และไอโอที) หลักสูตรต่อเนื่อง</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-header">
                                <img src="assets/icon4.png" alt="icon" class="stat-img">
                            </div>
                            <div class="stat-desc">ปริญญาโท วิศวกรรมศาสตรมหาบัณฑิต (ไอโอทีและสารสนเทศ) และปริญญาเอก ปรัชญาดุษฎีบัณฑิต</div>
                        </div>
                    </div>
                </div>
            </div>

            <div style="text-align:center; margin-top: 50px;">
                <h2 style="text-decoration: underline; text-underline-offset: 8px; color: #000;">The secret of success</h2>
            </div>

            <h2 class="section-title" style="color: #000;">ภาพบรรยากาศ</h2>
            <div class="image-grid">
                <?php
                $gallery_res = mysqli_query($conn, "SELECT * FROM gallery");
                if ($gallery_res) {
                    while($img = mysqli_fetch_assoc($gallery_res)) {
                        echo '<div class="grid-item">';
                        echo '  <img src="assets/'.$img['image_path'].'" alt="gallery">';
                        if(isset($_SESSION['is_admin'])) {
                            echo '  <a href="admin/edit_gallery.php?id='.$img['id'].'" class="edit-overlay">แก้ไขรูป</a>';
                        }
                        echo '</div>';
                    }
                }
                ?>
            </div>
            </div> </div> <?php include 'includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>