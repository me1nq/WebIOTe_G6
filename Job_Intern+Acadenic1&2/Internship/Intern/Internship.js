document.addEventListener("DOMContentLoaded", function () {
    loadInternships();
});

function loadInternships() {
    const container = document.querySelector(".container");
    const data = JSON.parse(localStorage.getItem("internships"));

    if (!data) return; // ถ้าไม่มีข้อมูลให้ใช้ของเดิมใน HTML

    container.innerHTML = "";

    data.forEach((item, index) => {
        container.innerHTML += `
        <div class="card">
            <img src="${item.image}">
            <div class="content">
                <h2>${item.company}</h2>
                <p class="position">${item.position}</p>
                <p class="date">${item.date}</p>
                <button onclick="toggleDetail(${index})">รายละเอียดเพิ่มเติม</button>
                <div class="detail">
                    <ul>
                        ${item.details.map(d => `<li>${d}</li>`).join("")}
                    </ul>
                </div>
            </div>
        </div>
        `;
    });
}

function toggleDetail(index) {
    const details = document.querySelectorAll(".detail");
    const current = details[index];

    if (current.style.maxHeight) {
        current.style.maxHeight = null;
    } else {
        current.style.maxHeight = current.scrollHeight + "px";
    }
}
