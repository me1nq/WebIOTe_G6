function loadData() {
    document.getElementById("iotTitle").innerText =
        localStorage.getItem("iotTitle") ||
        "ทำไมต้องไอโอที (IoT) ลาดกระบัง ?";

    document.getElementById("iotContent").innerText =
        localStorage.getItem("iotContent") ||
        "หลักสูตรมุ่งเน้นการพัฒนา IoT ครบวงจร ทั้งฮาร์ดแวร์และซอฟต์แวร์";

    document.getElementById("iotTuition").innerText =
        localStorage.getItem("iotTuition") || "25,000";

    document.getElementById("iotBox").style.backgroundColor =
        localStorage.getItem("iotColor") || "#f4b183";

    if (localStorage.getItem("iotImage")) {
        document.getElementById("iotImage").src =
            localStorage.getItem("iotImage");
    }
}

window.onload = loadData;
