<?php
require '../includes/db.php'; // เชื่อมต่อฐานข้อมูล

// -------------------------
// 1. จัดการลบคอมเมนต์ (กรณีเจอสแปม หรือคำหยาบ)
// -------------------------
if (isset($_GET['delete_review_id'])) {
    $del_id = intval($_GET['delete_review_id']);
    
    // ตรวจสอบว่าในตาราง reviews ของคุณมีคอลัมน์ id หรือไม่ (ถ้าเป็นชื่ออื่นให้แก้ตรง WHERE id)
    $sql_delete = "DELETE FROM reviews WHERE id = $del_id"; 
    
    if ($conn->query($sql_delete) === TRUE) {
        // 🚨 แก้ลิงก์เป็น faculty_reviews.php
        echo "<!DOCTYPE html><html><head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script><link href='https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap' rel='stylesheet'><style>*{font-family:\"Kanit\", sans-serif;}</style></head><body><script>Swal.fire({icon: 'success', title: 'สำเร็จ', text: 'ลบความคิดเห็นเรียบร้อยแล้ว', confirmButtonColor: '#7b68ee', confirmButtonText: 'OK'}).then(() => { window.location.href = 'admin_faculty_reviews.php'; });</script></body></html>";
        exit;
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . $conn->error . "'); window.history.back();</script>";
        exit;
    }
}

// -------------------------
// 2. ดึงรายชื่ออาจารย์มาทำ Dropdown ตัวกรอง
// -------------------------
$staff_query = $conn->query("SELECT id, name FROM personnel ORDER BY name ASC");

// -------------------------
// 3. ดึงข้อมูลคอมเมนต์ทั้งหมดมาแสดง 
// -------------------------
$sql_reviews = "SELECT r.id AS review_id, r.comment_text, p.id AS personnel_id, p.name AS personnel_name, p.image 
                FROM reviews r 
                JOIN personnel p ON r.personnel_id = p.id 
                ORDER BY r.id DESC"; // ดึงคอมเมนต์ล่าสุดขึ้นก่อน
$reviews_result = $conn->query($sql_reviews);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ดูรีวิวและความคิดเห็น - Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        body { font-family: 'Kanit', sans-serif; background-color: #f5f6fa; padding: 20px; font-weight: 300; }
        h2, h3, label, th, strong { font-weight: 500; }
        .admin-container { max-width: 1100px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 0.95rem; }
        th, td { padding: 15px 10px; border: 1px solid #ddd; text-align: left; vertical-align: middle; }
        th { background-color: #FF6F00; color: white;} 
        
        .comment-text { background: #f9f9f9; padding: 10px; border-radius: 5px; border-left: 3px solid #007bff; font-style: italic; }
        .btn-danger { background: #dc3545; color: white; padding: 8px 15px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block;}
        .btn-back { background: #FF6F00; color: white; padding: 10px 20px; border: none; border-radius: 5px; text-decoration: none; margin-bottom: 20px; display: inline-block; transition: 0.2s;}
        .btn-back:hover { background: #5a6268; }
        
        .filter-section { background-color: #e9ecef; padding: 15px; border-radius: 5px; margin-bottom: 20px; display: flex; align-items: center; flex-wrap: wrap; gap: 15px; }
        .filter-section select, .filter-section input { font-family: 'Kanit', sans-serif; padding: 8px; border-radius: 4px; border: 1px solid #ccc; }
        .filter-section select { width: 250px; }
        .filter-section input { width: 300px; } 
    </style>
</head>
<body>

<div class="admin-container">
    <a href="admin_faculty.php" class="btn-back">กลับไปหน้าจัดการบุคลากร</a>
    <h2>ระบบดูความคิดเห็น / วิจารณ์ (Reviews)</h2>
    
    <div class="filter-section">
        <label for="filterProfessor"><strong>กรองด้วยการเลือกชื่อ:</strong></label>
        <select id="filterProfessor" onchange="filterReviews()">
            <option value="all">-- ดูความคิดเห็นของทุกคน --</option>
            <?php 
            if ($staff_query->num_rows > 0) {
                while($staff = $staff_query->fetch_assoc()) {
                    echo "<option value='".$staff['id']."'>".$staff['name']."</option>";
                }
            }
            ?>
        </select>

        <label for="searchReviewInput" style="margin-left: 10px;"><strong>หรือพิมพ์ค้นหาชื่อ:</strong></label>
        <input type="text" id="searchReviewInput" onkeyup="filterReviews()" placeholder="พิมพ์ชื่ออาจารย์เพื่อค้นหา...">
    </div>

    <table>
        <thead>
            <tr>
                <th width="80">รูปภาพ</th>
                <th width="200">ชื่ออาจารย์ที่ถูกวิจารณ์</th>
                <th>ข้อความรีวิว / ความคิดเห็น</th>
                <th width="100" style="text-align: center;">จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($reviews_result && $reviews_result->num_rows > 0) {
                while($row = $reviews_result->fetch_assoc()) { 
            ?>
                <tr class="review-row" data-pid="<?php echo $row['personnel_id']; ?>" data-name="<?php echo strtolower(htmlspecialchars($row['personnel_name'])); ?>">
                    <td>
                        <img src="../<?php echo htmlspecialchars($row['image']); ?>" width="60" height="60" style="object-fit: cover; border-radius: 50%;" onerror="this.src=''; this.style.backgroundColor='#ccc';">
                    </td>
                    <td><strong><?php echo htmlspecialchars($row['personnel_name']); ?></strong></td>
                    <td>
                        <div class="comment-text">
                            "<?php echo nl2br(htmlspecialchars($row['comment_text'])); ?>"
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <a href="#" onclick="confirmDeleteReview(<?php echo $row['review_id']; ?>); return false;" class="btn-danger">ลบ</a>
                    </td>
                </tr>
            <?php } 
            } else { ?>
                <tr id="noDataRow"><td colspan="4" style="text-align: center; padding: 30px;">ยังไม่มีใครแสดงความคิดเห็นในระบบ</td></tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
function filterReviews() {
    let filterVal = document.getElementById("filterProfessor").value;
    let searchVal = document.getElementById("searchReviewInput").value.toLowerCase();
    let rows = document.querySelectorAll(".review-row");
    
    rows.forEach(row => {
        let pid = row.getAttribute("data-pid");
        let name = row.getAttribute("data-name");
        
        let matchDropdown = (filterVal === "all" || filterVal === pid);
        let matchSearch = (name.includes(searchVal));
        
        if (matchDropdown && matchSearch) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}

function confirmDeleteReview(reviewId) {
    Swal.fire({
        title: 'ลบความคิดเห็นนี้?',
        text: "คุณไม่สามารถกู้คืนข้อมูลนี้ได้!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'ใช่, ลบเลย!',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            // 🚨 แก้ลิงก์เป็น faculty_reviews.php
            window.location.href = 'admin_faculty_reviews.php?delete_review_id=' + reviewId;
        }
    });
}
</script>

</body>
</html>