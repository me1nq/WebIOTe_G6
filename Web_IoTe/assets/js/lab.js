async function init() {
  try {
    // 1. ดึงข้อมูล Lab
    const infoRes = await fetch('api/lab.php?action=get_info');
    const info = await infoRes.json();
    if (info) {
      document.getElementById('header-content').innerHTML = (info.logo_url ? `<img src="assets/images/lab/${info.logo_url}" class="lab-logo"><br>` : '') + `<h2>${info.lab_name}</h2>`;
      if (info.description) {
        document.getElementById('desc-content').innerText = info.description;
        document.getElementById('desc-content').style.display = 'block';
      }
    }

    // 2. ดึงหมวดหมู่ และ สมาชิก
    const catRes = await fetch('api/lab.php?action=get_categories');
    const categories = await catRes.json();

    const memRes = await fetch('api/lab.php?action=get_members');
    const members = await memRes.json();

    const container = document.getElementById('members-container');
    container.innerHTML = '';

    // 3. วาดหน้าจอใหม่ (จับคู่ด้วย category_id)
    if (categories && members) {
      categories.forEach(cat => {
        const catMembers = members.filter(m => m.category_id == cat.id);

        if (catMembers.length > 0) {
          container.innerHTML += `<div class="section-title">${cat.category_name}</div>`;

          let grid = `<div class="members-grid">` + catMembers.map(m => `
                        <div class="member-card">
                            <img src="${m.image_url ? `assets/images/lab/${m.image_url}` : 'assets/images/default_user.png'}" class="member-img">
                            <div class="member-name">${m.name}</div>
                            <div class="member-pos">${m.position}</div>
                        </div>
                    `).join('') + `</div>`;

          container.innerHTML += grid;
        }
      });
    }
  } catch (e) {
    console.error("Error:", e);
    document.getElementById('members-container').innerHTML = '<p style="text-align:center; color:red;">เกิดข้อผิดพลาด กรุณาล้าง Cache ของเบราว์เซอร์</p>';
  }
}

init();