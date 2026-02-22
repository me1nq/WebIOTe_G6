function saveData() {

    const formData = new FormData();
    formData.append("title", document.getElementById("titleInput").value);
    formData.append("content", document.getElementById("contentInput").value);
    formData.append("tuition", document.getElementById("tuitionInput").value);
    formData.append("color", document.getElementById("colorInput").value);

    const imageFile = document.getElementById("imageInput").files[0];
    const pdfFile = document.getElementById("pdfInput").files[0];

    if (imageFile) {
        formData.append("image", imageFile);
    }

    if (pdfFile) {
        formData.append("pdf", pdfFile);
    }

    fetch("updateAcademic2.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert("บันทึกข้อมูลสำเร็จ");
    })
    .catch(error => {
        console.error("Error:", error);
    });
}