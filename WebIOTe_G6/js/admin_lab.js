document.addEventListener("DOMContentLoaded", () => {
  loadInfo();
  loadCategories();
  loadMembers();
});

function showEditor(type) {
  document.getElementById('welcome-msg').style.display = 'none';
  ['lab-settings-editor', 'member-editor', 'category-editor'].forEach(id => {
    document.getElementById(id).style.display = 'none';
  });
  if (type) document.getElementById(type).style.display = 'block';
}

async function loadInfo() {
  const res = await fetch('../api/lab_api.php?action=get_info');
  const data = await res.json();
  if (data) {
    document.getElementById('info-name').value = data.lab_name || '';
    document.getElementById('info-desc').value = data.description || '';
    document.getElementById('info-old-logo').value = data.logo_url || '';
    if (data.logo_url) {
      document.getElementById('logo-preview').innerHTML = `<img src="../assets/lab/${data.logo_url}" height="80" style="border-radius:10px;">`;
    }
  }
}

document.getElementById('info-form').onsubmit = async (e) => {
  e.preventDefault();
  await fetch('../api/lab_api.php?action=save_info', { method: 'POST', body: new FormData(e.target) });
  Swal.fire('สำเร็จ', 'บันทึกข้อมูล Lab เรียบร้อย', 'success');
  loadInfo();
};

let allCats = [];
async function loadCategories() {
  const res = await fetch('../api/lab_api.php?action=get_categories');
  allCats = await res.json();
  const list = document.getElementById('category-list');
  const select = document.getElementById('mem-category');

  list.innerHTML = '';
  allCats.forEach(c => {
    list.innerHTML += `
        <div class="cat-item" style="font-family: 'Kanit', sans-serif;">
            <div style="flex:1; display:flex; gap:10px;">
                <input type="number" value="${c.display_order}" onchange="updateCat(${c.id}, this.value, '${c.category_name}')" style="width:60px; text-align:center; font-family: 'Kanit', sans-serif;" title="ลำดับ">
                <input type="text" value="${c.category_name}" onchange="updateCat(${c.id}, ${c.display_order}, this.value)" style="font-family: 'Kanit', sans-serif;">
            </div>
            <button class="icon-btn" onclick="deleteCat(${c.id})" style="font-family: 'Kanit', sans-serif;">ลบ</button>
        </div>`;
  });

  if (select) {
    select.innerHTML = '';
    allCats.forEach(c => select.innerHTML += `<option value="${c.id}">${c.category_name}</option>`);
  }
  const filterSelect = document.getElementById('filter-category');
  if (filterSelect) {
    filterSelect.innerHTML = '<option value="all">-- แสดงทั้งหมด --</option>';
    allCats.forEach(c => filterSelect.innerHTML += `<option value="${c.category_name}">${c.category_name}</option>`);
  }
}

async function addCategory() {
  const name = document.getElementById('new-cat-name').value;
  const order = document.getElementById('new-cat-order').value;
  if (!name) return;
  const fd = new FormData();
  fd.append('category_name', name);
  fd.append('display_order', order);
  await fetch('../api/lab_api.php?action=save_category', { method: 'POST', body: fd });
  document.getElementById('new-cat-name').value = '';
  loadCategories();
}

async function updateCat(id, order, name) {
  const fd = new FormData(); fd.append('id', id); fd.append('category_name', name); fd.append('display_order', order);
  await fetch('../api/lab_api.php?action=save_category', { method: 'POST', body: fd });
  loadCategories();
}

async function deleteCat(id) {
  const result = await Swal.fire({
    title: 'ต้องการลบหมวดหมู่นี้?',
    text: "สมาชิกที่อยู่ในหมวดหมู่นี้อาจหายไป หรือได้รับผลกระทบนะครับ!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonText: 'ยกเลิก',
    confirmButtonText: 'ใช่, ลบเลย!'
  });

  if (result.isConfirmed) {
    const fd = new FormData();
    fd.append('id', id);
    await fetch('../api/lab_api.php?action=delete_category', { method: 'POST', body: fd });
    Swal.fire('ลบสำเร็จ!', 'ลบหมวดหมู่เรียบร้อยแล้ว', 'success');
    loadCategories();
  }
}

