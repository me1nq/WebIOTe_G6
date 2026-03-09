let allProjects = [];
let allRounds = [];

async function init() {
  await fetchRounds();
  await fetchProjects();
}

async function fetchRounds() {
  // 🟢 แก้ไขลิงก์ API
  const res = await fetch('../api/admission_api.php?action=get_rounds');
  allRounds = await res.json();
  const select = document.getElementById('edit-round');
  select.innerHTML = '';
  allRounds.forEach(r => select.innerHTML += `<option value="${r.id}">${r.round_name}</option>`);
}

async function fetchProjects() {
  // 🟢 แก้ไขลิงก์ API
  const res = await fetch('../api/admission_api.php?action=get_projects');
  allProjects = await res.json();
  renderSidebar();
}

function renderSidebar() {
  const sidebar = document.getElementById('project-list');
  sidebar.innerHTML = '';
  let currentRoundId = -1;
  allProjects.forEach((proj, index) => {
    if (proj.round_id != currentRoundId) {
      currentRoundId = proj.round_id;
      const roundObj = allRounds.find(r => r.id == currentRoundId);
      const roundName = roundObj ? roundObj.round_name : 'Unknown Round';
      sidebar.innerHTML += `<div class="round-label">${roundName}</div>`;
    }
    sidebar.innerHTML += `<div class="project-list-item" onclick="selectProject(${index}, this)">${proj.project_name}</div>`;
  });
}

function selectProject(index, el) {
  document.querySelectorAll('.project-list-item').forEach(e => e.classList.remove('active'));
  el.classList.add('active');

  const p = allProjects[index];
  document.getElementById('welcome-msg').style.display = 'none';
  document.getElementById('editor-area').style.display = 'block';
  document.getElementById('edit-title').innerText = 'แก้ไขโครงการ';
  document.getElementById('btn-delete-proj').style.display = 'block';

  document.getElementById('edit-id').value = p.id;
  document.getElementById('edit-round').value = p.round_id || (allRounds[0] ? allRounds[0].id : '');
  document.getElementById('edit-name').value = p.project_name;
  document.getElementById('edit-seats').value = p.seat_count;
  document.getElementById('edit-link').value = p.apply_link;

  // แปลงแท็ก <ul><li> กลับเป็นบรรทัดใหม่
  let txtDetails = (p.details || "").replace(/<ul>/g, "").replace(/<\/ul>/g, "").replace(/<\/li><li>/g, "\n").replace(/<\/?li>/g, "").trim();
  document.getElementById('edit-details').value = txtDetails;

  // 🟢 เพิ่มการดึงค่า conditions และ scoring 
  let txtConditions = (p.conditions || "").replace(/<ul>/g, "").replace(/<\/ul>/g, "").replace(/<\/li><li>/g, "\n").replace(/<\/?li>/g, "").trim();
  document.getElementById('edit-conditions').value = txtConditions;

  let txtScoring = (p.scoring || "").replace(/<ul>/g, "").replace(/<\/ul>/g, "").replace(/<\/li><li>/g, "\n").replace(/<\/?li>/g, "").trim();
  document.getElementById('edit-scoring').value = txtScoring;

  setTimeout(() => {
    document.getElementById('editor-area').scrollIntoView({ behavior: 'smooth', block: 'start' });
  }, 100);
}

function setupNewProject() {
  document.querySelectorAll('.project-list-item').forEach(e => e.classList.remove('active'));
  document.getElementById('welcome-msg').style.display = 'none';
  document.getElementById('editor-area').style.display = 'block';
  document.getElementById('edit-title').innerText = 'เพิ่มโครงการใหม่';
  document.getElementById('btn-delete-proj').style.display = 'none';

  document.getElementById('edit-id').value = '';
  document.getElementById('edit-name').value = '';
  document.getElementById('edit-seats').value = '';
  document.getElementById('edit-link').value = '';
  document.getElementById('edit-details').value = '';

  document.getElementById('edit-conditions').value = '';
  document.getElementById('edit-scoring').value = '';

  setTimeout(() => {
    document.getElementById('editor-area').scrollIntoView({ behavior: 'smooth', block: 'start' });
  }, 100);
}

