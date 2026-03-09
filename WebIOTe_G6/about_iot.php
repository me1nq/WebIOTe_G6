<?php 
session_start(); 
include 'includes/db.php'; 
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About IoTe</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link rel="stylesheet" href="css/style.css?v=1">
    <link rel="stylesheet" href="css/about.css?v=1">
</head>
<body>

    <?php include 'includes/navbar.php'; ?>

    <div class="page-header">
        About IoTe
    </div>

    <div class="page-background">
        <div class="content-card">
            
            <div class="tabs">
                <button class="tab-btn active" onclick="openTab(event, 'tab1')">ABOUT IoT System and Information</button>
                <button class="tab-btn" onclick="openTab(event, 'tab2')">ABOUT Dual Degree</button>
                <button class="tab-btn" onclick="openTab(event, 'tab3')">ABOUT Industry Physics</button>
            </div>

            <div id="tab1" class="tab-content active">
                <h2 class="content-title">วิศวกรรมระบบไอโอทีและสารสนเทศคืออะไร ?</h2>
                <p class="text-paragraph">ในโลกยุคดิจิทัล 4.0 ที่เทคโนโลยีต่างๆ เข้ามามีบทบาทสำคัญเป็นอย่างมากในชีวิตประจำวันรวมถึงการพัฒนาเศรษฐกิจระดับประเทศ ที่การเชื่อมต่อสื่อสารนั้นเป็นไปอย่างไร้พรมแดน ไม่เพียงแต่การสื่อสารระหว่างมนุษย์อย่างเดียว แต่ยังมีการเชื่อมต่อสื่อสารระหว่างอุปกรณ์กับอุปกรณ์ เครื่องจักร หรือทุกสรรพสิ่ง จึงเป็นที่มาของเทคโนโลยีระบบอินเตอร์เน็ตในทุกสรรพสิ่งหรือเรียกสั้นๆว่า ไอโอที (IoT)</p>
                <p class="text-paragraph">หลักสูตรวิศวกรรมระบบไอโอทีและสารสนเทศ เป็นหลักสูตรที่ตอบสนองต่อนโยบายทางการพัฒนาเศรษฐกิจและอุตสาหกรรมของรัฐบาล โดยมีความสอดคล้องกันกับแผนพัฒนาเศรษฐกิจและสังคมแห่งชาติฉบับที่ 13 (พ.ศ. 2565-2569) ที่ได้มีการกล่าวถึงการเปลี่ยนแปลงทางเทคโนโลยีแบบก้าวกระโดด (Disruption) และหนึ่งในเทคโนโลยีที่สำคัญนั้นคือ เทคโนโลยีระบบไอโอทีและสารสนเทศ</p>
                
                <div class="info-cards">
                    <div class="info-card">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <img src="assets/icon1.png">
                        <p>วิศวกรรมระบบไอโอทีและสารสนเทศ 1 ปริญญา</p>
                    </div>
                    <div class="info-card">
                        <i class="fa-solid fa-chart-simple"></i>
                        <img src="assets/icon2.png">
                        <p>วิศวกรรมระบบไอโอทีและสารสนเทศ+ฟิสิกส์อุตสาหกรรม 2 ปริญญา</p>
                    </div>
                </div>

                <div class="job-section">
                    <h3>อาชีพที่ประกอบได้หลังจบการศึกษา</h3>
                    <div class="job-grid">
                        <div>
                            <ul>
                                <li>วิศวกรระบบไอโอที (IoT Engineer)</li>
                                <li>วิศวกรระบบสารสนเทศ (Information System Engineer)</li>
                                <li>วิศวกรระบบสมองกลฝังตัว (Embedded System Engineer)</li>
                                <li>วิศวกรซอฟต์แวร์ระบบสมองกลฝังตัว (Embedded Software Engineer)</li>
                                <li>นักพัฒนาแอพพลิเคชัน (Application Developer)</li>
                                <li>โปรแกรมเมอร์ (Programmer)</li>
                            </ul>
                        </div>
                        <div>
                            <ul>
                                <li>วิศวกรซอฟต์แวร์ (Software Engineer)</li>
                                <li>นักพัฒนาส่วนหน้า (Front End Developer)</li>
                                <li>นักพัฒนาส่วนเบื้องหลัง (Back End Developer)</li>
                                <li>นักพัฒนาฟูลสแตก (Full Stack Developer)</li>
                                <li>วิศวกรระบบคลาวด์ (Cloud Engineer)</li>
                                <li>วิศวกรระบบเครือข่าย (Network Engineer)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div id="tab2" class="tab-content">
                <h2 class="content-title red-text">ครั้งแรกของประเทศไทย โครงการหลักสูตรปริญญาตรีสองปริญญา (Dual Degree) ระหว่างคณะวิศวกรรมศาสตร์และคณะวิทยาศาสตร์ สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง วศ.บ. วิศวกรรมระบบไอโอทีและสารสนเทศ และ วท.บ. ฟิสิกส์อุตสาหกรรม</h2>
                <p class="text-paragraph" style="text-align: center;">ในโลกยุค Disruption ได้เปลี่ยนแปลงทุกสิ่งไปอย่างรวดเร็ว การรู้เพียงศาสตร์ใดศาสตร์หนึ่งจึงอาจไม่เพียงพอกับการต่อสู้ในยุคแห่งการเปลี่ยนแปลงนี้ โดยเฉพาะอย่างยิ่งทักษะทางดิจิทัลและเทคโนโลยีที่จำเป็นต่อโลกอันไร้พรมแดน จึงเป็นที่มาของหลักสูตร "PhysIoT" ที่ตอบสนองกับการเปลี่ยนแปลงในยุค Disruption นี้</p>
                
                <div class="feature-grid">
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                        <h4>เรียน 4 ปี ได้ 2 ปริญญา</h4>
                        <p>วศ.บ.วิศวกรรมระบบไอโอทีและสารสนเทศ + วท.บ. ฟิสิกส์อุตสาหกรรม</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fa-solid fa-pen"></i></div>
                        <h4>ทลายกำแพงระหว่างคณะ</h4>
                        <p>ศึกษาและปฏิบัติด้านอิเล็กทรอนิกส์อัจฉริยะและสมาร์ทเซ็นเซอร์ การออกแบบและควบคุมอุปกรณ์สมาร์ทดีไวซ์โดยใช้พื้นฐานด้านวงจรไฟฟ้า อิเล็กทรอนิกส์ ระบบดิจิทัล</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fa-solid fa-mobile-screen-button"></i></div>
                        <h4>จบแล้วฮอตสุดไม่มีตกยุค</h4>
                        <p>หากได้ลองค้นหาคำว่า "Top 10 อาชีพไม่ตกงาน" แน่นอนว่าจะต้องเจอกับอาชีพด้านไอทีอย่างแน่นอน เพราะเป็นสายงานที่มีความหลากหลายมากในยุคดิจิทัลไทยแลนด์ 4.0</p>
                    </div>
                </div>

                <div class="job-section">
                    <h3>อาชีพที่ประกอบได้หลังจบการศึกษา</h3>
                    <div class="job-grid">
                        <div>
                            <ul>
                                <li>วิศวกรระบบไอโอที (IoT Engineer)</li>
                                <li>วิศวกรระบบสารสนเทศ (Information System Engineer)</li>
                                <li>วิศวกรระบบสมองกลฝังตัว (Embedded System Engineer)</li>
                                <li>วิศวกรซอฟต์แวร์ระบบสมองกลฝังตัว (Embedded Software Engineer)</li>
                                <li>นักพัฒนาแอพพลิเคชัน (Application Developer)</li>
                                <li>โปรแกรมเมอร์ (Programmer)</li>
                            </ul>
                        </div>
                        <div>
                            <ul>
                                <li>วิศวกรซอฟต์แวร์ (Software Engineer)</li>
                                <li>นักพัฒนาส่วนหน้า (Front End Developer)</li>
                                <li>นักพัฒนาส่วนเบื้องหลัง (Back End Developer)</li>
                                <li>นักพัฒนาฟูลสแตก (Full Stack Developer)</li>
                                <li>วิศวกรระบบคลาวด์ (Cloud Engineer)</li>
                                <li>วิศวกรระบบเครือข่าย (Network Engineer)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div id="tab3" class="tab-content">
                <div class="split-content">
                    <div class="split-image">
                        <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="อาคารพระจอมเกล้า" style="object-fit: cover; height: 350px;">
                    </div>
                    <div class="split-text">
                        <h2 class="content-title" style="text-align: left;">ทำไมต้องเรียน วท.บ. ฟิสิกส์อุตสาหกรรม ที่ สจล. ?</h2>
                        <p class="text-paragraph">หลักสูตรฟิสิกส์อุตสาหกรรมของ สจล. มุ่งพัฒนาความรู้ ทักษะ และเทคโนโลยีต่างๆ ทางฟิสิกส์และการนำศาสตร์ทางฟิสิกส์ไปประยุกต์ใช้งานในอุตสาหกรรมด้านต่างๆ ตอบโจทย์ความต้องการของบริษัทและอุตสาหกรรม เป็นหลักสูตรที่มีความร่วมมือกับหน่วยงานอุตสาหกรรมชั้นนำของประเทศ มีการจัดการเรียนการสอน ที่ให้ความรู้เทคโนโลยีด้านฟิสิกส์ที่รองรับความต้องการของอุตสาหกรรม</p>
                        <p class="text-paragraph">เมื่อนักศึกษาขึ้นชั้นปีที่ 2 นักศึกษาสามารถเลือกเรียนแผน 2 ปริญญาร่วมกับหลักสูตรวิศวกรรมระบบไอโอทีและสารสนเทศ(ฝั่งรับเปิดโดยคณะวิศวกรรมศาสตร์ สจล.) เมื่อเรียนจบแล้วจะได้ปริญญา วท.บ. ฟิสิกส์อุตสาหกรรม และ วศ.บ.วิศวกรรมระบบไอโอทีและสารสนเทศ</p>
                    </div>
                </div>

                <div class="job-section">
                    <h3>อาชีพที่ประกอบได้หลังจบการศึกษา</h3>
                    <div class="job-grid">
                        <div>
                            <ul>
                                <li>วิศวกรระบบไอโอที (IoT Engineer)</li>
                                <li>วิศวกรระบบสารสนเทศ (Information System Engineer)</li>
                                <li>วิศวกรระบบสมองกลฝังตัว (Embedded System Engineer)</li>
                                <li>วิศวกรซอฟต์แวร์ระบบสมองกลฝังตัว (Embedded Software Engineer)</li>
                                <li>นักพัฒนาแอพพลิเคชัน (Application Developer)</li>
                                <li>โปรแกรมเมอร์ (Programmer)</li>
                            </ul>
                        </div>
                        <div>
                            <ul>
                                <li>วิศวกรซอฟต์แวร์ (Software Engineer)</li>
                                <li>นักพัฒนาส่วนหน้า (Front End Developer)</li>
                                <li>นักพัฒนาส่วนเบื้องหลัง (Back End Developer)</li>
                                <li>นักพัฒนาฟูลสแตก (Full Stack Developer)</li>
                                <li>วิศวกรระบบคลาวด์ (Cloud Engineer)</li>
                                <li>วิศวกรระบบเครือข่าย (Network Engineer)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div> </div> <?php 
    include 'includes/footer.php'; 
    ?>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
                tabcontent[i].classList.remove("active");
            }

            tablinks = document.getElementsByClassName("tab-btn");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }

            document.getElementById(tabName).style.display = "block";
            
            setTimeout(() => {
                document.getElementById(tabName).classList.add("active");
            }, 10);
            
            evt.currentTarget.classList.add("active");
        }
    </script>
    <script src="js/script.js"></script>
</body>
</html>