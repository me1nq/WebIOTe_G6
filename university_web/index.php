<?php
require 'db.php'; // เรียกใช้ไฟล์เชื่อมต่อฐานข้อมูล

// 🚨 ดึงข้อมูลโดยกรองเอาเฉพาะคนที่เป็น 'iot' (เพิ่ม WHERE program = 'iot')
$sql = "SELECT * FROM personnel WHERE program = 'iot' ORDER BY id ASC";
$result = $conn->query($sql);

$all_staff = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $all_staff[] = $row; // เอาข้อมูลจาก DB มายัดใส่ Array อัตโนมัติ
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
                 data-image="<?php echo htmlspecialchars($member['image']); ?>">
                 
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
                 data-image="<?php echo htmlspecialchars($member['image']); ?>">
                 
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
                    <p id="modalRole" style="color: #d1563e; font-size: 0.9rem; margin-top: 5px;">ตำแหน่ง</p>
                </div>
            </div>
            <hr>
            <h4>ประวัติและผลงาน:</h4>
            <p id="modalHistory" style="margin-bottom: 20px;">รายละเอียดประวัติ...</p>
            
            <hr>
            
            <div class="comment-section">
                <h4>แสดงความคิดเห็น / วิจารณ์:</h4>
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
            // รับค่า ID มาซ่อนไว้ใน Form
            document.getElementById('personnelId').value = element.getAttribute('data-id');
            document.getElementById('modalName').innerText = element.getAttribute('data-name');
            
            // ตรรกะ: ถ้าอาจารย์คนนี้มี popup_role ให้ใช้ค่า popup_role แต่ถ้าเว้นว่างไว้ ให้ดึง role ธรรมดามาโชว์แทน
            let popupRole = element.getAttribute('data-popup-role');
            let mainRole = element.getAttribute('data-role');
            document.getElementById('modalRole').innerText = popupRole ? popupRole : mainRole;

            document.getElementById('modalHistory').innerText = element.getAttribute('data-history');
            document.getElementById('modalImage').src = element.getAttribute('data-image');
            
            document.getElementById('commentText').value = ''; 
            document.getElementById('facultyModal').style.display = 'flex';
        }

        function closeModal(event, forceClose = false) {
            if (forceClose || event.target.className === 'modal-overlay') {
                document.getElementById('facultyModal').style.display = 'none';
            }
        }

        async function submitComment(event) {
            event.preventDefault(); 
            const p_id = document.getElementById('personnelId').value;
            const comment = document.getElementById('commentText').value;

            let formData = new FormData();
            formData.append('personnel_id', p_id);
            formData.append('comment_text', comment);

            try {
                let response = await fetch('save_comment.php', {
                    method: 'POST',
                    body: formData
                });
                
                let result = await response.text();
                
                if(result === "success") {
                    alert("บันทึกความคิดเห็นสำเร็จ!");
                    document.getElementById('commentText').value = ''; 
                    closeModal(event, true); 
                } else {
                    alert("เกิดข้อผิดพลาด: " + result);
                }

            } catch (error) {
                alert("เชื่อมต่อเซิร์ฟเวอร์ไม่ได้: " + error);
            }
        }
    </script>

</body>
</html>