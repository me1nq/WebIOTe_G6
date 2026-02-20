async function initLab() {
  try {
    const info = await (await fetch('api/lab.php?action=get_info')).json();
    if (info) {
      document.getElementById('header-content').innerHTML = (info.logo_url ? `<img src="assets/images/lab/${info.logo_url}" class="lab-logo"><br>` : '') + `<h2>${info.lab_name}</h2>`;
      if (info.description) { document.getElementById('desc-content').innerText = info.description; document.getElementById('desc-content').style.display = 'block'; }
    }
    const categories = await (await fetch('api/lab.php?action=get_categories')).json();
    const members = await (await fetch('api/lab.php?action=get_members')).json();
    const container = document.getElementById('members-container'); container.innerHTML = '';

    categories.forEach(cat => {
      const catMembers = members.filter(m => m.category === cat.name);
      if (catMembers.length > 0) {
        container.innerHTML += `<div class="section-title">${cat.name}</div>`;
        let gridHtml = '<div class="members-grid">';
        catMembers.forEach(m => {
          const imgSrc = m.image_url ? `assets/images/lab/${m.image_url}` : 'assets/images/default_user.png';
          gridHtml += `<div class="member-card"><img src="${imgSrc}" class="member-img"><div class="member-name">${m.name}</div><div class="member-pos">${m.position}</div></div>`;
        });
        container.innerHTML += gridHtml + '</div>';
      }
    });
  } catch (e) { console.error(e); }
}
initLab();