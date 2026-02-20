let allSubjects = [];

function filterSidebar() {
  const txt = document.getElementById('admin-search').value.toLowerCase();
  document.querySelectorAll('.project-list-item').forEach(el => {
    el.style.display = el.innerText.toLowerCase().includes(txt) ? 'block' : 'none';
  });
}

async function loadSubjects() {
  const res = await fetch('api/subjects.php?action=get');
  allSubjects = await res.json();
  const list = document.getElementById('subject-list');
  list.innerHTML = ''; let currentCat = '';
  allSubjects.forEach((sub, idx) => {
    if (sub.category !== currentCat) {
      currentCat = sub.category;
      let catName = currentCat === 'gen' ? 'หมวดศึกษาทั่วไป' : (currentCat === 'core' ? 'หมวดวิชาเฉพาะ' : 'หมวดเลือกเสรี');
      list.innerHTML += `<div class="round-label">${catName}</div>`;
    }
    list.innerHTML += `<div class="project-list-item" onclick="selectSubject(${idx}, this)"><b>${sub.course_code}</b><br><small>${sub.name}</small></div>`;
  });
  document.getElementById('admin-search').value = '';
}

function selectSubject(idx, el) {
  document.querySelectorAll('.project-list-item').forEach(e => e.classList.remove('active')); el.classList.add('active');
  document.getElementById('welcome-msg').style.display = 'none';
  document.getElementById('subject-editor').style.display = 'block';
  document.getElementById('form-title').innerText = 'แก้ไขรายวิชา';
  document.getElementById('btn-delete').style.display = 'block';
  const sub = allSubjects[idx];
  document.getElementById('edit-id').value = sub.id; document.getElementById('edit-code').value = sub.course_code;
  document.getElementById('edit-credit').value = sub.credit; document.getElementById('edit-name').value = sub.name;
  document.getElementById('edit-category').value = sub.category;
}

function openForm() {
  document.querySelectorAll('.project-list-item').forEach(e => e.classList.remove('active'));
  document.getElementById('welcome-msg').style.display = 'none'; document.getElementById('subject-editor').style.display = 'block';
  document.getElementById('form-title').innerText = 'เพิ่มรายวิชาใหม่'; document.getElementById('btn-delete').style.display = 'none';
  document.getElementById('subject-form').reset(); document.getElementById('edit-id').value = '';
}

document.getElementById('subject-form').onsubmit = async (e) => {
  e.preventDefault();
  const res = await fetch('api/subjects.php?action=save', { method: 'POST', body: new FormData(e.target) });
  const data = await res.json();
  if (data.status === 'success') {
    Swal.fire('สำเร็จ', 'บันทึกเรียบร้อย', 'success');
    loadSubjects(); document.getElementById('subject-form').reset(); document.getElementById('edit-id').value = '';
  } else { Swal.fire('Error', data.message, 'error'); }
};

async function deleteSubject() {
  const id = document.getElementById('edit-id').value;
  if (!id) return;
  if (confirm("ลบวิชานี้?")) {
    const fd = new FormData(); fd.append('id', id);
    await fetch('api/subjects.php?action=delete', { method: 'POST', body: fd });
    Swal.fire('ลบสำเร็จ', '', 'success');
    loadSubjects(); document.getElementById('subject-editor').style.display = 'none'; document.getElementById('welcome-msg').style.display = 'block';
  }
}

loadSubjects();