-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2026 at 03:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE `personnel` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL COMMENT 'faculty หรือ staff',
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `history` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `program` varchar(100) NOT NULL,
  `popup_role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`id`, `type`, `name`, `role`, `history`, `image`, `program`, `popup_role`) VALUES
(1, 'faculty', 'รศ.ดร.บุณย์ชนะ ภู่ระหงษ์', 'ประธานหลักสูตรวิศวกรรมระบบไอโอทีและสารสนเทศ', 'e-mail : boonchana.pu@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– อส.บ. (เทคโนโลยีอิเล็กทรอนิกส์) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– วศ.ม. (วิศวกรรมสารสนเทศ) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– Microprocessor Application\r\n– Microcontroller\r\n– Robotic\r\n– Internet of Things and Smart System', 'images/aj-Boonchana.png', 'iot', 'ตำแหน่ง : ผู้ประสานงานสาขาวิชาวิศวกรรมสารสนเทศ'),
(2, 'faculty', 'ผศ.ดร.พิกุลแก้ว ตังติสานนท์', 'หัวหน้าภาควิชา', 'e-mail : pikulkaew.ta@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– วศ.บ. (วิศวกรรมสารสนเทศ) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– วศ.ม. (วิศวกรรมสารสนเทศ) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– D.Eng. (Science and Technology) Tokai University, JAPAN\r\n\r\nความเชี่ยวชาญ\r\n– Web Application\r\n– Mobile Application\r\n– Information Security', 'images/aj-Pikulkaew.png', 'iot', 'อาจารย์ประจำหลักสูตร'),
(3, 'faculty', 'ศ.ดร.อภิรัฐ ศิริธราธิวัตร', 'รองหัวหน้าภาควิชา (ฝ่ายวิจัยและนวัตกรรม)', 'null', 'images/aj-Apirat.png', 'iot', ''),
(4, 'faculty', 'ผศ.ดร.วันวิสา ชัชวงษ์', 'รองหัวหน้าภาควิชา (ฝ่ายการเงิน)', 'e-mail : vanvisa.ch@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– อส.บ. เกียรตินิยมอันดับ 2 (เทคโนโลยีอิเล็กทรอนิกส์) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– วศ.ม. (วิศวกรรมสารสนเทศ) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– วศ.ด. (วิศวกรรมไฟฟ้า) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– Electronic\r\n– Bernstein Filter\r\n– Railway Signaling and Operation\r\n– Pattern recognition\r\n– Railway Communications', 'images/aj-Vanvisa.png', 'iot', 'ตำแหน่ง : อาจารย์ประจำหลักสูตร'),
(5, 'faculty', 'ผศ.ดร.ธนวิชญ์ อนุวงค์พินิจ', 'รองหัวหน้าภาควิชา (ฝ่ายวิชาการ)', 'e-mail : thanavit.an@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– B.Eng.(Information Engineering) King Mongkuts Institute of Technology Ladkrabang\r\n– M.Eng.(Information Engineering) King Mongkuts Institute of Technology Ladkrabang\r\n– D.Eng.(Electrical Engineering) King Mongkuts Institute of Technology Ladkrabang\r\n\r\nความเชี่ยวชาญ\r\n– Microprocessor Application\r\n– Internet of Things\r\n– Embedded Systems\r\n– Integrated System\r\n– Railway Signaling, Communication and Operation', 'images/aj-Thanavit.png', 'iot', 'ตำแหน่ง : อาจารย์ประจำหลักสูตร'),
(6, 'faculty', 'ผศ.ดร.นัชนัยน์ รุ่งเหมือนฟ้า', 'รองหัวหน้าภาควิชา (ฝ่ายต่างประเทศและกิจกรรมคณะ)', 'e-mail : natchanai.ro@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– B.Eng.(Electronics Engineering) King Mongkuts Institute of Technology Ladkrabang\r\n– M.Eng.(Control Engineering) King Mongkuts Institute of Technology Ladkrabang\r\n– D.Eng.(Electrical Engineering) King Mongkuts Institute of Technology Ladkrabang\r\n\r\nความเชี่ยวชาญ\r\n– immittance function simulators\r\n– active analog filters\r\n– oscillator design\r\n– chaotic circuit realization', 'images/aj-Natchanai.png', 'iot', 'ตำแหน่ง : อาจารย์ประจำหลักสูตร'),
(7, 'faculty', 'ผศ.ดร.เกล็ดดาว สัตย์เจริญ', 'อาจารย์ประจำภาควิชา (ผู้ช่วยฝ่ายต่างประเทศและกิจกรรมคณะ)', 'e-mail : kleddao.sa@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– Doctoral of Philosophy in Computer Science, University of Buckingham, UK\r\n– Master of Science in Computing (MERIT), University of Buckingham, UK\r\n– Master of Art (Political Science), THAILAND\r\n– Bachelor of Science in Management Technology, KMITL, THAILAND\r\n\r\nความเชี่ยวชาญ\r\n– Human computer interaction\r\n– User Interfaces', 'images/aj-Kleddao.png', 'iot', 'ตำแหน่ง : อาจารย์ประจําหลักสูตร'),
(8, 'faculty', 'ผศ.นิจจารีย์ สัตยารักษ์', 'รองหัวหน้าภาควิชา (ฝ่ายกิจการนักศึกษา)', 'e-mail : nitjaree.sa@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– วศ.บ. (วิศวกรรมคอมพิวเตอร์) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– วศ.ม. (วิศวกรรมไฟฟ้า) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– Software Engineering\r\n– Distributed Testing System', 'images/aj-Nitjaree.png', 'iot', 'ตำแหน่ง : อาจารย์ประจำหลักสูตร'),
(9, 'faculty', 'ผศ.สรพงษ์ วชิรรัตนพรกุล', 'อาจารย์ประจำภาควิชา (ผู้ช่วยฝ่ายกิจการนักศึกษา)', 'e-mail : sorapong.wa@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– อส.บ.(เทคโนโลยีอิเล็กทรอนิกส์) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– วศ.ม. (วิศวกรรมไฟฟ้า) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– Analog and Digital Filter\r\n– Embedded System\r\n– RFID and Application\r\n– Pattern recognition\r\n– Information for Energy', 'images/aj-Sorapong.png', 'iot', 'ตำแหน่ง : อาจารย์ผู้รับผิดชอบหลักสูตร'),
(10, 'faculty', 'ดร.สุวิไล พุ่มโพธิ์', 'รองหัวหน้าภาควิชา (ฝ่ายกิจการภายนอก)', 'null', 'images/aj-Suwilai.png', 'iot', ''),
(11, 'faculty', 'ผศ.ดร.อรรถพล ป้อมสถิตย์', 'อาจารย์ประจำภาควิชา (ผู้ช่วยฝ่ายกิจการภายนอก)', 'e-mail : auttapon.po@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– B.Eng.(Electronics Engineering) King Mongkuts Institute of Technology Ladkrabang\r\n– M.Eng.(Information Engineering) King Mongkuts Institute of Technology Ladkrabang\r\n– D.Eng.(Electrical Engineering) King Mongkuts Institute of Technology Ladkrabang\r\n\r\nความเชี่ยวชาญ\r\n– Cyber Security\r\n– Internetworkind Design\r\n– Information Security', 'images/aj-Auttapon.png', 'iot', 'ตำแหน่ง : อาจารย์ประจําหลักสูตร'),
(12, 'faculty', 'ผศ.ดร.พนารัตน์ เชิญถนอมวงศ์', 'อาจารย์ประจำภาควิชา (ผู้ช่วยฝ่ายกิจการภายนอก)', 'null', 'images/aj-Panarat.png', 'iot', ''),
(13, 'faculty', 'ผศ.ไพศาล สิทธิโยภาสกุล', 'อาจารย์พิเศษ', 'e-mail : paisan-si@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– อส.บ. (เทคโนโลยีคอมพิวเตอร์อุตสาหกรรม) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– วศ.ม. (วิศวกรรมไฟฟ้า) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– Wireless Communication\r\n– Microprocessor Applications\r\n– Digital Filter', 'images/aj-Paisan.png', 'iot', 'ตำแหน่ง : อาจารย์ประจําหลักสูตร'),
(14, 'faculty', 'รศ.ดร.อรรถสิทธิ์ หล่าสกุล', 'อาจารย์พิเศษ', 'e-mail : attasit.la@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– อส.บ. (เทคโนโลยีอิเล็กทรอนิกส์) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– วศ.ม. (วิศวกรรมไฟฟ้า) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– D.Eng. (Electrical Engineering) Tokai University, JAPAN\r\n\r\nความเชี่ยวชาญ\r\n– Digital Processing\r\n– Image Watermarking\r\n– Embedded Systems\r\n– Image Processing\r\n– Machine Vision', 'images/aj-Attasit.png', 'iot', 'ตำแหน่ง : อาจารย์ประจําหลักสูตร'),
(15, 'faculty', 'ศ.ดร.ปิติเขต สู้รักษา', 'อาจารย์', 'e-mail : pitikhate.so@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– กศ.บ. เกียรตินิยม (ฟิสิกส์) มหาวิทยาลัยศรีนครินทรวิโรฒ ปทุมวัน\r\n– วท.ม. (ฟิสิกส์) มหาวิทยาลัยศรีนครินทรวิโรฒ ประสานมิตร\r\n– M.S. (Electrical Engineering) George Washington University, USA\r\n– Ph.D. (Electrical Engineering) University of Houston, USA\r\n\r\nความเชี่ยวชาญ\r\n– IT Automation\r\n– Industrial Informatics', 'images/aj-Pitikhate.png', 'iot', 'ตำแหน่ง : อาจารย์ประจําหลักสูตร'),
(16, 'staff', 'นายธนาตย์ จอมใจเอกชน', 'เจ้าหน้าที่วิศวกร', 'null', 'images/staff-thanat.png', 'iot', ''),
(17, 'staff', 'นายธีรสิทธิ์ โท้ทอง', 'เจ้าหน้าที่วิศวกร', 'null', 'images/staff-teerasit.png', 'iot', ''),
(35, 'faculty', 'รศ.ดร.ภัทรียา ดำรงศักดิ์', 'หัวหน้าภาควิชาฟิสิกส์ ฟิสิกส์อุตสาหกรรม', 'e-mail : pattareeya.da@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– Doctor of Philosophy/Engineering Materials University of Southampton อังกฤษ\r\n\r\nความเชี่ยวชาญ\r\n– OPTICAL SPECTROSCOPY\r\n– SILICON PHOTOVOLTAICS\r\n– FLUORESCENT CONCENTRATORS\r\n– THIN FILM LUMINESCENCE\r\n– FLUORESCENCE SPECTROSCOPY', 'images/aj-Pattareeya.png', 'science', 'ตำแหน่ง : หัวหน้าภาควิชาฟิสิกส์'),
(36, 'faculty', 'รศ.ดร.สาหร่าย เล็กชะอุ่ม', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : sarai.le@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– ปริญญาโท/วศ.ม.(นิวเคลียร์เทคโนโลยี) จุฬาลงกรณ์มหาวิทยาลัย\r\n\r\nความเชี่ยวชาญ\r\n– STIRLING ENGINE\r\n– TISSUE\r\n– SIMULATION\r\n– MEASURING METHOD\r\n– INTERNET OF THING TECHNOLOGY', 'images/aj-Sarai.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(37, 'faculty', 'รศ.ดร.รัชนก สมพรเสน่ห์', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : ratchanok.so@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– Doctor of Philosophy/Physics, University at Buffalo,\r\nThe State University of NY\r\n\r\nความเชี่ยวชาญ\r\n– NANOELECTRONICS\r\n– 2D MATERIALS\r\n– GRAPHENE\r\n– QUANTUM TRANSPORT PHENOMENA\r\n– ELECTRICAL CHARACTERIZATION', 'images/aj-Ratchanok.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(38, 'faculty', 'ผศ.ดร.ศ.ทิพวรรณ คล้ายบุญมี', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : s.tipawan.kh@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– วท.บ. ฟิสิกส์ประยุกต์, สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– วท.ม. ฟิสิกส์ประยุกต์, สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– ปร.ด. ฟิสิกส์ประยุกต์, สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง', 'images/aj-Tipawan.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(39, 'faculty', 'รศ.ดร.อาภาภรณ์ สกุลการะเวก', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : aparporn.sa@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– วิทยาศาสตรดุษฎีบัณฑิต/ฟิสิกส์ จุฬาลงกรณ์มหาวิทยาลัย\r\n\r\nความเชี่ยวชาญ\r\n– THIN FILM\r\n– THERMOELECTRIC MATERIAL\r\n– THERMAL PROPERTY\r\n– MATERIAL SCIENCE\r\n– MATERIAL CHARACTERIZATION', 'images/aj-aparporn.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(40, 'faculty', 'ดร.พิชชานันท์ ธีเศรษฐ์โศภน', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : pichanan.te@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– วท.บ. ฟิสิกส์, มหาวิทยาลัยเกษตรศาสตร์\r\n– วท.ม. ฟิสิกส์เชิงเคมี, มหาวิทยาลัยมหิดล\r\n– Ph.D. Energy, สถาบันเทคโนโลยีแห่งเอเซีย', 'images/aj-pichanan.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(41, 'faculty', 'ผศ.ดร.เมตยา กิติวรรณ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : mettaya.ki@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– Ph.D.(Materials Processing), Tohoku University, Japan\r\n\r\nความเชี่ยวชาญ\r\n– NANO-COATING BY ROTARY CHEMICAL VAPOR DEPOSITION\r\n– SINTERING OF ADVANCED CERAMICS\r\n– MICROWAVE PROCESSING OF MATERIALS\r\n– HYDROGEN SEPARATION MEMBRANE', 'images/aj-mettaya.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(42, 'faculty', 'ผศ.ธนภรณ์ ลีลาวัฒนานนท์ ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : tanaporn.le@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– วท.ม./เทคโนโลยีสารสนเทศ สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– MODELING AND SIMULATION\r\n– SURFACE PLASMONS\r\n– OPTICAL DATA COMMUNICATION', 'images/aj-tanaporn.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(43, 'faculty', 'ผศ.สุรศักดิ์ พิพัฒน์ศาสตร์ ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail :\r\n\r\nประวัติการศึกษา\r\n– วท.ม.(ฟิสิกส์ประยุกต์) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– OPTICS\r\n– ENERGY', 'images/aj-Surasak.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(44, 'faculty', 'ผศ.ดร.ประธาน บุรณศิริ ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : prathan.bu@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– Doctor of Philosophy/Electrical Engineering ,University of Dayton, USA\r\n\r\nความเชี่ยวชาญ\r\n– QUANTITATIVE PHASE IMAGING\r\n– DIGITAL HOLOGRAPHY\r\n– NONLINEAR OPTIC\r\n– LASER STABILIZEATION\r\n– PHOTONIC CRYSTAL\r\n– METAMATERIAL\r\n– METAMATERIAL-MEDICAL PHYSICS\r\n– APPLICATIONS OF SYNCHROTRON RADIATION', 'images/aj-prathan.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(45, 'faculty', 'อ.ธรรมรัตน์ แต่งตั้ง ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : thammarat.ta@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– วศ.ม.วิศวกรรมไฟฟ้า สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– IMAGE PROCESSING\r\n– DATA PROCESSING\r\n– NP-HARD PROBLEM\r\n– ARTIFICIAL INTELLIGENCE\r\n– OPTIMIZATION PROBLEM', 'images/aj-thammarat.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(46, 'faculty', 'อ.สุรชาติ กมลดิลก ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : kamoldiloks@gmail.com\r\n\r\nประวัติการศึกษา\r\n– ปริญญาโท/วท.ม.(สาขาฟิสิกส์ประยุกต์)\r\nสถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– LASERS\r\n– OPTICAL INSTRUMENTS\r\n– PHOTONICS\r\n– FORENSIC SCIENCE\r\n– PHYSICS EDUCATION', 'images/aj-kamoldiloks.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(47, 'faculty', 'ผศ.ดร.ณัฐพร พรหมรส ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : kpnathap@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– Doctor of Engineering/Applied Science fro Electronics and Materials,\r\nKyushu University. ญี่ปุ่น\r\n\r\nความเชี่ยวชาญ\r\n– THIN FILM\r\n– THERMOELECTRIC MATERIAL\r\n– THERMAL PROPERTY\r\n– MATERIAL SCIENCE\r\n– MATERIAL CHARACTERIZATION', 'images/aj-kpnathap.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(48, 'faculty', 'ศ.ดร.เชรษฐา รัตนพันธ์ ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : chesta.ru@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– ปรัชญาดุษฎีบัณฑิต/ฟิสิกส์ประยุกต์ สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– SYNTHESIS\r\n– CHARACTERIZATION\r\n– IMPROVEMENT OF THERMOELECTRIC MATERIALS', 'images/aj-chesta.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(49, 'faculty', 'รศ.ดร.กฤษกร โล้เจริญรัตน์ ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : kitsakorn.lo@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– Ph.D./ Physical Materials Science , Japan Advanced Institute of Science\r\nand Technology, 2550, Japan\r\n\r\nความเชี่ยวชาญ\r\n– CANCER\r\n– PLASMONIC\r\n– NANOPARTICLES', 'images/aj-kitsakorn.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(50, 'faculty', 'ผศ.ดร.ภาณุพล โขลนกระโทก ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : bhanupol.kl@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– วิศวกรรมศาสตรดุษฎีบัณฑิต/วิศวกรรมไฟฟ้า\r\nสถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– MEASUREMENT AND INSTRUMENTATIONS\r\n– FORENSIC SCIENCE\r\n– IMAGE PROCESSING\r\n– SPORT SCIENCE\r\n– COMPUTER AND ELECTRONICS IN AGRICULTURE', 'images/aj-bhanupol.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(51, 'faculty', 'ผศ.ดร.พิศาล ศรีราช ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : pisan.su@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– ปรัชญาดุษฎีบัณฑิต/ฟิสิกส์ มหาวิทยาลัยสงขลานครินทร์\r\n\r\nความเชี่ยวชาญ\r\n– PIEZOELECTRIC MATERIAL\r\n– MATERIALS SCIENCE\r\n– ENERGY HARVESTING SENSOR\r\n– MATERIAL CHARACTERIZATION', 'images/aj-pisan.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(52, 'faculty', 'ดร.ชินพรรธน์ รัตนศิรวิทย์ ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : woraka.ne@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– Ph.D. Physics North Carolina State University, USA\r\n\r\nความเชี่ยวชาญ\r\n– SURFACE PLASMONIC RESONANCE\r\n– NANOTECHNOLOGY\r\n– OPTICAL SENSOR\r\n– SMART FARMING\r\n– STEM EDUCATION', 'images/aj-woraka.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(53, 'faculty', 'ผศ.ดร.กีรยุทธ์ ศรีนวลจันทร์ ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : keerayoot.sr@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– วท.ม.(ฟิสิกส์ประยุกต์)/ฟิสิกส์ประยุกต์\r\nสถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง', 'images/aj-keerayoot.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(54, 'faculty', 'ดร.วิฑูรย์ ยินดีสุข ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : witoon.yi@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– Doctor of Philosophy/Engineering Science,\r\nThe University of Electro-Communications, Japan\r\n\r\nความเชี่ยวชาญ\r\n– SOLAR CELLS\r\n– QUANTUM DOTS\r\n– SOLAR ENERGY\r\n– THIN FILMS\r\n– SILAR METHODS', 'images/aj-witoon.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(55, 'faculty', 'ผศ.ดร.ณัฏกฤษ สมดอก ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : nuttakrit.so@kmitl.ac.th', 'images/aj-nuttakrit.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(56, 'faculty', 'ผศ.ดร.ลัญจกร ตันนุกิจ ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : Lunchakurn.ta@kmitl.ac.th', 'images/aj-Lunchakurn.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(57, 'faculty', 'ดร.เฉลิมพล รุจรดาวงศ์ ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : chalermpol.ru@kmitl.ac.th', 'images/aj-chalermpol.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(58, 'faculty', 'ดร.ยงยุทธ แก้วจำรัส ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : yongyut.ka@kmitl.ac.th', 'images/aj-yongyut.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา'),
(59, 'staff', 'นางสาวสายสุดาวัลย์ สุทธิญาณ ', 'นักวิทยาศาสตร์', 'e-mail : saisudawan1@hotmail.com', 'images/staff-saisudawan.png', 'science', 'ตำแหน่ง : นักวิทยาศาสตร์'),
(60, 'staff', 'นางพิมพร อ่อนละออ ', 'นักวิทยาศาสตร์', 'e-mail : pimporn.be@kmitl.ac.th', 'images/staff-pimporn.png', 'science', 'ตำแหน่ง : นักวิทยาศาสตร์'),
(61, 'staff', 'น.ส.นลิตา สว่างจิตต์ ', 'นักวิทยาศาสตร์', 'e-mail : nalita.sa@kmitl.ac.th', 'images/staff-nalita.png', 'science', 'ตำแหน่ง : นักวิทยาศาสตร์'),
(62, 'staff', 'นางสาวเกศณี เกตุนวม ', 'เจ้าหน้าที่บริหารงานทั่วไป', 'e-mail : kesanee.ke@kmitl.ac.th', 'images/staff-kesanee.png', 'science', 'ตำแหน่ง : เจ้าหน้าบริหารงานทั่วไป เลขานุการ'),
(63, 'staff', 'นายวีระพันธ์ ทิพาพงศ์ ', 'นักวิทยาศาสตร์', 'e-mail : weraphan.ti@kmitl.ac.th', 'images/staff-weraphan.png', 'science', 'ตำแหน่ง : นักวิทยาศาสตร์'),
(64, 'staff', 'นายชวนนท์ มะโน ', 'นักวิทยาศาสตร์', 'e-mail : chawanon.ma@kmitl.ac.th', 'images/staff-chawanon.png', 'science', 'ตำแหน่ง : นักวิทยาศาสตร์'),
(65, 'staff', 'นายสาโรจน์ ชูอำไพ ', 'ผู้ปฏิบัติงานวิทยาศาสตร์', 'e-mail : saroj.ch@kmitl.ac.th', 'images/staff-saroj.png', 'science', 'ตำแหน่ง : ผู้ปฏิบัติงานวิทยาศาสตร์');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `personnel_id` int(11) NOT NULL COMMENT 'เชื่อมโยงกับ id ของ personnel',
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `personnel_id`, `comment_text`, `created_at`) VALUES
(1, 1, 'test', '2026-02-22 07:32:10'),
(2, 5, 'testtttt', '2026-02-22 08:44:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personnel_id` (`personnel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`personnel_id`) REFERENCES `personnel` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
