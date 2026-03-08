<?php
session_start();
require '../includes/db.php';

// 🔴 เช็กล็อกอิน: ถ้ายังไม่ล็อกอิน ให้เด้งกลับไปหน้า login.php
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - ระบบรับสมัคร</title>
  <link href="https://fonts.googleapis.com/css2?family=Segoe+UI&family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="../css/admin_admission.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

  <div class="admin-container">
    
    <a href="admin_faculty.php" style="display:inline-block; background:#FF6F00; color:white; padding:8px 15px; text-decoration:none; border-radius:5px; margin-bottom: 20px; font-family: 'Kanit', sans-serif;">🔙 กลับไปหน้าจัดการบุคลากร</a>

    <div class="top-panel">
      <div class="top-header">
        <h3 style="margin:0; color:#4a4a4a;">จัดการระบบรับสมัคร</h3>
        <div class="top-actions">
          <button class="btn btn-add" onclick="setupNewProject()">เพิ่มโครงการใหม่</button>
          <button class="btn btn-edit" onclick="openRoundModal()">จัดการรอบรับสมัคร</button>
        </div>
      </div>
      <h4 style="margin: 15px 0 10px; color:#555;">เลือกโครงการที่ต้องการแก้ไข:</h4>
      <div class="project-list" id="project-list">กำลังโหลดข้อมูล...</div>
    </div>

    <div class="main-editor">
      <div id="editor-area" style="display:none; max-width: 100%;">

        <div style="display:flex; justify-content:space-between; align-items:center; background: #f9f9f9; padding: 15px 20px; border-radius: 8px; margin-bottom: 25px; border-left: 5px solid #ffcc99;">
          <h2 id="edit-title" style="margin: 0; color:#4a4a4a;">แก้ไขโครงการ</h2>
          <button id="btn-delete-proj" class="btn btn-danger" onclick="deleteProject()">ลบโครงการนี้</button>
        </div>

        <input type="hidden" id="edit-id">

        <div class="form-group">
          <label>เลือกรอบ (Round):</label>
          <select id="edit-round"></select>
        </div>
        <div class="form-group">
          <label>ชื่อโครงการ:</label>
          <input type="text" id="edit-name" placeholder="เช่น โครงการเรียนดี...">
        </div>

        <div style="display:flex; gap: 15px; flex-wrap: wrap;">
          <div class="form-group" style="flex:1; min-width: 150px;">
            <label>จำนวนรับ (คน):</label>
            <input type="number" id="edit-seats" placeholder="เช่น 30" min="1">
          </div>
          <div class="form-group" style="flex:3; min-width: 250px;">
            <label>ลิงก์สมัคร (URL):</label>
            <input type="text" id="edit-link" placeholder="https://...">
          </div>
        </div>

        <div class="form-group">
          <label>คุณสมบัติ (ขึ้นบรรทัดใหม่เพื่อแยกข้อ):</label>
          <textarea id="edit-details" rows="3"></textarea>
        </div>

        <div class="form-group">
          <label>เงื่อนไขการรับ (ขึ้นบรรทัดใหม่เพื่อแยกข้อ):</label>
          <textarea id="edit-conditions" rows="3"></textarea>
        </div>

        <div class="form-group">
          <label>การคำนวณคะแนน (ขึ้นบรรทัดใหม่เพื่อแยกข้อ):</label>
          <textarea id="edit-scoring" rows="3"></textarea>
        </div>

        <button class="btn btn-save" onclick="saveData()" style="width: 100%; font-size: 1.1rem; padding: 15px; margin-top: 10px;">บันทึกข้อมูลโครงการ</button>
      </div>

      <div id="welcome-msg" style="text-align:center; margin-top:50px; color:#aaa; padding: 50px 0;">
        <h2 style="margin-bottom: 10px;">เลือกรอบวิชาด้านบนเพื่อแก้ไข</h2>
        <p>หรือกด "เพิ่มโครงการใหม่" เพื่อสร้างรายการ</p>
      </div>
    </div>

  </div>

  <div id="roundModal" class="modal-overlay">
    <div class="modal-content">
      <span class="close-btn" onclick="document.getElementById('roundModal').style.display='none'; location.reload();">&times;</span>
      <h3 style="margin-top:0;">จัดการชื่อรอบ (Rounds)</h3>
      <div style="display:flex; gap:10px; margin-bottom:20px;">
        <input type="text" id="new-round-name" placeholder="ชื่อรอบใหม่..." style="flex:1; padding:10px; border-radius:5px; border:1px solid #ccc;">
        <button class="btn btn-add" style="width:90px;" onclick="addRound()">เพิ่ม</button>
      </div>
      <div id="round-list-container"></div>
    </div>
  </div>

  <script src="../js/admin_admission.js"></script>
</body>
</html>