function loadData() {

    fetch("getAcademic1.php")
        .then(res => res.json())
        .then(data => {

            if (!data) return;

            document.getElementById("iotTitle").innerText = data.title;
            document.getElementById("iotContent").innerText = data.content;
            document.getElementById("iotTuition").innerText = data.tuition;
            document.getElementById("iotBox").style.backgroundColor = data.bg_color;

            if (data.image_path)
                document.getElementById("iotImage").src = data.image_path;

            if (data.pdf_path)
                window.iotPDF = data.pdf_path;
        });
}


function openPDF() {
    if (!window.iotPDF) {
        alert("ยังไม่มีไฟล์ PDF");
        return;
    }
    window.open(window.iotPDF);
}
window.onload = loadData;