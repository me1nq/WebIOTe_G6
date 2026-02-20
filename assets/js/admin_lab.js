function showEditor(type) {
  document.getElementById('welcome-msg').style.display = 'none';
  ['lab-settings-editor', 'member-editor', 'category-editor'].forEach(id => document.getElementById(id).style.display = 'none');
  if (type) document.getElementById(type).style.display = 'block';
}

// --- 1. Info ---
async function loadInfo() {
  const data = await (await fetch('api/lab.php?action=get_info')).json();
  document.getElementById('info-name').value = data.lab_name;
  document.getElementById('info-desc').value = data.description;
  document.getElementById('info-old-logo').value = data.logo_url;
  if (data.logo_url) document.getElementById('logo-preview').innerHTML = `<img src="assets/images/lab/${data.logo_url}" height="80">`;
}
document.getElementById('info-form').onsubmit = async (e) => {
  e.preventDefault();
  await fetch('api/lab.php?action=save_info', { method: 'POST', body: new FormData(e.target) });
  Swal.fire('สำเร็จ', 'บันทึกแล้ว', 'success'); loadInfo();
};

// --- 2. Categories ---
let allCats = [];
async function loadCategories() {
  allCats = await (await fetch('api/lab.php?action=get_categories')).json();
  const list = document.getElementById('category-list');
  const select = document.getElementById('mem-category');

  // Render List ในหน้าจัดการหมวดหมู่
  list.innerHTML = '';
  allCats.forEach(c => {
    list.innerHTML += `
            <div class="cat-item">
                <div style="flex:1; display:flex; gap:10px;">
                    <input type="number" value="${c.display_order}" onchange="updateCat(${c.id}, this.value, '${c.name}')" style="width:50px; border:1px solid #eee; text-align:center; padding:5px;">
                    <input type="text" value="${c.name}" onchange="updateCat(${c.id}, ${c.display_order}, this.value)">
                </div>
                <button class="icon-btn" onclick="deleteCat(${c.id})" style="color:red; border:none; background:none;">🗑️</button>
            </div>`;
  });

  // Render Dropdown ในหน้าสมาชิก
  select.innerHTML = '';
  allCats.forEach(c => {
    select.innerHTML += `<option value="${c.name}">${c.name}</option>`;
  });
}

async function addCategory() {
  const name = document.getElementById('new-cat-name').value;
  const order = document.getElementById('new-cat-order').value;
  if (!name) return;
  const fd = new FormData(); fd.append('name', name); fd.append('display_order', order);
  await fetch('api/lab.php?action=save_category', { method: 'POST', body: fd });
  document.getElementById('new-cat-name').value = '';
  loadCategories();
}

async function updateCat(id, order, name) {
  const fd = new FormData(); fd.append('id', id); fd.append('name', name); fd.append('display_order', order);
  await fetch('api/lab.php?action=save_category', { method: 'POST', body: fd });
  loadCategories(); // รีโหลดเพื่อให้ dropdown อัปเดตด้วย
}

async function deleteCat(id) {
  if (confirm("ลบหมวดหมู่นี้?")) {
    const fd = new FormData(); fd.append('id', id);
    await fetch('api/lab.php?action=delete_category', { method: 'POST', body: fd });
    loadCategories();
  }
}

// --- 3. Members ---
let allMembers = [];
async function loadMembers() {
  allMembers = await (await fetch('api/lab.php?action=get_members')).json();
  const list = document.getElementById('member-list');
  list.innerHTML = '';
  allMembers.forEach((m, idx) => {
    list.innerHTML += `<div class="project-list-item" onclick="selectMember(${idx})"><b>${m.name}</b><br><small>${m.category}</small></div>`;
  });
}

function selectMember(idx) {
  showEditor('member-editor');
  const m = allMembers[idx];
  document.getElementById('form-title').innerText = 'แก้ไขสมาชิก';
  document.getElementById('mem-id').value = m.id;
  document.getElementById('mem-name').value = m.name;
  document.getElementById('mem-position').value = m.position;
  document.getElementById('mem-category').value = m.category;
  document.getElementById('mem-old-image').value = m.image_url;
  document.getElementById('mem-preview').innerHTML = m.image_url ? `<img src="assets/images/lab/${m.image_url}" width="100">` : '';
}

function openMemberForm() { showEditor('member-editor'); document.getElementById('form-title').innerText = 'เพิ่มสมาชิก'; document.getElementById('member-form').reset(); document.getElementById('mem-id').value = ''; document.getElementById('mem-preview').innerHTML = ''; }
function openLabSettings() { showEditor('lab-settings-editor'); }
function openCategorySettings() { showEditor('category-editor'); }

document.getElementById('member-form').onsubmit = async (e) => {
  e.preventDefault();
  await fetch('api/lab.php?action=save_member', { method: 'POST', body: new FormData(e.target) });
  Swal.fire('สำเร็จ', 'บันทึกแล้ว', 'success'); loadMembers();
};

async function deleteMember() {
  const id = document.getElementById('mem-id').value;
  if (id && confirm("ลบ?")) {
    const fd = new FormData(); fd.append('id', id);
    await fetch('api/lab.php?action=delete_member', { method: 'POST', body: fd });
    loadMembers(); showEditor('');
  }
}

// Init
loadInfo(); loadCategories(); loadMembers();