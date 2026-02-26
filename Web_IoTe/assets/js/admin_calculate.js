let allSubjects = [];

// รอให้ HTML โหลดเสร็จก่อนค่อยดึงข้อมูล
document.addEventListener("DOMContentLoaded", () => {
  fetchSubjects();
});

async function fetchSubjects() {
  try {
    const res = await fetch('api/subjects.php?action=get');
    allSubjects = await res.json();
    renderTable();
  } catch (error) {
    console.error("Error fetching subjects:", error);
    document.getElementById('subject-table-body').innerHTML = `<tr><td colspan="5" style="text-align:center; color:red;">ไม่สามารถเชื่อมต่อฐานข้อมูลได้</td></tr>`;
  }
}

function renderTable() {
  const tbody = document.getElementById('subject-table-body');
  if (!tbody) return;

  tbody.innerHTML = '';

  if (!allSubjects || allSubjects.length === 0) {
    tbody.innerHTML = '<tr><td colspan="5" style="text-align:center; color:#888; padding: 20px;">ยังไม่มีข้อมูลรายวิชาในระบบ</td></tr>';
    return;
  }

  // แปลงชื่อหมวดหมู่ให้สวยงาม
  const catNames = {
    'core': '<span class="badge-cat badge-core">วิชาแกน</span>',
    'gen': '<span class="badge-cat badge-gen">วิชาศึกษาทั่วไป</span>',
    'free': '<span class="badge-cat badge-free">วิชาเลือกเสรี</span>'
  };

  allSubjects.forEach((sub, index) => {
    tbody.innerHTML += `
          <tr>
              <td><b>${sub.course_code}</b></td>
              <td>${sub.name}</td>
              <td style="text-align: center; font-weight: bold;">${sub.credit}</td>
              <td>${catNames[sub.category] || sub.category}</td>
              <td style="text-align: center;">
                  <button class="btn btn-edit" style="padding: 6px 12px; font-size: 0.85rem; margin-right: 5px;" onclick="selectSubject(${index})">แก้ไข</button>
                  <button class="btn btn-danger" style="padding: 6px 12px; font-size: 0.85rem;" onclick="deleteSubjectById(${sub.id})">ลบ</button>
              </td>
          </tr>
      `;
  });
}

function setupNewSubject() {
  document.getElementById('welcome-msg').style.display = 'none';
  document.getElementById('editor-area').style.display = 'block';
  document.getElementById('edit-title').innerText = 'เพิ่มรายวิชาใหม่';
  document.getElementById('btn-delete-subj').style.display = 'none';

  document.getElementById('edit-id').value = '';
  document.getElementById('edit-code').value = '';
  document.getElementById('edit-name').value = '';
  document.getElementById('edit-credit').value = '3';
  document.getElementById('edit-category').value = 'core';

  // เลื่อนจอขึ้นไปบนสุดเพื่อให้เห็นฟอร์มชัดๆ
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function selectSubject(index) {
  const sub = allSubjects[index];
  document.getElementById('welcome-msg').style.display = 'none';
  document.getElementById('editor-area').style.display = 'block';
  document.getElementById('edit-title').innerText = 'แก้ไขรายวิชา';
  document.getElementById('btn-delete-subj').style.display = 'block';

  document.getElementById('edit-id').value = sub.id;
  document.getElementById('edit-code').value = sub.course_code;
  document.getElementById('edit-name').value = sub.name;
  document.getElementById('edit-credit').value = sub.credit;
  document.getElementById('edit-category').value = sub.category;

  // เลื่อนจอขึ้นไปบนสุดเพื่อให้เห็นฟอร์มชัดๆ
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

async function saveData() {
  const id = document.getElementById('edit-id').value;
  const code = document.getElementById('edit-code').value;
  const name = document.getElementById('edit-name').value;
  const credit = document.getElementById('edit-credit').value;
  const cat = document.getElementById('edit-category').value;

  if (!code || !name || !credit) {
    Swal.fire('แจ้งเตือน', 'กรุณากรอกข้อมูลให้ครบถ้วน!', 'warning');
    return;
  }

  const fd = new FormData();
  if (id) fd.append('id', id);
  fd.append('course_code', code);
  fd.append('name', name);
  fd.append('credit', credit);
  fd.append('category', cat);

  try {
    const res = await fetch('api/subjects.php?action=save', { method: 'POST', body: fd });
    const json = await res.json();
    if (json.status === 'success') {
      Swal.fire('สำเร็จ', 'บันทึกข้อมูลเรียบร้อย', 'success');
      fetchSubjects();
      if (!id) setupNewSubject(); // ถ้าเพิ่มใหม่ ให้ล้างฟอร์มเตรียมให้แอดมินกรอกต่อได้เลย
    } else {
      Swal.fire('Error', json.message, 'error');
    }
  } catch (error) {
    Swal.fire('Error', 'ไม่สามารถบันทึกข้อมูลได้', 'error');
  }
}

async function deleteSubjectFromForm() {
  const id = document.getElementById('edit-id').value;
  deleteSubjectById(id);
}

async function deleteSubjectById(id) {
  if (!id) return;
  const result = await Swal.fire({
    title: 'ลบรายวิชานี้?',
    text: "ข้อมูลจะหายไปจากระบบ",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    confirmButtonText: 'ลบเลย'
  });

  if (result.isConfirmed) {
    const fd = new FormData(); fd.append('id', id);
    const res = await fetch('api/subjects.php?action=delete', { method: 'POST', body: fd });
    const json = await res.json();
    if (json.status === 'success') {
      Swal.fire('ลบแล้ว!', '', 'success');
      fetchSubjects();

      // ถ้าวิชาที่ลบกำลังเปิดค้างอยู่ในฟอร์ม ให้ปิดฟอร์มทิ้งด้วย
      if (document.getElementById('edit-id').value == id) {
        document.getElementById('editor-area').style.display = 'none';
        document.getElementById('welcome-msg').style.display = 'block';
      }
    }
  }
}