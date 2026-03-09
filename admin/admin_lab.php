<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>Admin - Lab Management</title>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <link rel="stylesheet" href="../css/admin_style.css">
  <link rel="stylesheet" href="../css/admin_sidebar.css">
  <link rel="stylesheet" href="../css/admin_lab.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="admin-main-content">
  <div class="admin-container">
    <div class="top-panel" style="padding-bottom: 25px;">
      <div class="top-header" style="border-bottom:none; padding-bottom:0;">
        <h3 style="margin:0; color:#4a4a4a;">จัดการข้อมูล Cybersecurity Lab</h3>
        <div class="top-actions">
          <button class="btn btn-edit" onclick="openLabSettings()">ข้อมูล Lab</button>
          <button class="btn btn-edit" onclick="openCategorySettings()">จัดการหมวดหมู่</button>
          <button class="btn btn-add" onclick="openMemberForm()">เพิ่มสมาชิกใหม่</button>
        </div>
      </div>
    </div>

    <div class="main-editor">
      <div id="lab-settings-editor" class="settings-box" style="display:none;">
        <h2 class="section-header">ตั้งค่าข้อมูล Lab</h2>
        <form id="info-form">
          <div class="form-group"><label>ชื่อ Lab:</label><input type="text" name="lab_name" id="info-name" required></div>
          <div class="form-group"><label>คำอธิบาย:</label><textarea name="description" id="info-desc" rows="4"></textarea></div>
          <div class="form-group">
            <label>Logo:</label>
            <input type="file" name="logo" accept="image/*" style="padding: 8px;">
            <input type="hidden" name="old_logo" id="info-old-logo">
            <div id="logo-preview" style="margin-top:10px;"></div>
          </div>
          <button type="submit" class="btn btn-save" style="width:100%; padding:15px; font-size:1.1rem; margin-top:10px;">บันทึกข้อมูล Lab</button>
        </form>
      </div>

      <div id="category-editor" class="settings-box" style="display:none; border-left-color: #007bff;">
        <h2 class="section-header">จัดการหมวดหมู่ (Category)</h2>
        <div style="display:flex; gap:10px; margin-bottom: 20px;">
          <input type="text" id="new-cat-name" placeholder="ชื่อหมวดหมู่ใหม่..." style="flex:1;">
          <input type="number" id="new-cat-order" placeholder="ลำดับ" value="1" style="width:100px;">
          <button class="btn btn-add" onclick="addCategory()" style="width:100px;">เพิ่ม</button>
        </div>
        <div id="category-list"></div>
      </div>

      <div id="member-editor" class="settings-box" style="display:none; border-left-color: #28a745;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px;">
          <h2 class="section-header" id="form-title" style="margin:0; border:none; padding:0;">แก้ไขสมาชิก</h2>
          <button type="button" class="btn btn-danger" onclick="deleteMember()" id="btn-delete-mem">ลบสมาชิกนี้</button>
        </div>
        <form id="member-form">
          <input type="hidden" name="id" id="mem-id">
          <input type="hidden" name="old_image" id="mem-old-image">
          <div class="form-group">
            <label>หมวดหมู่:</label>
            <select name="category_id" id="mem-category"></select>
          </div>
          <div style="display:flex; gap:15px; flex-wrap:wrap;">
            <div class="form-group" style="flex:2; min-width: 200px;"><label>ชื่อ-นามสกุล:</label><input type="text" name="name" id="mem-name" required></div>
            <div class="form-group" style="flex:1; min-width: 150px;"><label>ตำแหน่ง:</label><input type="text" name="position" id="mem-position"></div>
          </div>
          <div class="form-group">
            <label>รูปโปรไฟล์:</label>
            <input type="file" name="image" id="mem-image" accept="image/*" style="padding:8px;">
            <div id="mem-preview" style="margin-top:10px;"></div>
          </div>
          <button type="submit" class="btn btn-save" style="width:100%; padding:15px; font-size:1.1rem; margin-top:10px;">บันทึกข้อมูลสมาชิก</button>
        </form>
      </div>

      <div id="welcome-msg" style="text-align:center; color:#aaa; padding: 30px 0;">
        <h2 style="margin-bottom: 10px;">เลือกเมนูด้านบนเพื่อจัดการ Lab</h2>
        <p>หรือกดปุ่ม "แก้ไข" ในตารางด้านล่างเพื่อแก้ข้อมูลสมาชิก</p>
      </div>
    </div>

    <div class="table-container">
      <h3 style="margin-top:0; color:#4a4a4a; margin-bottom: 15px;">รายชื่อสมาชิกทั้งหมด</h3>
      <div style="overflow-x: auto;">
        <table>
          <thead>
            <tr><th style="width: 80px; text-align: center;">รูป</th><th>ชื่อ-นามสกุล</th><th>หมวดหมู่</th><th>ตำแหน่ง</th><th style="text-align: center; width: 150px;">จัดการ</th></tr>
          </thead>
          <tbody id="member-table-body">
            <tr><td colspan="5" style="text-align:center;">กำลังโหลดข้อมูล...</td></tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
<script src="../js/admin_lab.js"></script>
</body>
</html>