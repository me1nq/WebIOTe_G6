const REQUIREMENTS = { gen: 30, core: 99, free: 6, total: 135 };
let dbSubjects = []; let mySubjects = [];

if (localStorage.getItem('mySubjects')) mySubjects = JSON.parse(localStorage.getItem('mySubjects'));

async function fetchSubjectsFromDB() {
  try {
    const res = await fetch('api/subjects.php?action=get');
    dbSubjects = await res.json();
    const $select = $('#select-subject');
    $select.empty();
    $select.append('<option value="">-- พิมพ์ค้นหา หรือ เลือกรายวิชา --</option>');
    dbSubjects.forEach(sub => {
      $select.append(`<option value="${sub.id}">[${sub.course_code}] ${sub.name} (${sub.credit} นก.)</option>`);
    });
    $select.select2({ placeholder: "-- พิมพ์ค้นหา หรือ เลือกรายวิชา --", allowClear: true, language: { noResults: () => "ไม่พบวิชาที่ค้นหา" } });
    renderMySubjects();
  } catch (error) { console.error('Error:', error); }
}

function addSubject() {
  const subjectId = $('#select-subject').val();
  const gradeValue = parseFloat($('#select-grade').val());
  const gradeText = $('#select-grade option:selected').text().split(' ')[0];
  if (!subjectId) return alert("กรุณาเลือกวิชาก่อนครับ!");
  if (mySubjects.find(s => s.id == subjectId)) return alert("วิชานี้ถูกเพิ่มไปแล้วครับ!");
  const selectedSubject = dbSubjects.find(s => s.id == subjectId);

  mySubjects.push({ id: selectedSubject.id, code: selectedSubject.course_code, name: selectedSubject.name, category: selectedSubject.category, credit: parseInt(selectedSubject.credit), gradeVal: gradeValue, gradeText: gradeText });
  saveAndRender();
  $('#select-subject').val(null).trigger('change');
}

function deleteMySubject(index) { mySubjects.splice(index, 1); saveAndRender(); }
function clearAll() { if (confirm("ต้องการล้างข้อมูลทั้งหมด?")) { mySubjects = []; saveAndRender(); } }
function saveAndRender() { localStorage.setItem('mySubjects', JSON.stringify(mySubjects)); renderMySubjects(); }

function renderMySubjects() {
  const tbody = document.getElementById('my-subject-list');
  tbody.innerHTML = '';
  let totalCredit = 0; let totalPoints = 0; let credits = { gen: 0, core: 0, free: 0, total: 0 };

  mySubjects.forEach((sub, index) => {
    totalCredit += sub.credit; totalPoints += (sub.credit * sub.gradeVal);
    if (credits[sub.category] !== undefined) credits[sub.category] += sub.credit;
    credits.total += sub.credit;
    let catName = sub.category === 'gen' ? 'ศึกษาทั่วไป' : (sub.category === 'core' ? 'วิชาเฉพาะ' : 'เลือกเสรี');
    tbody.innerHTML += `<tr><td>${sub.code}</td><td>${sub.name}</td><td><span style="background:#eee; padding:2px 8px; border-radius:10px; font-size:0.8rem;">${catName}</span></td><td>${sub.credit}</td><td><b>${sub.gradeText}</b></td><td><button class="btn-del" onclick="deleteMySubject(${index})">×</button></td></tr>`;
  });

  document.getElementById('display-gpa').innerText = totalCredit > 0 ? (totalPoints / totalCredit).toFixed(2) : "0.00";
  updateProgressBar('gen', credits.gen); updateProgressBar('core', credits.core);
  updateProgressBar('free', credits.free); updateProgressBar('total', credits.total);
}

function updateProgressBar(key, current) {
  const max = REQUIREMENTS[key];
  const percent = Math.min((current / max) * 100, 100);
  document.getElementById(`label-${key}`).innerText = `${current} / ${max}`;
  document.getElementById(`bar-${key}`).style.width = `${percent}%`;
  document.getElementById(`bar-${key}`).style.backgroundColor = current >= max ? "#155724" : { gen: '#28a745', core: '#007bff', free: '#ffc107', total: '#F37021' }[key];
}

fetchSubjectsFromDB();