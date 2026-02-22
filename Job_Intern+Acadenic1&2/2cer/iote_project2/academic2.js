document.addEventListener("DOMContentLoaded", function () {
    loadData();
});

function loadData() {

    fetch("getAcademic2.php")
    .then(response => response.json())
    .then(data => {

        if(!data){
            console.log("ยังไม่มีข้อมูลใน database");
            return;
        }

        // แสดงข้อมูล
        document.getElementById("phyTitle").innerText = data.title;
        document.getElementById("phyContent").innerText = data.content;
        document.getElementById("phyTuition").innerText = data.tuition;
        document.getElementById("phyBox").style.backgroundColor = data.bg_color;

        if(data.image_path){
            document.getElementById("phyImage").src = data.image_path;
        }

        const mainBtn = document.getElementById("mainBtn");

        if(data.pdf_path){
            mainBtn.addEventListener("click", function () {
                window.open(data.pdf_path, "_blank");
            });
        } else {
            mainBtn.style.opacity = "0.6";
            mainBtn.style.cursor = "not-allowed";
            mainBtn.innerText = "ยังไม่มีไฟล์ PDF";
        }

    })
    .catch(error => {
        console.error("Error:", error);
    });

}