let allMembers = [];
async function loadMembers() {
  const res = await fetch('../api/lab_api.php?action=get_members');
  allMembers = await res.json();
  const tbody = document.getElementById('member-table-body');
  if (!tbody) return;

  tbody.innerHTML = '';
  if (!allMembers || allMembers.length === 0) {
    tbody.innerHTML = '<tr><td colspan="5" style="text-align:center; color:#888; padding: 20px;">ยังไม่มีสมาชิกในระบบ</td></tr>';
    return;
  }

  // สร้างตาราง
  allMembers.forEach((m, idx) => {
    const imgHtml = m.image_url
      ? `<img src="../assets/lab/${m.image_url}" class="table-img">`
      : `<div class="table-img" style="background:#eee; display:flex; align-items:center; justify-content:center; font-size:0.7rem; color:#aaa;">ไม่มีรูป</div>`;

    tbody.innerHTML += `
          <tr>
              <td style="text-align: center;">${imgHtml}</td>
              <td><b>${m.name}</b></td>
              <td>${m.category_name || '-'}</td>
              <td>${m.position || '-'}</td>
              <td style="text-align: center;">
                  <button class="btn btn-edit" style="padding: 6px 12px; font-size: 0.85rem; margin-right: 5px;" onclick="selectMember(${idx})">แก้ไข</button>
                  <button class="btn btn-danger" style="padding: 6px 12px; font-size: 0.85rem;" onclick="deleteMemberById(${m.id})">ลบ</button>
              </td>
          </tr>
      `;
  });
}

function selectMember(idx) {
  showEditor('member-editor');

  const m = allMembers[idx];
  document.getElementById('form-title').innerText = 'แก้ไขสมาชิก';
  document.getElementById('btn-delete-mem').style.display = 'block';

  document.getElementById('mem-id').value = m.id;
  document.getElementById('mem-name').value = m.name;
  document.getElementById('mem-position').value = m.position;
  document.getElementById('mem-category').value = m.category_id;
  document.getElementById('mem-old-image').value = m.image_url;

  document.getElementById('mem-preview').innerHTML = m.image_url ? `<img src="../assets/lab/${m.image_url}" width="100" style="border-radius:10px; margin-top:10px;">` : '';

  // เลื่อนจอขึ้นไปที่กล่องแก้ไขอัตโนมัติ
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function openMemberForm() {
  showEditor('member-editor');
  document.getElementById('form-title').innerText = 'เพิ่มสมาชิกใหม่';
  document.getElementById('btn-delete-mem').style.display = 'none';
  document.getElementById('member-form').reset();
  document.getElementById('mem-id').value = '';
  document.getElementById('mem-preview').innerHTML = '';
}

function openLabSettings() { showEditor('lab-settings-editor'); }
function openCategorySettings() { showEditor('category-editor'); }

document.getElementById('member-form').onsubmit = async (e) => {
  e.preventDefault();
  await fetch('../api/lab_api.php?action=save_member', { method: 'POST', body: new FormData(e.target) });
  Swal.fire('สำเร็จ', 'บันทึกข้อมูลสมาชิกเรียบร้อย', 'success');
  loadMembers();
};

// ฟังก์ชันลบสมาชิกจากปุ่มในฟอร์ม
async function deleteMember() {
  const id = document.getElementById('mem-id').value;
  deleteMemberById(id);
}

// ฟังก์ชันลบสมาชิกจากปุ่มในตารางโดยตรง
async function deleteMemberById(id) {
  if (!id) return;
  const result = await Swal.fire({
    title: 'ลบสมาชิก?', text: "ลบแล้วกู้คืนไม่ได้นะครับ", icon: 'warning',
    showCancelButton: true, confirmButtonColor: '#d33', confirmButtonText: 'ลบเลย'
  });
  if (result.isConfirmed) {
    const fd = new FormData(); fd.append('id', id);
    await fetch('../api/lab_api.php?action=delete_member', { method: 'POST', body: fd });
    Swal.fire('ลบแล้ว!', '', 'success');
    loadMembers();

    // ถ้าสมาชิคนที่ลบกำลังเปิดค้างอยู่ในฟอร์มแก้ไข ให้ปิดฟอร์มทิ้งด้วย
    if (document.getElementById('mem-id').value == id) {
      showEditor('');
    }
  }
}

// 🟢 เพิ่มฟังก์ชันสำหรับการค้นหาและกรองตาราง 🟢
function filterTable() {
  const searchText = document.getElementById('search-input').value.toLowerCase();
  const filterCat = document.getElementById('filter-category').value;
  const rows = document.querySelectorAll('#member-table-body tr');

  rows.forEach(row => {
    // ข้ามแถวที่เขียนว่า "กำลังโหลดข้อมูล..." หรือ "ยังไม่มีสมาชิก"
    if (row.cells.length < 5) return;

    const name = row.cells[1].innerText.toLowerCase(); // คอลัมน์ที่ 2 คือ ชื่อ
    const category = row.cells[2].innerText;           // คอลัมน์ที่ 3 คือ หมวดหมู่
    const position = row.cells[3].innerText.toLowerCase(); // คอลัมน์ที่ 4 คือ ตำแหน่ง

    // ตรวจสอบเงื่อนไขการค้นหาข้อความ
    const matchSearch = name.includes(searchText) || position.includes(searchText);

    // ตรวจสอบเงื่อนไขหมวดหมู่
    const matchCategory = (filterCat === 'all') || (category === filterCat);

    // ถ้าตรงทั้ง 2 เงื่อนไขให้โชว์ ถ้าไม่ตรงให้ซ่อนแถว
    if (matchSearch && matchCategory) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
}