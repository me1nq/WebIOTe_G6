<?php
require '../includes/db.php';

if (isset($_GET['delete_review_id'])) {
    $del_id = intval($_GET['delete_review_id']);
    
    $sql_delete = "DELETE FROM reviews WHERE id = $del_id"; 
    
    if ($conn->query($sql_delete) === TRUE) {
        echo "<!DOCTYPE html><html><head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script><link href='https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap' rel='stylesheet'><style>*{font-family:\"Kanit\", sans-serif;}</style></head><body><script>Swal.fire({icon: 'success', title: 'สำเร็จ', text: 'ลบความคิดเห็นเรียบร้อยแล้ว', confirmButtonColor: '#7b68ee', confirmButtonText: 'OK'}).then(() => { window.location.href = 'admin_faculty_reviews.php'; });</script></body></html>";
        exit;
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . $conn->error . "'); window.history.back();</script>";
        exit;
    }
}

$staff_query = $conn->query("SELECT id, name FROM personnel ORDER BY name ASC");

$sql_reviews = "SELECT r.id AS review_id, r.comment_text, p.id AS personnel_id, p.name AS personnel_name, p.image 
                FROM reviews r 
                JOIN personnel p ON r.personnel_id = p.id 
                ORDER BY r.id DESC"; 
$reviews_result = $conn->query($sql_reviews);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ดูรีวิวและความคิดเห็น - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/admin_sidebar.css">
    <link rel="stylesheet" href="../css/admin_faculty_reviews.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="admin-main-content">
    <div class="admin-container">
        
        <div class="top-panel" style="padding-bottom: 25px;">
            <div class="top-header" style="border-bottom:none; padding-bottom:0;">
                <h3 style="margin:0; color:#4a4a4a;">ระบบดูความคิดเห็น / วิจารณ์ (Reviews)</h3>
                <div class="top-actions">
                    <a href="admin_faculty.php" class="btn btn-cancel"><i class="fas fa-arrow-left"></i> กลับไปหน้าจัดการบุคลากร</a>
                </div>
            </div>
        </div>

        <div class="table-container">
            <div style="display: flex; gap: 10px; margin-bottom: 20px; background: #fafafa; padding: 15px; border-radius: 8px; border: 1px solid #eee;">
                <div class="form-group" style="margin:0; flex:1;">
                    <label style="margin-bottom: 5px; font-size: 0.9rem;">กรองด้วยการเลือกชื่อ:</label>
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
                </div>
                <div class="form-group" style="margin:0; flex:2;">
                    <label style="margin-bottom: 5px; font-size: 0.9rem;">หรือพิมพ์ค้นหาชื่อ:</label>
                    <input type="text" id="searchReviewInput" onkeyup="filterReviews()" placeholder="พิมพ์ชื่ออาจารย์เพื่อค้นหา...">
                </div>
            </div>

            <div style="overflow-x: auto;">
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
                                <td><img src="../<?php echo htmlspecialchars($row['image']); ?>" width="60" height="60" style="object-fit: cover; border-radius: 8px;" onerror="this.src=''; this.style.backgroundColor='#ccc';"></td>
                                <td><strong><?php echo htmlspecialchars($row['personnel_name']); ?></strong></td>
                                <td><div class="comment-text">"<?php echo nl2br(htmlspecialchars($row['comment_text'])); ?>"</div></td>
                                <td style="text-align: center;">
                                    <button onclick="confirmDeleteReview(<?php echo $row['review_id']; ?>)" class="btn btn-danger">ลบ</button>
                                </td>
                            </tr>
                        <?php } } else { ?>
                            <tr id="noDataRow"><td colspan="4" style="text-align: center; padding: 30px;">ยังไม่มีใครแสดงความคิดเห็นในระบบ</td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<script src="../js/admin_faculty_reviews.js"></script>
</body>
</html>