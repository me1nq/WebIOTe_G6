<?php
$conn = new mysqli("localhost","root","","university_db");

$success = isset($_GET['success']);
$editMode = false;
$editData = null;

/* ===== EDIT MODE ===== */
if(isset($_GET['edit'])){
    $editMode = true;
    $id = intval($_GET['edit']);
    $resultEdit = $conn->query("SELECT * FROM internships WHERE id=$id");
    $editData = $resultEdit->fetch_assoc();
}

$result = $conn->query("SELECT * FROM internships ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin</title>
<link rel="stylesheet" href="AdminInternship.css">
</head>
<body>

<div class="admin-container">

<h1>Admin - จัดการประสบการณ์ฝึกงาน</h1>

<form action="<?= $editMode ? 'update_intern.php' : 'save_intern.php' ?>" 
      method="POST" 
      enctype="multipart/form-data">

<?php if($editMode): ?>
<input type="hidden" name="id" value="<?= $editData['id'] ?>">
<?php endif; ?>

<div>
<label>ชื่อบริษัท</label>
<input type="text" name="company"
value="<?= $editMode ? htmlspecialchars($editData['company']) : '' ?>"
placeholder="เช่น บริษัทA" required>
</div>

<div>
<label>ตำแหน่ง</label>
<input type="text" name="position"
value="<?= $editMode ? htmlspecialchars($editData['position']) : '' ?>"
placeholder="เช่น IoT System Developer Intern" required>
</div>

<div>
<label>ช่วงเวลา</label>
<input type="text" name="date_range"
value="<?= $editMode ? htmlspecialchars($editData['date_range']) : '' ?>"
placeholder="เช่น มิถุนายน 2025 - สิงหาคม 2025" required>
</div>

<div>
<input type="file" name="image" <?= $editMode ? '' : 'required' ?>>
</div>

<div>
<label>รายละเอียด</label>
<textarea name="details" required><?= 
$editMode ? htmlspecialchars($editData['details']) : '' 
?></textarea>
</div>

<button type="submit">
<?= $editMode ? 'อัปเดตข้อมูล' : 'บันทึก' ?>
</button>

</form>

<h2>รายการทั้งหมด</h2>

<div class="search-box">
<span>ค้นหาชื่อบริษัท:</span>
<input type="text" id="searchInput" placeholder="พิมพ์ชื่อเพื่อค้นหา...">
</div>

<div class="table-wrapper">
<table id="dataTable">
<thead>
<tr>
<th>รูปภาพ</th>
<th>ชื่อบริษัท</th>
<th>ตำแหน่ง</th>
<th>ช่วงเวลา</th>
<th>รายละเอียด</th>
<th>จัดการ</th>
</tr>
</thead>

<tbody>
<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td>
<img src="uploads/<?= $row['image'] ?>">
</td>

<td><?= htmlspecialchars($row['company']) ?></td>
<td><?= htmlspecialchars($row['position']) ?></td>
<td><?= htmlspecialchars($row['date_range']) ?></td>
<td><?= htmlspecialchars($row['details']) ?></td>

<td style="display:flex; gap:6px;">

<a href="AdminInternship.php?edit=<?= $row['id'] ?>">
<button type="button" class="action-btn" style="background:#ffa726;">
แก้ไข
</button>
</a>

<form action="delete_intern.php" method="POST">
<input type="hidden" name="id" value="<?= $row['id'] ?>">
<button class="action-btn delete">ลบ</button>
</form>

</td>

</tr>
<?php endwhile; ?>
</tbody>

</table>
</div>

</div>

<?php if($success): ?>
<div class="popup">
<div class="popup-box">
<div class="success-icon">✓</div>
<h2>อัปเดตข้อมูลสำเร็จ!</h2>
<p>ระบบได้บันทึกการเปลี่ยนแปลงของคุณแล้ว</p>
<button onclick="window.location.href='AdminInternship.php'">ตกลง</button>
</div>
</div>
<?php endif; ?>

<script>
document.getElementById("searchInput").addEventListener("keyup", function(){
let filter = this.value.toLowerCase();
let rows = document.querySelectorAll("#dataTable tbody tr");
rows.forEach(row=>{
let company = row.cells[1].textContent.toLowerCase();
row.style.display = company.includes(filter) ? "" : "none";
});
});
</script>

</body>
</html>