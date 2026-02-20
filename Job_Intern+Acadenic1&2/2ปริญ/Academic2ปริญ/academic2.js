document.addEventListener("DOMContentLoaded", function () {

    const defaultData = {
        title: "ทำไมต้องเรียนฟิสิกส์ + ไอโอทีลาดกระบัง ?",
        content: "หลักสูตรฟิสิกส์และวิศวกรรมระบบไอโอทีและสารสนเทศ เป็นหลักสูตรบูรณาการที่ผสานความรู้พื้นฐานทางฟิสิกส์เข้ากับเทคโนโลยี IoT สมัยใหม่ มุ่งพัฒนานักศึกษาให้เข้าใจทั้งหลักการทางวิทยาศาสตร์และการประยุกต์ใช้ในโลกดิจิทัล ครอบคลุมการพัฒนาอุปกรณ์อัจฉริยะและสมาร์ทเซ็นเซอร์ การเขียนโปรแกรมและพัฒนาซอฟต์แวร์ ระบบเครือข่าย การวิเคราะห์ข้อมูล และปัญญาประดิษฐ์ เพื่อออกแบบและสร้างนวัตกรรมที่ตอบโจทย์อุตสาหกรรม",
        tuition: "40,000",
        color: "#f4b183",
        image: "pic2.png"
    };

    const title = localStorage.getItem("phyTitle") || defaultData.title;
    const content = localStorage.getItem("phyContent") || defaultData.content;
    const tuition = localStorage.getItem("phyTuition") || defaultData.tuition;
    const color = localStorage.getItem("phyColor") || defaultData.color;
    const image = localStorage.getItem("phyImage") || defaultData.image;

    document.getElementById("phyTitle").innerText = title;
    document.getElementById("phyContent").innerText = content;
    document.getElementById("phyTuition").innerText = tuition;
    document.getElementById("phyBox").style.backgroundColor = color;
    document.getElementById("phyImage").src = image;

});
