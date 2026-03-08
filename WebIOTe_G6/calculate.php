<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ระบบคำนวณหน่วยกิต - KMITL</title>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/standard.css">
  <link rel="stylesheet" href="assets/css/calculate.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
  <div class="container">
    <h2 class="round-header">วางแผนการลงทะเบียนเรียน</h2>
    <div class="grid-layout">
      <div class="main-content">
        <div class="card">
          <h3>+ เพิ่มรายวิชาที่เรียนผ่านแล้ว</h3>
          <div class="form-row">
            <div class="select2-wrapper">
              <select id="select-subject">
                <option value="">กำลังโหลด...</option>
              </select>
            </div>
            <select id="select-grade">
              <option value="4">A (4.0)</option>
              <option value="3.5">B+ (3.5)</option>
              <option value="3">B (3.0)</option>
              <option value="2.5">C+ (2.5)</option>
              <option value="2">C (2.0)</option>
              <option value="1.5">D+ (1.5)</option>
              <option value="1">D (1.0)</option>
            </select>
            <button class="btn-add" onclick="addSubject()">เพิ่ม</button>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h3>วิชาที่บันทึกไว้</h3>
            <button onclick="clearAll()" class="btn-clear">ล้างข้อมูล</button>
          </div>
          <div class="table-responsive">
            <table>
              <thead>
                <tr>
                  <th>รหัสวิชา</th>
                  <th>ชื่อวิชา</th>
                  <th>หมวดหมู่</th>
                  <th class="text-center">นก.</th>
                  <th class="text-center">เกรด</th>
                  <th class="text-center">ลบ</th>
                </tr>
              </thead>
              <tbody id="my-subject-list"></tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="sidebar">
        <div class="gpa-box">
          <div class="gpa-value" id="display-gpa">0.00</div>
          <div class="gpa-label">เกรดเฉลี่ยสะสม (GPAX)</div>
        </div>
        <div class="card">
          <h3>ความคืบหน้าโครงสร้างหลักสูตร</h3>
          <div class="progress-item">
            <div class="progress-label"><span>ศึกษาทั่วไป</span><span id="label-gen">0/30</span></div>
            <div class="progress-bg">
              <div class="progress-fill" id="bar-gen"></div>
            </div>
          </div>
          <div class="progress-item">
            <div class="progress-label"><span>วิชาเฉพาะ</span><span id="label-core">0/99</span></div>
            <div class="progress-bg">
              <div class="progress-fill" id="bar-core"></div>
            </div>
          </div>
          <div class="progress-item">
            <div class="progress-label"><span>เลือกเสรี</span><span id="label-free">0/6</span></div>
            <div class="progress-bg">
              <div class="progress-fill" id="bar-free"></div>
            </div>
          </div>
          <hr class="divider">
          <div class="progress-item">
            <div class="progress-label"><b>รวมทั้งหมด</b><b id="label-total">0/135</b></div>
            <div class="progress-bg total-bar">
              <div class="progress-fill" id="bar-total"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/js/calculate.js"></script>
</body>

</html>