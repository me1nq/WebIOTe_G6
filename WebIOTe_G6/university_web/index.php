<?php
require 'db.php'; // เรียกใช้ไฟล์เชื่อมต่อฐานข้อมูล

// 🚨 ดึงข้อมูลโดยกรองเอาเฉพาะคนที่เป็น 'iot'
$sql = "SELECT * FROM personnel WHERE program = 'iot' ORDER BY id ASC";
$result = $conn->query($sql);

$all_staff = [];
if ($result->num_rows > 0) {
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
    <title>Faculty Member - Department of IoT</title>
    <link rel="stylesheet" href="style.css">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* สไตล์สำหรับสร้าง Scrollbar ใน Pop-up */
        .modal-scroll-area {
            max-height: 45vh; 
            overflow-y: auto; 
            padding-right: 15px; 
            margin-bottom: 15px;
        }
        
        .modal-scroll-area::-webkit-scrollbar { width: 6px; }
        .modal-scroll-area::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 4px; }
        .modal-scroll-area::-webkit-scrollbar-thumb { background: #ccc; border-radius: 4px; }
        .modal-scroll-area::-webkit-scrollbar-thumb:hover { background: #FF6F00; }

        .research-display { background-color: #f9f9f9; padding: 15px; border-radius: 8px; margin-bottom: 10px; border-left: 4px solid #FF6F00; }
        
        .research-cover {
            max-height: 180px; 
            width: auto; 
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-top: 10px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .research-cover:hover { transform: scale(1.02); }
        
        /* เสริมให้ตัวอักษรใน SweetAlert เป็น Kanit */
        .swal2-container { font-family: 'Kanit', sans-serif; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Faculty Member in the Department of IoT and Information Engineering</h1>
        <h2>คณาจารย์ภาควิชาวิศวกรรมไอโอทีและสารสนเทศ</h2> 

        <div class="faculty-group">
            <?php 
            foreach($all_staff as $member) { 
                if($member['type'] == 'faculty') { 
            ?>
            <div class="card" style="cursor: pointer;" 
                 onclick="openModal(this)" 
                 data-id="<?php echo $member['id']; ?>"
                 data-name="<?php echo htmlspecialchars($member['name']); ?>" 
                 data-role="<?php echo htmlspecialchars($member['role']); ?>" 
                 data-popup-role="<?php echo htmlspecialchars($member['popup_role'] ?? ''); ?>" 
                 data-history="<?php echo htmlspecialchars($member['history']); ?>"
                 data-image="<?php echo htmlspecialchars($member['image']); ?>"
                 data-research="<?php echo htmlspecialchars($member['research'] ?? ''); ?>"
                 data-research-link="<?php echo htmlspecialchars($member['research_link'] ?? ''); ?>"
                 data-research-image="<?php echo htmlspecialchars($member['research_image'] ?? ''); ?>">
                 
                <img src="<?php echo htmlspecialchars($member['image']); ?>" class="profile-img" style="object-fit: cover;" alt="Profile Image" onerror="this.src=''; this.style.backgroundColor='#66ff33';">
                <div class="card-info">
                    <p class="name"><?php echo htmlspecialchars($member['name']); ?></p>
                    <p class="role"><?php echo htmlspecialchars($member['role']); ?></p> 
                </div>
            </div>
            <?php 
                } 
            } 
            ?>
        </div>

        <br><br>

        <h2>บุคลากรภาควิชาวิศวกรรมไอโอทีและสารสนเทศ</h2>
        <div class="faculty-group">
            <?php 
            foreach($all_staff as $member) { 
                if($member['type'] == 'staff') { 
            ?>
            <div class="card" style="cursor: pointer;" 
                 onclick="openModal(this)" 
                 data-id="<?php echo $member['id']; ?>"
                 data-name="<?php echo htmlspecialchars($member['name']); ?>" 
                 data-role="<?php echo htmlspecialchars($member['role']); ?>" 
                 data-popup-role="<?php echo htmlspecialchars($member['popup_role'] ?? ''); ?>"
                 data-history="<?php echo htmlspecialchars($member['history']); ?>"
                 data-image="<?php echo htmlspecialchars($member['image']); ?>"
                 data-research="<?php echo htmlspecialchars($member['research'] ?? ''); ?>"
                 data-research-link="<?php echo htmlspecialchars($member['research_link'] ?? ''); ?>"
                 data-research-image="<?php echo htmlspecialchars($member['research_image'] ?? ''); ?>">
                 
                <img src="<?php echo htmlspecialchars($member['image']); ?>" class="profile-img" style="object-fit: cover;" alt="Profile Image" onerror="this.src=''; this.style.backgroundColor='#66ff33';">
                <div class="card-info">
                    <p class="name"><?php echo htmlspecialchars($member['name']); ?></p>
                    <p class="role"><?php echo htmlspecialchars($member['role']); ?></p> 
                </div>
            </div>
            <?php 
                } 
            } 
            ?>
        </div>

    </div>

    <div id="facultyModal" class="modal-overlay" onclick="closeModal(event)">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal(event, true)">&times;</span>
            <div class="modal-header">
                <img id="modalImage" src="" class="profile-img modal-img" style="object-fit: cover;" alt="Profile Image">
                <div>
                    <h3 id="modalName">ชื่ออาจารย์</h3>
                    <p id="modalRole" style="color: #FF6F00; font-size: 0.9rem; margin-top: 5px; font-weight: 500;">ตำแหน่ง</p>
                </div>
            </div>
            <hr>
            
            <div class="modal-scroll-area">
                <h4 style="margin-top: 0;">ประวัติและผลงาน:</h4>
                <p id="modalHistory" style="margin-bottom: 20px; white-space: pre-line; line-height: 1.6; color: #444;">รายละเอียดประวัติ...</p>
                
                <div id="researchSection" class="research-display" style="display: none;">
                    <h4 style="margin-top: 0; color: #FF6F00;">📚 งานวิจัยที่โดดเด่น:</h4>
                    <p id="modalResearchDesc" style="margin-bottom: 10px; font-size: 0.95rem; line-height: 1.5; color: #444;"></p>
                    
                    <a id="modalResearchLink" href="#" target="_blank" style="display: none; text-align: center;">
                        <img id="modalResearchImg" src="" class="research-cover" alt="หน้าปกงานวิจัย" title="คลิกเพื่ออ่านงานวิจัยฉบับเต็ม">
                        <p style="font-size: 0.8rem; color: #888; margin-top: 5px;">(คลิกที่รูปเพื่อเปิดดูรายละเอียด)</p>
                    </a>
                </div>
            </div>
            <hr>
            
            <div class="comment-section">
                <h4 style="margin-top: 0;">แสดงความคิดเห็น / วิจารณ์:</h4>
                <form onsubmit="submitComment(event)">
                    <input type="hidden" id="personnelId">
                    <textarea class="comment-box" id="commentText" placeholder="เขียนความคิดเห็นของคุณที่นี่..." required></textarea>
                    <button type="submit" class="submit-btn">ส่งความคิดเห็น</button>
                </form>
            </div>

        </div>
    </div>

    <script>
        function openModal(element) {
            document.getElementById('personnelId').value = element.getAttribute('data-id');
            document.getElementById('modalName').innerText = element.getAttribute('data-name');
            
            let popupRole = element.getAttribute('data-popup-role');
            let mainRole = element.getAttribute('data-role');
            document.getElementById('modalRole').innerText = popupRole ? popupRole : mainRole;

            document.getElementById('modalHistory').innerText = element.getAttribute('data-history');
            document.getElementById('modalImage').src = element.getAttribute('data-image');
            
            let resDesc = element.getAttribute('data-research');
            let resLink = element.getAttribute('data-research-link');
            let resImg = element.getAttribute('data-research-image');
            
            let researchSection = document.getElementById('researchSection');
            let descElement = document.getElementById('modalResearchDesc');
            let linkWrapper = document.getElementById('modalResearchLink');
            let imgElement = document.getElementById('modalResearchImg');

            if ((resDesc && resDesc.trim() !== '') || (resImg && resImg.trim() !== '')) {
                researchSection.style.display = 'block';
                descElement.innerText = resDesc ? resDesc : '';

                if (resImg && resImg.trim() !== '') {
                    imgElement.src = resImg;
                    linkWrapper.style.display = 'block'; 
                    
                    if (resLink && resLink.trim() !== '') {
                        linkWrapper.href = resLink;
                        linkWrapper.style.cursor = 'pointer';
                    } else {
                        linkWrapper.removeAttribute('href');
                        linkWrapper.style.cursor = 'default';
                    }
                } else {
                    linkWrapper.style.display = 'none'; 
                }
            } else {
                researchSection.style.display = 'none';
            }

            document.getElementById('commentText').value = ''; 
            document.getElementById('facultyModal').style.display = 'flex';
        }

        function closeModal(event, forceClose = false) {
            if (forceClose || event.target.className === 'modal-overlay') {
                document.getElementById('facultyModal').style.display = 'none';
            }
        }

        // 🚨 2. แก้ไขฟังก์ชันให้ใช้ SweetAlert2
        async function submitComment(event) {
            event.preventDefault(); 
            const p_id = document.getElementById('personnelId').value;
            const comment = document.getElementById('commentText').value;

            let formData = new FormData();
            formData.append('personnel_id', p_id);
            formData.append('comment_text', comment);

            try {
                let response = await fetch('save_comment.php', { method: 'POST', body: formData });
                let result = await response.text();
                
                if(result === "success") {
                    // ปิด Modal ก่อนโชว์ Alert จะได้ดูคลีน
                    closeModal(event, true); 
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'สำเร็จ',
                        text: 'ส่งความคิดเห็นของคุณเรียบร้อยแล้ว ขอบคุณครับ!',
                        confirmButtonColor: '#007bff'
                    });
                    
                    document.getElementById('commentText').value = ''; 
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: result,
                        confirmButtonColor: '#dc3545'
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'เชื่อมต่อเซิร์ฟเวอร์ไม่ได้',
                    text: error,
                    confirmButtonColor: '#dc3545'
                });
            }   
        }
    </script>

</body>
</html>