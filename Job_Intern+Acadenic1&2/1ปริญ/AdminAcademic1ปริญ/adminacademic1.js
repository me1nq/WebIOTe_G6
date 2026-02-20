const titleInput = document.getElementById("titleInput");
const contentInput = document.getElementById("contentInput");
const tuitionInput = document.getElementById("tuitionInput");
const colorInput = document.getElementById("colorInput");
const imageInput = document.getElementById("imageInput");

const previewTitle = document.getElementById("previewTitle");
const previewContent = document.getElementById("previewContent");
const previewTuition = document.getElementById("previewTuition");
const previewImage = document.getElementById("previewImage");

function loadData() {
    titleInput.value = localStorage.getItem("iotTitle") || "ทำไมต้องไอโอที ลาดกระบัง ?";
    contentInput.value = localStorage.getItem("iotContent") || "เนื้อหา IoT...";
    tuitionInput.value = localStorage.getItem("iotTuition") || 25000;
    colorInput.value = localStorage.getItem("iotColor") || "#f4b183";

    updatePreview();
}

function updatePreview() {
    previewTitle.innerText = titleInput.value;
    previewContent.innerText = contentInput.value;
    previewTuition.innerText = tuitionInput.value + " บาท / ภาคการศึกษา";
    document.querySelector(".preview-box").style.backgroundColor = colorInput.value;
}

function saveData() {
    localStorage.setItem("iotTitle", titleInput.value);
    localStorage.setItem("iotContent", contentInput.value);
    localStorage.setItem("iotTuition", tuitionInput.value);
    localStorage.setItem("iotColor", colorInput.value);
    alert("บันทึกเรียบร้อย");
}

imageInput.addEventListener("change", function(event){
    const reader = new FileReader();
    reader.onload = function(){
        previewImage.src = reader.result;
        localStorage.setItem("iotImage", reader.result);
    }
    reader.readAsDataURL(event.target.files[0]);
});

titleInput.oninput = updatePreview;
contentInput.oninput = updatePreview;
tuitionInput.oninput = updatePreview;
colorInput.oninput = updatePreview;

window.onload = loadData;
