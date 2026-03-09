// ตั้งค่าหน่วยกิตเริ่มต้น
let REQUIREMENTS = { gen: 30, core: 102, free: 6, total: 138 };
let dbSubjects = [];
let mySubjects = [];

// ฟังก์ชันเปลี่ยนเกณฑ์หน่วยกิตตามหลักสูตร
function updateDegreeRequirements() {
  const degreeType = document.getElementById('degree-program').value;
  if (degreeType === 'double') {
    REQUIREMENTS = { gen: 30, core: 129, free: 6, total: 165 };
  } else {
    REQUIREMENTS = { gen: 30, core: 102, free: 6, total: 138 };
  }
  renderMySubjects();
}

if (localStorage.getItem('mySubjects')) mySubjects = JSON.parse(localStorage.getItem('mySubjects'));

async function fetchSubjectsFromDB() {
  try {
    // 🟢 ตรวจสอบว่าไฟล์ชื่อ subjects_api.php และอยู่ในโฟลเดอร์ api
    const res = await fetch('api/subjects_api.php?action=get');
    dbSubjects = await res.json();
    const $select = $('#select-subject');

    $select.empty();
    $select.append('<option value="">-- พิมพ์ค้นหา หรือ เลือกรายวิชา --</option>');

    dbSubjects.forEach(sub => {
      $select.append(`<option value="${sub.id}">[${sub.course_code}] ${sub.name} (${sub.credit} นก.)</option>`);
    });

    $select.select2({
      width: '100%',
      placeholder: "-- ค้นหารายวิชา --"
    });

    renderMySubjects();
  } catch (error) {
    console.error('Error fetching subjects:', error);
  }
}

function addSubject() {
  const subjectId = $('#select-subject').val();
  const gradeValue = parseFloat($('#select-grade').val());
  const gradeText = $('#select-grade option:selected').text().split(' ')[0];

  if (!subjectId) return alert("กรุณาเลือกวิชาก่อนครับ!");
  if (mySubjects.find(s => s.id == subjectId)) return alert("วิชานี้ถูกเพิ่มไปแล้วครับ!");

  const selectedSubject = dbSubjects.find(s => s.id == subjectId);

  mySubjects.push({
    id: selectedSubject.id,
    code: selectedSubject.course_code,
    name: selectedSubject.name,
    category: selectedSubject.category,
    credit: parseInt(selectedSubject.credit),
    gradeVal: gradeValue,
    gradeText: gradeText
  });

  saveAndRender();
  $('#select-subject').val(null).trigger('change');
}

function deleteMySubject(index) {
  mySubjects.splice(index, 1);
  saveAndRender();
}

function clearAll() {
  if (confirm("ต้องการล้างข้อมูลทั้งหมด?")) {
    mySubjects = [];
    saveAndRender();
  }
}

function saveAndRender() {
  localStorage.setItem('mySubjects', JSON.stringify(mySubjects));
  renderMySubjects();
}

function renderMySubjects() {
  const tbody = document.getElementById('my-subject-list');
  const progressContainer = document.getElementById('progress-container');
  if (!tbody) return;

  tbody.innerHTML = '';
  let totalCredit = 0;
  let totalPoints = 0;
  let currentCredits = { gen: 0, core: 0, free: 0, total: 0 };

  mySubjects.forEach((sub, index) => {
    totalCredit += sub.credit;
    totalPoints += (sub.credit * sub.gradeVal);
    if (currentCredits[sub.category] !== undefined) currentCredits[sub.category] += sub.credit;
    currentCredits.total += sub.credit;

    let catName = sub.category === 'gen' ? 'ศึกษาทั่วไป' : (sub.category === 'core' ? 'วิชาเฉพาะ' : 'เลือกเสรี');

    tbody.innerHTML += `<tr>
        <td>${sub.code}</td>
        <td>${sub.name}</td>
        <td class="text-center">${sub.credit}</td>
        <td class="text-center"><b>${sub.gradeText}</b></td>
        <td class="text-center">
            <button onclick="deleteMySubject(${index})" style="color:red; border:none; background:none; cursor:pointer; font-size:1.2rem;">&times;</button>
        </td>
    </tr>`;
  });

  document.getElementById('display-gpa').innerText = totalCredit > 0 ? (totalPoints / totalCredit).toFixed(2) : "0.00";
  updateAllProgress(currentCredits);
}

function updateAllProgress(currentCredits) {
  const labels = { gen: 'ศึกษาทั่วไป', core: 'วิชาเฉพาะ', free: 'เลือกเสรี' };
  const container = document.getElementById('progress-container');
  if (!container) return;
  container.innerHTML = '';

  ['gen', 'core', 'free'].forEach(key => {
    const max = REQUIREMENTS[key];
    const current = currentCredits[key];
    const percent = Math.min((current / max) * 100, 100);
    const barColor = key === 'gen' ? '#28a745' : (key === 'core' ? '#007bff' : '#ffc107');

    container.innerHTML += `
            <div class="progress-item" style="margin-bottom:15px;">
                <div class="progress-label" style="display:flex; justify-content: space-between; font-size:0.9rem;">
                    <span>${labels[key]}</span>
                    <span>${current} / ${max}</span>
                </div>
                <div class="progress-bg" style="height:10px; background:#eee; border-radius:5px; overflow:hidden; margin-top:5px;">
                    <div style="width:${percent}%; height:100%; background:${barColor}; transition:0.3s;"></div>
                </div>
            </div>`;
  });

  document.getElementById('label-total').innerText = `${currentCredits.total} / ${REQUIREMENTS.total}`;
  document.getElementById('bar-total').style.width = `${Math.min((currentCredits.total / REQUIREMENTS.total) * 100, 100)}%`;
}

// 🟢 เรียกโหลดข้อมูล
fetchSubjectsFromDB();
// (ลบ } ตัวสุดท้ายที่เกินมาออก)