async function saveData() {
  const id = document.getElementById('edit-id').value;

  // ฟังก์ชันช่วยแปลง Text จากกล่องเป็น <ul><li>
  const formatList = (text) => '<ul>' + text.split('\n').map(l => l.trim() ? `<li>${l.trim()}</li>` : '').join('') + '</ul>';

  const payload = {
    id: id,
    round_id: document.getElementById('edit-round').value,
    project_name: document.getElementById('edit-name').value,
    seat_count: document.getElementById('edit-seats').value,
    apply_link: document.getElementById('edit-link').value,
    details: formatList(document.getElementById('edit-details').value),
    conditions: formatList(document.getElementById('edit-conditions').value), // 🟢 เพิ่มข้อมูลใหม่
    scoring: formatList(document.getElementById('edit-scoring').value)        // 🟢 เพิ่มข้อมูลใหม่
  };

  // 🟢 แก้ไขลิงก์ API
  const url = id ? '../api/admission_api.php?action=save_project' : '../api/admission_api.php?action=add_project';

  try {
    const res = await fetch(url, { method: 'POST', body: JSON.stringify(payload) });
    const json = await res.json();
    if (json.status == 'success') {
      Swal.fire('สำเร็จ!', json.message, 'success').then(() => {
        init();
        if (!id) setupNewProject();
      });
    } else {
      Swal.fire('Error', json.message, 'error');
    }
  } catch (e) { Swal.fire('Error', e.message, 'error'); }
}

async function deleteProject() {
  const id = document.getElementById('edit-id').value;
  const result = await Swal.fire({
    title: 'ยืนยันการลบ?', text: "ข้อมูลจะหายไปถาวรนะ", icon: 'warning',
    showCancelButton: true, confirmButtonColor: '#d33', confirmButtonText: 'ลบเลย!'
  });
  if (result.isConfirmed) {
    // 🟢 แก้ไขลิงก์ API
    const res = await fetch('../api/admission_api.php?action=delete_project', { method: 'POST', body: JSON.stringify({ id }) });
    const json = await res.json();
    if (json.status == 'success') {
      Swal.fire('ลบแล้ว!', '', 'success').then(() => location.reload());
    }
  }
}

// --- Round Management ---
function openRoundModal() { document.getElementById('roundModal').style.display = 'flex'; renderRoundList(); }

function renderRoundList() {
  const container = document.getElementById('round-list-container');
  container.innerHTML = '';
  allRounds.forEach(r => {
    container.innerHTML += `
            <div class="round-item">
                <input type="text" value="${r.round_name}" id="r-name-${r.id}">
                <div>
                    <span class="icon-btn" onclick="updateRound(${r.id})" style="color:green;">💾</span>
                    <span class="icon-btn" onclick="deleteRound(${r.id})" style="color:red;">🗑️</span>
                </div>
            </div>`;
  });
}

async function addRound() {
  const name = document.getElementById('new-round-name').value;
  if (!name) return;
  // 🟢 แก้ไขลิงก์ API
  const res = await fetch('../api/admission_api.php?action=add_round', { method: 'POST', body: JSON.stringify({ round_name: name }) });
  const json = await res.json();
  if (json.status === 'success') {
    Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'เพิ่มรอบสำเร็จ', showConfirmButton: false, timer: 1500 });
    document.getElementById('new-round-name').value = '';
    await fetchRounds(); renderRoundList();
  }
}

async function updateRound(id) {
  const name = document.getElementById(`r-name-${id}`).value;
  // 🟢 แก้ไขลิงก์ API
  const res = await fetch('../api/admission_api.php?action=update_round', { method: 'POST', body: JSON.stringify({ id: id, round_name: name }) });
  if (await res.json().then(j => j.status === 'success')) {
    Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'แก้ไขชื่อรอบเรียบร้อย', showConfirmButton: false, timer: 1500 });
    await fetchRounds();
  }
}

async function deleteRound(id) {
  const res = await Swal.fire({ title: 'แน่ใจนะ?', text: "โครงการทั้งหมดในรอบนี้จะหายไปนะ!", icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', confirmButtonText: 'ลบทั้งหมด' });
  if (res.isConfirmed) {
    // 🟢 แก้ไขลิงก์ API
    const apiRes = await fetch('../api/admission_api.php?action=delete_round', { method: 'POST', body: JSON.stringify({ id: id }) });
    if (await apiRes.json().then(j => j.status === 'success')) {
      Swal.fire('ลบสำเร็จ!', '', 'success');
      await fetchRounds(); renderRoundList();
    }
  }
}

init();

window.addEventListener('click', function(event) {
  const modal = document.getElementById('roundModal');
  
  // ตรวจสอบว่ามีกล่อง modal อยู่ในหน้าเว็บไหม และสิ่งที่คลิกคือพื้นหลังสีดำ (overlay) จริงๆ ใช่ไหม
  if (modal && event.target === modal) {
    modal.style.display = 'none';
  }
});