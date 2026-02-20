document.addEventListener("DOMContentLoaded", function () {

    const titleInput = document.getElementById("titleInput");
    const contentInput = document.getElementById("contentInput");
    const tuitionInput = document.getElementById("tuitionInput");
    const colorInput = document.getElementById("colorInput");
    const imageInput = document.getElementById("imageInput");

    const previewTitle = document.getElementById("previewTitle");
    const previewContent = document.getElementById("previewContent");
    const previewTuition = document.getElementById("previewTuition");
    const previewImage = document.getElementById("previewImage");
    const previewBox = document.querySelector(".preview-box");

    function loadData() {
        titleInput.value = localStorage.getItem("phyTitle") || "";
        contentInput.value = localStorage.getItem("phyContent") || "";
        tuitionInput.value = localStorage.getItem("phyTuition") || "";
        colorInput.value = localStorage.getItem("phyColor") || "#f4b183";

        previewImage.src = localStorage.getItem("phyImage") || "pic2.png";

        updatePreview();
    }

    function updatePreview() {
        previewTitle.innerText = titleInput.value;
        previewContent.innerText = contentInput.value;
        previewTuition.innerText = tuitionInput.value + " บาท / ภาคการศึกษา";
        previewBox.style.backgroundColor = colorInput.value;
    }

    window.saveData = function () {
        localStorage.setItem("phyTitle", titleInput.value);
        localStorage.setItem("phyContent", contentInput.value);
        localStorage.setItem("phyTuition", tuitionInput.value);
        localStorage.setItem("phyColor", colorInput.value);
        alert("บันทึกสำเร็จ");
    };

    imageInput.addEventListener("change", function (event) {
        const reader = new FileReader();
        reader.onload = function () {
            previewImage.src = reader.result;
            localStorage.setItem("phyImage", reader.result);
        };
        reader.readAsDataURL(event.target.files[0]);
    });

    titleInput.oninput = updatePreview;
    contentInput.oninput = updatePreview;
    tuitionInput.oninput = updatePreview;
    colorInput.oninput = updatePreview;

    loadData();
});
