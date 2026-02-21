async function fetchProjects() {
  try {
    // 🟢 1. แก้ไข URL ให้เรียกไปที่ API ตัวใหม่ที่เรารวมไฟล์ไว้
    const response = await fetch('api/admission.php?action=get_projects');

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const projects = await response.json();
    renderProjects(projects);
  } catch (error) {
    console.error('Error fetching data:', error);
    document.getElementById('project-container').innerHTML =
      `<p style="text-align:center; color:red;">
          ไม่สามารถดึงข้อมูลได้ (Path ผิด หรือหาไฟล์ไม่เจอ)<br>
          โปรดตรวจสอบว่ามีไฟล์ <b>api/admission.php</b> อยู่จริงไหม
       </p>`;
  }
}

function renderProjects(data) {
  const container = document.getElementById('project-container');
  container.innerHTML = '';
  let currentRound = '';

  data.forEach(project => {
    const roundName = project.round_title || "รอบอื่นๆ";

    if (roundName !== currentRound) {
      currentRound = roundName;
      const roundHeader = document.createElement('div');
      roundHeader.className = 'round-header';
      roundHeader.innerText = currentRound;
      container.appendChild(roundHeader);
    }

    const projectItem = document.createElement('div');
    projectItem.className = 'project-item';

    // 🟢 2. เพิ่มการแสดงผล "เงื่อนไขการรับ" และ "การคำนวณคะแนน" เข้าไปใน HTML
    projectItem.innerHTML = `
            <button class="project-btn">${project.project_name}</button>
            <div class="project-details">
                
                <div class="detail-header">คุณสมบัติ</div>
                <div class="detail-content">${project.details || '-'}</div>
                
                <div class="detail-header" style="margin-top: 15px;">เงื่อนไขการรับ</div>
                <div class="detail-content">${project.conditions || '-'}</div>
                
                <div class="detail-header" style="margin-top: 15px;">การคำนวณคะแนน</div>
                <div class="detail-content">${project.scoring || '-'}</div>

                <div class="detail-footer">
                    <div>รายละเอียดเปิดรับ: <a href="${project.apply_link}" target="_blank" class="apply-link">คลิกที่นี่</a></div>
                    <div class="seat-badge">${project.seat_count} คน</div>
                </div>
            </div>`;
    container.appendChild(projectItem);

    const btn = projectItem.querySelector('.project-btn');
    const content = projectItem.querySelector('.project-details');

    btn.addEventListener('click', () => {
      if (content.style.maxHeight) {
        content.style.maxHeight = null;
        content.classList.remove('active');
      } else {
        content.classList.add('active');
        content.style.maxHeight = content.scrollHeight + "px";
      }
    });
  });
}

fetchProjects();