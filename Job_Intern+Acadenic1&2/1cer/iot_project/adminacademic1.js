window.onload = function() {

    document.getElementById("title").value =
        localStorage.getItem("iotTitle") || "";

    document.getElementById("content").value =
        localStorage.getItem("iotContent") || "";

    document.getElementById("tuition").value =
        localStorage.getItem("iotTuition") || "";

    document.getElementById("color").value =
        localStorage.getItem("iotColor") || "#f4b183";
};

function saveData() {

    const formData = new FormData();

    formData.append("title", document.getElementById("title").value);
    formData.append("content", document.getElementById("content").value);
    formData.append("tuition", document.getElementById("tuition").value);
    formData.append("color", document.getElementById("color").value);

    const imageFile = document.getElementById("imageInput").files[0];
    const pdfFile = document.getElementById("pdfInput").files[0];

    if (imageFile) formData.append("image", imageFile);
    if (pdfFile) formData.append("pdf", pdfFile);

    fetch("updateAcademic1.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        console.log(data);
        alert("บันทึกสำเร็จ");
    })
    .catch(err => {
        console.error("Error:", err);
    });
}