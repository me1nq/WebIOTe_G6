document.addEventListener("DOMContentLoaded", loadInternships);

let editId = null;

document.getElementById("internForm").addEventListener("submit", function(e){
    e.preventDefault();

    const formData = new FormData(this);
    let url = editId ? "update_intern.php" : "save_intern.php";

    if (editId) {
        formData.append("id", editId);
    }

    fetch(url, {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert(editId ? "อัปเดตสำเร็จ" : "บันทึกสำเร็จ");
            editId = null;
            this.reset();
            document.querySelector("button[type='submit']").textContent = "บันทึก";
            loadInternships();
        } else {
            alert("Error: " + data.error);
        }
    })
    .catch(err => console.error(err));
});

function loadInternships() {
    fetch("get_intern.php")
    .then(res => res.json())
    .then(data => {

        const list = document.getElementById("list");
        list.innerHTML = "";

        data.forEach(item => {
            list.innerHTML += `
                <div class="item">
                    <strong>${item.company}</strong><br>
                    ${item.position}<br>
                    <img src="uploads/${item.image}" width="120"><br><br>

                    <button onclick="editIntern(${item.id}, '${item.company}', '${item.position}', '${item.date_range}', \`${item.details}\`)">
                        แก้ไข
                    </button>

                    <button onclick="deleteIntern(${item.id})" style="background:red;">
                        ลบ
                    </button>
                </div>
            `;
        });
    });
}

function editIntern(id, company, position, date_range, details) {

    editId = id;

    document.querySelector("input[name='company']").value = company;
    document.querySelector("input[name='position']").value = position;
    document.querySelector("input[name='date_range']").value = date_range;
    document.querySelector("textarea[name='details']").value = details;

    document.querySelector("button[type='submit']").textContent = "อัปเดตข้อมูล";

    window.scrollTo({ top: 0, behavior: "smooth" });
}

function deleteIntern(id){

    if(!confirm("ยืนยันการลบข้อมูล?")) return;

    fetch("delete_intern.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "id=" + id
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            alert("ลบสำเร็จ");
            loadInternships();
        }else{
            alert("Error: " + data.error);
        }
    })
    .catch(err => console.error(err));
}