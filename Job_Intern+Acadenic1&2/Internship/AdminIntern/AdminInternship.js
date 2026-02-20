document.addEventListener("DOMContentLoaded", loadList);

const form = document.getElementById("internForm");

form.addEventListener("submit", function (e) {
    e.preventDefault();

    const company = document.getElementById("company").value;
    const position = document.getElementById("position").value;
    const date = document.getElementById("date").value;
    const file = document.getElementById("image").files[0];
    const details = document.getElementById("details").value.split(",");

    const reader = new FileReader();

    reader.onload = function () {
        const imageBase64 = reader.result;

        let data = JSON.parse(localStorage.getItem("internships")) || [];

        data.push({
            company,
            position,
            date,
            image: imageBase64,
            details
        });

        localStorage.setItem("internships", JSON.stringify(data));

        form.reset();
        loadList();
    };

    reader.readAsDataURL(file);
});

function loadList() {
    const list = document.getElementById("list");
    list.innerHTML = "";

    let data = JSON.parse(localStorage.getItem("internships")) || [];

    data.forEach((item, index) => {
        list.innerHTML += `
        <div class="item">
            <strong>${item.company}</strong>
            <button onclick="deleteItem(${index})">ลบ</button>
        </div>
        `;
    });
}

function deleteItem(index) {
    let data = JSON.parse(localStorage.getItem("internships"));
    data.splice(index, 1);
    localStorage.setItem("internships", JSON.stringify(data));
    loadList();
}
