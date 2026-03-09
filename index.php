<?php 
session_start(); 
include 'includes/db.php'; 

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$res = mysqli_query($conn, "SELECT * FROM home_detail WHERE id = 1");

if ($res && mysqli_num_rows($res) > 0) {
    $data = mysqli_fetch_assoc($res);
} else {
    $data = ['content' => 'ยังไม่มีข้อมูลในระบบ'];
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
    
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="hero-slider">
        <div class="slider-container">
            <div class="slide active" style="background-image: url('assets/hero1.jpg');"></div>
            <div class="slide" style="background-image: url('assets/hero2.jpg');"></div>
            <div class="slide" style="background-image: url('assets/hero3.jpg');"></div>
        </div>
        
        <div class="hero-overlay">
            <div class="hero-content">
                <h1>Department of IoT and Information Engineering</h1>
                <p>King Mongkut's Institute of Technology Ladkrabang</p>
            </div>
        </div>
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
                            <a href="admin/index_edit.php" style="display:inline-block; margin-top:20px; color: #ff6600; font-weight:bold;">
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

                <div class="community-action">
                    <div class="announcement-title-box">Announcement</div>
                </div>

                <div class="community-main-grid">
                    <div class="news-column">
                        <?php
                        $news_res = mysqli_query($conn, "SELECT * FROM announcements ORDER BY date_posted DESC");
                        while($news = mysqli_fetch_assoc($news_res)):
                        ?>
                        <div class="news-card-item">
                            <div class="news-img-box">
                                <img src="assets/<?php echo $news['image_path']; ?>" alt="ข่าวสาร">
                            </div>
                            <div class="news-content-box">
                                <p class="news-meta"><i class="far fa-calendar-alt"></i> <?php echo date('j ม.ค. Y', strtotime($news['date_posted'])); ?></p>
                                <h3><?php echo $news['title']; ?></h3>
                                <p class="news-excerpt"><?php echo mb_strimwidth($news['content'], 0, 150, "..."); ?></p>
                                <div class="news-tags-row">
                                    <?php 
                                    $tags = explode(',', $news['tags']);
                                    foreach($tags as $tag) echo "<span>" . trim($tag) . "</span>";
                                    ?>
                                </div>
                                <a href="#" class="news-readmore-btn">อ่านเพิ่มเติม →</a>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>

                    <div class="sidebar-column">
                        <div class="sidebar-block announcement-list">
                            <h3>ประกาศสำคัญ</h3>
                            <ul>
                                <li>กำหนดการสอบกลางภาคการศึกษา 2/2568</li>
                                <li>Workshop: IoT Development with Arduino</li>
                            </ul>
                            <a href="#" class="link-view-all" style="color:#FF6F00; font-weight:bold; display:block; text-align:right;">ดูประกาศทั้งหมด →</a>
                        </div>

                        <div class="sidebar-block event-calendar">
                            <h3 style="color:#fff; border-bottom: 2px solid #fff;">ปฏิทินกิจกรรม</h3>
                            <div class="event-row">
                                <div class="event-pill">15-25 ม.ค. 2569</div>
                                <p>สอบกลางภาค</p>
                            </div>
                            <div class="event-row">
                                <div class="event-pill">28 ม.ค. 2569</div>
                                <p>IoT Workshop</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="community-banners">
                    <a href="internship.php" class="banner-item internship-banner">
                        <div class="banner-text-wrap">
                            <h2>Internship Experience</h2>
                        </div>
                    </a>

                    <a href="projects.php" class="banner-item projects-banner">
                        <div class="banner-text-wrap">
                            <h2>Projects Inventory</h2>
                        </div>
                    </a>
                </div>

                <div class="gallery-slider-container">
                    <div class="gallery-slider">
                        <?php
                        $gallery_res = mysqli_query($conn, "SELECT * FROM gallery");
                        if ($gallery_res && mysqli_num_rows($gallery_res) > 0) {
                            $first = true;
                            while($img = mysqli_fetch_assoc($gallery_res)) {
                                // เพิ่มคลาส active ให้รูปแรกเพื่อให้แสดงผลทันที
                                $active_class = $first ? 'active' : '';
                                echo '<div class="gallery-slide ' . $active_class . '">';
                                echo '  <img src="assets/'.$img['image_path'].'" alt="gallery">';
                                
                                // ปุ่มแก้ไขสำหรับ Admin (ถ้ามี Session)
                                if(isset($_SESSION['is_admin'])) {
                                    echo '  <a href="admin/admin_index.php?id='.$img['id'].'" class="edit-overlay-gallery">แก้ไขรูป</a>';
                                }
                                echo '</div>';
                                $first = false;
                            }
                        } else {
                            echo '<p style="text-align:center; padding:50px; color:#999;">ยังไม่มีภาพในแกลลอรี</p>';
                        }
                        ?>
                    </div>
                </div>
        </div>
    </div> 
        <?php include 'includes/footer.php'; ?>
    <script src="js/script.js"></script>
    <script src="js/index.js"></script>
</body>
</html>