<?php
session_start();
include 'includes/db.php'; // 🔴 เชื่อมฐานข้อมูลหลัก

// ดึงเฉพาะอาจารย์ Science (Physics)
$sql = "SELECT * FROM personnel WHERE program = 'science' ORDER BY id ASC";
$result = $conn->query($sql);

$all_staff = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $all_staff[] = $row; 
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Member - Physics & IoT</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/style.css?v=3">
    <link rel="stylesheet" href="css/faculty.css?v=1">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <?php include 'includes/navbar.php'; ?>

    <div class="page-header">
        Professor of Industrial Physics
    </div>

    <div class="page-background">
        <div class="content-card">

            <h2 class="faculty-title">คณะอาจารย์หลักสูตรฟิสิกส์อุตสาหกรรม</h2> 

            <div class="faculty-group">
                <?php 
                if(count($all_staff) == 0) {
                    echo "<p style='color: #888;'>ยังไม่มีข้อมูลในระบบ กรุณาเพิ่มข้อมูลผ่านหน้า Admin</p>";
                }

                foreach($all_staff as $member) { 
                    if($member['type'] == 'faculty') { 
                ?>
                <div class="card" onclick="openModal(this)" 
                     data-id="<?= $member['id'] ?>"
                     data-name="<?= htmlspecialchars($member['name']) ?>" 
                     data-role="<?= htmlspecialchars($member['role']) ?>" 
                     data-popup-role="<?= htmlspecialchars($member['popup_role'] ?? '') ?>" 
                     data-history="<?= htmlspecialchars($member['history']) ?>"
                     data-image="<?= htmlspecialchars($member['image']) ?>"
                     data-research="<?= htmlspecialchars($member['research'] ?? '') ?>"
                     data-research-link="<?= htmlspecialchars($member['research_link'] ?? '') ?>"
                     data-research-image="<?= htmlspecialchars($member['research_image'] ?? '') ?>">
                     
                    <img src="<?= htmlspecialchars($member['image']) ?>" class="profile-img" alt="Profile Image" onerror="this.src=''; this.style.backgroundColor='#66ff33';">
                    <div class="card-info">
                        <p class="name"><?= htmlspecialchars($member['name']) ?></p>
                        <p class="role"><?= htmlspecialchars($member['role']) ?></p> 
                    </div>
                </div>
                <?php } } ?>
            </div>

            <br><br><br>

            <h2 class="faculty-title">บุคลากรหลักสูตรฟิสิกส์อุตสาหกรรม</h2>
            <div class="faculty-group">
                <?php 
                foreach($all_staff as $member) { 
                    if($member['type'] == 'staff') { 
                ?>
                <div class="card" onclick="openModal(this)" 
                     data-id="<?= $member['id'] ?>"
                     data-name="<?= htmlspecialchars($member['name']) ?>" 
                     data-role="<?= htmlspecialchars($member['role']) ?>" 
                     data-popup-role="<?= htmlspecialchars($member['popup_role'] ?? '') ?>"
                     data-history="<?= htmlspecialchars($member['history']) ?>"
                     data-image="<?= htmlspecialchars($member['image']) ?>"
                     data-research="<?= htmlspecialchars($member['research'] ?? '') ?>"
                     data-research-link="<?= htmlspecialchars($member['research_link'] ?? '') ?>"
                     data-research-image="<?= htmlspecialchars($member['research_image'] ?? '') ?>">
                     
                    <img src="<?= htmlspecialchars($member['image']) ?>" class="profile-img" alt="Profile Image" onerror="this.src=''; this.style.backgroundColor='#66ff33';">
                    <div class="card-info">
                        <p class="name"><?= htmlspecialchars($member['name']) ?></p>
                        <p class="role"><?= htmlspecialchars($member['role']) ?></p> 
                    </div>
                </div>
                <?php } } ?>
            </div>

        </div> 
    </div>

    <div id="facultyModal" class="modal-overlay" onclick="closeModal(event)">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal(event, true)">&times;</span>
            <div class="modal-header">
                <img id="modalImage" src="" class="profile-img modal-img" alt="Profile Image">
                <div>
                    <h3 id="modalName">ชื่ออาจารย์</h3>
                    <p id="modalRole" style="color: #FF6F00; font-size: 0.9rem; margin-top: 5px; font-weight: 500;">ตำแหน่ง</p>
                </div>
            </div>
            <hr style="border:0; border-top:1px solid #eee; margin-bottom:15px;">
            
            <div class="modal-scroll-area">
                <h4 style="margin-top: 0; color: #333;">ประวัติและผลงาน:</h4>
                <p id="modalHistory" style="margin-bottom: 20px; white-space: pre-line; line-height: 1.6; color: #555; font-size: 15px;">รายละเอียดประวัติ...</p>
                
                <div id="researchSection" class="research-display" style="display: none;">
                    <h4 style="margin-top: 0; color: #FF6F00;">📚 งานวิจัยที่โดดเด่น:</h4>
                    <p id="modalResearchDesc" style="margin-bottom: 10px; font-size: 0.95rem; line-height: 1.5; color: #444;"></p>
                    
                    <a id="modalResearchLink" href="#" target="_blank" style="display: none; text-align: center;">
                        <img id="modalResearchImg" src="" class="research-cover" alt="หน้าปกงานวิจัย" title="คลิกเพื่ออ่านงานวิจัยฉบับเต็ม">
                        <p style="font-size: 0.8rem; color: #888; margin-top: 5px;">(คลิกที่รูปเพื่อเปิดดูรายละเอียด)</p>
                    </a>
                </div>
            </div>
            <?php 
            if(isset($_SESSION['user_id'])): 
            ?>
            <hr style="border:0; border-top:1px solid #eee; margin-bottom:15px;">
            <div class="comment-section">
                <h4 style="margin-top: 0; color: #333;">แสดงความคิดเห็น / วิจารณ์:</h4>
                <form onsubmit="submitComment(event)">
                    <input type="hidden" id="personnelId">
                    <textarea class="comment-box" id="commentText" placeholder="เขียนความคิดเห็นของคุณที่นี่..." required></textarea>
                    <button type="submit" class="submit-btn">ส่งความคิดเห็น</button>
                </form>
            </div>
            <?php endif;?>

        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="js/faculty.js"></script>
    <script src="js/script.js"></script>
</body>
</html>