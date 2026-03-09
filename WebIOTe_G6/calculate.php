<?php 
session_start(); 
include 'includes/db.php'; 

// เช็คว่าผู้ใช้ Login หรือยัง (ถ้าต้องการให้เฉพาะสมาชิกเข้าใช้)
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ระบบวางแผนการเรียน - IoT Engineering</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Kanit:wght@300;400;600&display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/calculate.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <style>
  /* ปรับจูนเล็กน้อยให้เข้ากับเทมเพลต */
  .program-selector-card {
    background: #fff3e0;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 25px;
    border-left: 5px solid #ff6600;
  }

  .form-label {
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
    color: #333333;
  }

  .select-program {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #ddd;
    /* font-size: 20px; */
  }
  </style>
</head>

<body>
  <?php include 'includes/navbar.php'; ?>

  <div class="page-header">
    วางแผนการลงทะเบียนเรียน
  </div>

  <div class="page-background">
    <div class="content-card">

      <div class="profile-container">

        <div class="program-selector-card">
          <label class="form-label">เลือกหลักสูตรที่เรียน:</label>
          <select id="degree-program" class="select-program" onchange="updateDegreeRequirements()">
            <option value="single">วิศวกรรมไอโอทีและสารสนเทศ (1 ปริญญา - 138 นก.)</option>
            <option value="double">วิศวกรรมไอโอที + ฟิสิกส์อุตสาหกรรม (2 ปริญญา - 165 นก.)</option>
          </select>
        </div>

        <div class="grid-layout">
          <div>
            <div class="card">
              <h3>+ เพิ่มรายวิชาที่เรียนผ่านแล้ว</h3>
              <div class="form-row">
                <select id="select-subject" class="select2-wrapper">
                  <option value="">กำลังโหลดวิชา...</option>
                </select>
                <select id="select-grade" style="width:100px;">
                  <option value="4">A</option>
                  <option value="3.5">B+</option>
                  <option value="3">B</option>
                  <option value="2.5">C+</option>
                  <option value="2">C</option>
                  <option value="1.5">D+</option>
                  <option value="1">D</option>
                </select>
                <button class="btn-primary" onclick="addSubject()"
                  style="padding: 10px 20px; border:none; border-radius:8px; cursor:pointer;">เพิ่ม</button>
              </div>
            </div>

            <div class="card" style="margin-top:20px;">
              <div style="display:flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h3 style="margin:0;">วิชาที่บันทึกไว้</h3>
                <button onclick="clearAll()"
                  style="font-size:14px; padding:5px 10px; background:#eee; border:none; border-radius:5px; cursor:pointer;">ล้างข้อมูล</button>
              </div>
              <div class="table-responsive">
                <table style="width:100%; text-align:left; border-collapse: collapse;">
                  <thead>
                    <tr style="border-bottom: 2px solid #eee;">
                      <th>รหัสวิชา</th>
                      <th>ชื่อวิชา</th>
                      <th>นก.</th>
                      <th>เกรด</th>
                      <th>ลบ</th>
                    </tr>
                  </thead>
                  <tbody id="my-subject-list"></tbody>
                </table>
              </div>
            </div>
          </div>

          <div>
            <div class="gpa-box"
              style="color:#fff; padding:30px; border-radius:15px; text-align:center; margin-bottom:20px;">
              <div class="gpa-value" id="display-gpa" style="font-size:3rem; font-weight:700;">0.00</div>
              <div class="gpa-label">เกรดเฉลี่ยสะสม (GPAX)</div>
            </div>

            <div class="card">
              <h3>ความคืบหน้าหลักสูตร</h3>
              <div id="progress-container">
              </div>
              <hr style="border:0; border-top:1px solid #eee; margin:15px 0;">
              <div class="progress-item">
                <div class="progress-label" style="display:flex; justify-content: space-between;">
                  <b>รวมทั้งหมด</b>
                  <b id="label-total">0/138</b>
                </div>
                <div class="progress-bg"
                  style="height:15px; background:#eee; border-radius:10px; overflow:hidden; margin-top:10px;">
                  <div class="progress-fill" id="bar-total"
                    style="width:0%; height:100%; background:#ff6600; transition:0.3s;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <?php include 'includes/footer.php'; ?>

  <script src="js/calculate.js"></script>
  <script src="js/script.js"></script>
</body>

</html>