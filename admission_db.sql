-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2026 at 04:01 PM
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
-- Database: `admission_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission_projects`
--

CREATE TABLE `admission_projects` (
  `id` int(11) NOT NULL,
  `round_name` varchar(100) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `conditions` text DEFAULT NULL,
  `scoring` text DEFAULT NULL,
  `seat_count` int(11) DEFAULT NULL,
  `apply_link` varchar(255) DEFAULT NULL,
  `round_id` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission_projects`
--

INSERT INTO `admission_projects` (`id`, `round_name`, `project_name`, `details`, `conditions`, `scoring`, `seat_count`, `apply_link`, `round_id`) VALUES
(1, 'รอบที่ 1 PORTFOLIO', 'โครงการ YOUNG ENGINEERING TALENT', '<ul><li>รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง</li><li>รับผู้สมัครที่จบจาก รร. หลักสูตรนานาชาติ</li><li>รับผู้สมัครที่จบจาก รร. หลักสูตรอาชีวะ</li><li>ผู้สมัครจะต้องมีผลการเรียนเฉลี่ยสะสมรวมอย่างน้อย 5 ภาคการศึกษา ไม่น้อยกว่า 3.50</li><li>เป็นผู้ที่เคยได้รับรางวัลการแข่งขันในระดับชาติหรือระดับนานาชาติอย่างน้อย 1 รายการ ทางด้านคณิตศาสตร์ – วิทยาศาสตร์ หรือเทคโนโลยีที่เกี่ยวข้องกับสาขาวิชาที่สมัคร ทั้งนี้ต้องเป็นงานที่จัดขึ้นโดยหน่วยงานซึ่งเป็นที่ยอมรับ อย่างกว้างขวาง</li><li>เป็นผู้ไม่มีโรคสำคัญที่เป็นอุปสรรคต่อการศึกษา</li></ul>', '<ul></ul>', '<ul></ul>', 30, 'https://new.reg.kmitl.ac.th/admission/#/', 1),
(2, 'รอบที่ 1 PORTFOLIO', 'โครงการเรียนดี ช้างเผือก กลุ่มโรงเรียนสายสามัญ', '<ul><li>รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง</li><li>รับผู้สมัครที่จบจาก รร. หลักสูตรนานาชาติ</li><li>โรงเรียนมีสิทธิ์เสนอชื่อนักเรียนได้ตามจํานวนและต้องให้นักเรียนที่มีผลการเรียนเฉลี่ยรวมอย่างน้อย 5 ภาคการศึกษา (ในระดับชั้นมัธยมศึกษาปีที่ 4-6) สูงที่สุด ได้รับสิทธิ์ในการส่งรายชื่อก่อนเสมอ</li></ul>', '<ul></ul>', '<ul></ul>', 30, 'https://admission.reg.kmitl.ac.th/#/', 1),
(3, 'รอบที่ 1 PORTFOLIO', 'โครงการรางวัลและเกียรติบัตรวิชาการ', '<ul><li>รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง</li><li>รับผู้สมัครที่จบจาก รร. หลักสูตรนานาชาติ</li><li>เป็นผู้ไม่มีโรคสำคัญที่เป็นอุปสรรคต่อการศึกษา</li><li>ผู้สมัครจะต้องมีผลการเรียนเฉลี่ยสะสมรวมอย่างน้อย 5 ภาคการศึกษา ไม่น้อยกว่า 3.00</li><li>เป็นผู้ที่มีผลงาน รางวัล หรือประกาศนียบัตร</li></ul>', '<ul></ul>', '<ul></ul>', 30, 'https://new.reg.kmitl.ac.th/admission/#/', 1),
(4, 'รอบที่ 1 PORTFOLIO', 'โครงการโรงเรียนวิทยาศาสตร์', '<ul><li>รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง</li><li>รับผู้สมัครที่จบจาก รร. หลักสูตรนานาชาติ</li><li>เป็นผู้ไม่มีโรคสำคัญที่เป็นอุปสรรคต่อการศึกษา</li><li>ผู้สมัครจะต้องมีผลการเรียนเฉลี่ยสะสมรวมอย่างน้อย 5 ภาคการศึกษา ไม่น้อยกว่า 3.00</li><li>เป็นผู้ที่กำลังศึกษาระดับชั้นมัธยมศึกษาปีที่ 6 (สายวิทยาศาสตร์ – คณิตศาสตร์) ในโรงเรียนวิทยาศาสตร์ หรือโรงเรียนที่มีโครงการห้องเรียนพิเศษด้านวิทยาศาสตร์ คณิตศาสตร์ หรือโรงเรียนที่มีการจัดการเรียนสอนให้แก่ผู้มีความสามารถ พิเศษด้านคณิตศาสตร์และวิทยาศาสตร์</li></ul>', '<ul></ul>', '<ul></ul>', 30, 'https://new.reg.kmitl.ac.th/admission/#/', 1),
(5, 'รอบที่ 1 PORTFOLIO', 'โครงการ Engineering Pathway', '<ul><li>รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง</li><li>รับผู้สมัครที่จบจาก รร. หลักสูตรนานาชาติ</li><li>รับผู้สมัครที่จบจาก รร. หลักสูตรอาชีวะ</li><li>เป็นผู้ที่เข้าร่วมเรียนในโครงการ Pre-Engineering School ที่จัดโดยคณะวิศวกรรมศาสตร์ สจล. และได้คะแนนเฉลี่ยสะสมรวมอย่างน้อย 3.5 จากการเรียน 6 วิชา</li><li>เป็นผู้ไม่มีโรคสำคัญที่เป็นอุปสรรคต่อการศึกษา</li></ul>', '<ul></ul>', '<ul></ul>', 30, 'https://new.reg.kmitl.ac.th/admission/#/', 1),
(6, 'รอบที่ 1 PORTFOLIO', 'โครงการให้โควตานักเรียนมูลนิธิส่งเสริมโอลิมปิกวิชาการและพัฒนามาตรฐานวิทยาศาสตร์ศึกษาในพระอุปถัมภ์สมเด็จพระเจ้าพี่นางเธอ เจ้าฟ้ากัลยาณิวัฒนา กรมหลวงนราธิวาสราชนครินทร์ (สอวน.)', '<ul><li>รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง</li><li>รับผู้สมัครที่จบจาก รร. หลักสูตรนานาชาติ</li><li>สำเร็จการศึกษาหรือกำลังศึกษาระดับชั้นมัธยมศึกษาปีที่ 6 (สายวิทยาศาสตร์ – คณิตศาสตร์และแผนการเรียนศิลป์ – คำนวณ)</li><li>ต้องมีผลการเรียนเฉลี่ยสะสมรวมอย่างน้อยรวม 4 ภาคการศึกษา ไม่น้อยกว่า 2.75</li><li>เป็นผู้สำเร็จการอบรมค่าย 2 ของมูลนิธิ สอวน.</li></ul>', '<ul></ul>', '<ul></ul>', 40, 'https://new.reg.kmitl.ac.th/admission/#/', 1),
(7, 'รอบที่ 1 PORTFOLIO', 'โครงการ บุตรของบุคลากรสถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง', '<ul><li>รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง</li><li>รับผู้สมัครที่จบจาก รร. หลักสูตรนานาชาติ</li><li>เป็นผู้ที่กำลังศึกษาระดับชั้นมัธยมศึกษาปีที่ 6 (สายวิทยาศาสตร์ – คณิตศาสตร์)</li><li>ต้องมีผลการเรียนเฉลี่ยสะสมรวมอย่างน้อยรวม 5 ภาคการศึกษา ไม่น้อยกว่า 2.75</li><li>เป็นผู้ไม่มีโรคสำคัญที่เป็นอุปสรรคต่อการศึกษา</li><li>ผู้สมัครต้องเป็นบุตรโดยชอบด้วยกฎหมายของพนักงานสถาบัน ข้าราชการ หรือลูกจ้างประจำของสถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบังเท่านั้น ซึ่งยกเว้นบุตรบุญธรรม</li></ul>', '<ul></ul>', '<ul></ul>', 5, 'https://new.reg.kmitl.ac.th/admission/#/', 1),
(8, 'รอบที่ 2 QUOTA', 'โควตาเรียนดี', '<ul><li>รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง</li><li>รับผู้สมัครที่จบจาก รร. หลักสูตรนานาชาติ</li><li>รับผู้สมัครที่จบจาก รร. หลักสูตรอาชีวะ</li><li>มีผลการเรียนเฉลี่ยสะสมรวมอย่างน้อยรวม 5 ภาคการศึกษา ไม่น้อยกว่า 3.00</li></ul>', '<ul></ul>', '<ul></ul>', 15, 'https://new.reg.kmitl.ac.th/admission/#/', 2),
(9, 'รอบที่ 2 QUOTA', 'โควตากิจกรรม K- Engineering', '<ul><li>รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง</li><li>รับผู้สมัครที่จบจาก รร. หลักสูตรนานาชาติ</li><li>รับผู้สมัครที่จบจาก รร. หลักสูตรอาชีวะ</li><li>มีผลการเรียนเฉลี่ยสะสมรวมอย่างน้อยรวม 5 ภาคการศึกษา ไม่น้อยกว่า 2.75</li><li>เป็นผู้ที่ผ่านการเข้าร่วมกิจกรรมและได้รับประกาศนียบัตรในโครงการทางวิชาการกับ คณะ วิศวกรรมศาสตร์ สจล.</li></ul>', '<ul></ul>', '<ul></ul>', 15, 'https://new.reg.kmitl.ac.th/admission/#/', 2),
(10, 'รอบที่ 2 QUOTA', 'โควตา KMITL One', '<ul><li>รับผู้สมัครที่จบจาก รร. หลักสูตรแกนกลาง</li><li>รับผู้สมัครที่จบจาก รร. หลักสูตรนานาชาติ</li><li>รับผู้สมัครที่จบจาก รร. หลักสูตรอาชีวะ</li><li>มีผลการเรียนเฉลี่ยสะสมรวม 5 ภาคการศึกษา มากกว่า 3.00 หรือมากกว่า 2.75 สำหรับผู้สมัครโครงการ K-Engineering</li></ul>', '<ul></ul>', '<ul></ul>', 15, 'https://new.reg.kmitl.ac.th/admission/#/', 2),
(11, 'รอบที่ 3 ADMISSION', 'Admission', '<ul><li>ใช้คะแนน A-Level ในการยื่นสมัคร</li><li>คัดเลือกผ่านระบบ TCAS ของ ทปอ.</li></ul>', '<ul><li>กำลังศึกษาหรือสำเร็จการศึกษาระดับมัธยมศึกษาตอนปลายสาย วิทย์-คณิต หรือประกาศนียบัตรวิชาชีพ (ปวช.) สายช่างอุตสาหกรรม ผู้สมัครต้องมีคะแนน TGAT</li><li>, TPAT3 , A-level Math 1 และ Physics</li></ul>', '<ul><li>ความถนัดทั่วไป (TGAT)                                                                     20 %</li><li>ความถนัดวิทยาศาสตร์ เทคโนโลยี วิศวกรรมศาสตร์ (TPAT3)      25 %</li><li>A-Level คณิตศาสตร์ประยุกต์ 1 (พื้นฐาน+เพิ่มเติม)                      25 %</li><li>A-Level ฟิสิกส์                                                                                  30 %</li></ul>', 5, 'https://new.reg.kmitl.ac.th/admission/#/', 3);

-- --------------------------------------------------------

--
-- Table structure for table `admission_rounds`
--

CREATE TABLE `admission_rounds` (
  `id` int(11) NOT NULL,
  `round_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission_rounds`
--

INSERT INTO `admission_rounds` (`id`, `round_name`) VALUES
(1, 'รอบที่ 1 Portfolio'),
(2, 'รอบที่ 2 QUOTA'),
(3, 'รอบที่ 3 ADMISSION');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `display_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `display_order`) VALUES
(1, 'Researcher', 1),
(3, 'Penetration Testing', 3),
(4, 'Network infrastructure', 4),
(5, 'AI', 2);

-- --------------------------------------------------------

--
-- Table structure for table `labs`
--

CREATE TABLE `labs` (
  `id` int(11) NOT NULL,
  `lab_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `labs`
--

INSERT INTO `labs` (`id`, `lab_name`, `description`, `logo_url`) VALUES
(1, 'Cybersecurity Laboratory', 'IT and IoT Cyber Security Laboratory** is a dedicated environment where students, professionals, and researchers can practice and enhance their skills in defending against and analyzing cyber threats. These labs are equipped with tools and technologies that simulate real-world cyber attacks and defense strategies, allowing users to test their knowledge in a controlled, safe setting.\r\nCyber security labs typically focus on two main areas:\r\n– Defensive Security**: This includes activities like setting up firewalls, intrusion detection systems, encryption methods, and network security configurations to protect against attacks.\r\n– Offensive Security**: In this area, participants engage in ethical hacking and penetration testing to identify and exploit vulnerabilities in systems, websites, or networks, helping to build a deeper understanding of how attackers operate.\r\nA cyber security lab is essential for mastering both offensive and defensive techniques in the constantly evolving landscape of digital threats, making it a vital resource for cybersecurity education and skill development.\r\nThe IT and IoT Cyber Security Laboratory consists of research in three main areas.\r\n1. Network Infrastructure, IoT and Wireless Security\r\n2. Cyber Security with AI Data analytics\r\n3. Penetration Testing and Cyber Attack', 'lab_logo_1771599591.png'),
(2, 'AI & Data Science Laboratory', 'ห้องปฏิบัติการปัญญาประดิษฐ์และวิทยาการข้อมูล...', '');

-- --------------------------------------------------------

--
-- Table structure for table `lab_members`
--

CREATE TABLE `lab_members` (
  `id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lab_members`
--

INSERT INTO `lab_members` (`id`, `lab_id`, `category_id`, `name`, `position`, `image_url`, `display_order`) VALUES
(6, 2, 1, 'ดร.สมชาย ใจดี', 'AI Specialist', '', 1),
(12, 1, 1, 'ผศ.ดร.อรรถพล ป้อมสถิตย์', '', '69987f7a06c26.webp', 0),
(13, 1, 5, 'ชินวัตร ศิลาธนสาร', '', '699875a53b54a.webp', 0),
(14, 1, 5, 'ฐิติพันต์ สอนโคตร', '', '699875b0eb701.webp', 0),
(15, 1, 5, 'โกเมศ ประกอบผล', '', '699875bd653f7.webp', 0),
(16, 1, 5, 'จตุภัทร ขจรชัยกุล', '', '699875d38affd.webp', 0),
(17, 1, 5, 'ณัชกานต์ อุ่นทรัพย์', '', '699875e463721.webp', 0),
(18, 1, 5, 'อภิสรา สมมุติ', '', '699875ee6e0a0.webp', 0),
(19, 1, 5, 'อภิรัก จีนทั่ง', '', '699875fcc5e13.webp', 0),
(20, 1, 3, 'ศุภฤกษ์ หาระสาร', '', '69987626a1157.webp', 0),
(21, 1, 3, 'สรพัศ พิศิลป์', '', '6998762fcdae2.webp', 0),
(22, 1, 3, 'ภัทรชนน เมธาวุฒิยาภรณ์', '', '6998763d19d16.webp', 0),
(23, 1, 3, 'พันวินทร์ ชุติกาญจนโรจน์', '', '699876495a154.webp', 0),
(24, 1, 3, 'ปณวัฒน์ นามสง่า', '', '6998765846f15.webp', 0),
(25, 1, 3, 'บุศราพร มิทธิศร', '', '6998766510862.webp', 0),
(26, 1, 4, 'กฤษณ์ เกษมเทวินทร์', '', '6998768789877.webp', 0),
(27, 1, 4, 'ธีรเมธ พินทุไพศิษฎ์วงศ์', '', '699876931ea87.webp', 0),
(28, 1, 4, 'อิทธิกร แป้นบางนา', '', '699876a3a0baa.webp', 0),
(29, 1, 4, 'นพรุจ จิตถวิล', '', '699876b066e77.webp', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `credit` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `course_code`, `name`, `credit`, `category`) VALUES
(1, '90644007', 'ภาษาอังกฤษพื้นฐาน 1 / FOUNDATION ENGLISH 1', 3, 'gen'),
(2, '90644008', 'ภาษาอังกฤษพื้นฐาน 2 / FOUNDATION ENGLISH 2', 3, 'gen'),
(3, '90642118', 'โปรแกรมคอมพิวเตอร์ประยุกต์ทางธุรกิจ', 2, 'gen'),
(4, '90642036', 'เตรียมความพร้อมสำหรับวิศวกร / PRE-ACTIVITIES FOR ENGINEERS', 1, 'gen'),
(5, '90642999', 'โรงเรียนสร้างเสน่ห์ / CHARM SCHOOL', 3, 'gen'),
(6, '90641004', 'โครงงานกลุ่ม 1 / TEAM PROJECT 1', 1, 'gen'),
(7, '90641005', 'โครงงานกลุ่ม 2 / TEAM PROJECT 2', 1, 'gen'),
(8, '90641006', 'โครงงานกลุ่ม 3 / TEAM PROJECT 3', 1, 'gen'),
(9, '90641007', 'พลเมืองดิจิทัล / DIGITAL CITIZEN', 3, 'gen'),
(10, '01006030', 'แคลคูลัส 1 / CALCULUS 1', 3, 'core'),
(11, '01006031', 'แคลคูลัส 2 / CALCULUS 2', 3, 'core'),
(12, '01006032', 'สมการอนุพันธ์และพีชคณิตเชิงเส้นพื้นฐาน', 3, 'core'),
(13, '01236200', 'สถิติวิศวกรรม / ENGINEERING STATISTICS', 3, 'core'),
(14, '01006020', 'ฟิสิกส์ทั่วไป 1 / GENERAL PHYSICS 1', 3, 'core'),
(15, '01006021', 'ปฏิบัติการฟิสิกส์ทั่วไป 1 / GENERAL PHYSICS LAB 1', 1, 'core'),
(16, '01006022', 'ฟิสิกส์ทั่วไป 2 / GENERAL PHYSICS 2', 3, 'core'),
(17, '01006023', 'ปฏิบัติการฟิสิกส์ทั่วไป 2 / GENERAL PHYSICS LAB 2', 1, 'core'),
(18, '01236250', 'สนามแม่เหล็กไฟฟ้า / ELECTROMAGNETIC FIELDS', 3, 'core'),
(19, '01236251', 'คณิตศาสตร์ดิสครีต / DISCRETE MATHEMATICS', 3, 'core'),
(20, '01236252', 'คณิตศาสตร์สำหรับวิทยาการข้อมูล / MATH FOR DATA SCIENCE', 4, 'core'),
(21, '99999999', 'Umamusume', 99, '0'),
(22, '01236249', 'พื้นฐานการออกแบบระบบดิจิทัล / FUNDAMENTAL OF DIGITAL SYSTEM DESIGN', 3, 'core'),
(23, '01236254', 'วงจรไฟฟ้าและอิเล็กทรอนิกส์ / CIRCUITS AND ELECTRONICS', 3, 'core'),
(24, '01236255', 'พื้นฐานระบบไอโอที / INTRODUCTION TO IoT', 3, 'core'),
(25, '01236256', 'ไมโครคอนโทรลเลอร์และระบบสมองกลฝังตัว / MICROCONTROLLER AND EMBEDDED', 3, 'core'),
(26, '01236257', 'การเขียนโปรแกรมเชิงวัตถุและโครงสร้างข้อมูล / OOP & DATA STRUCTURE', 3, 'core'),
(27, '01236258', 'การสื่อสารพื้นฐาน / PRINCIPLES OF COMMUNICATIONS', 3, 'core'),
(28, '01236259', 'ระบบโครงข่ายไอโอทีและการสื่อสารข้อมูล / IoT NETWORKS AND DATA COM.', 3, 'core'),
(29, '01236260', 'ระบบไซเบอร์ทางกายภาพและเซ็นเซอร์ / CYBER-PHYSICAL SYSTEM AND SENSOR', 3, 'core'),
(30, '01236261', 'การพัฒนาแอปพลิเคชันบนโมไบล์ / MOBILE APPLICATION DEVELOPMENT', 3, 'core'),
(31, '01236262', 'การออกแบบเชิงปฏิสัมพันธ์ / INTERACTION DESIGN', 3, 'core'),
(32, '01236263', 'ระบบไอโอทีในอุตสาหกรรม / INDUSTRIAL INTERNET OF THINGS', 3, 'core'),
(33, '01236264', 'ปัญญาประดิษฐ์ในทุกสรรพสิ่ง / ARTIFICIAL INTELLIGENCE OF THINGS', 3, 'core'),
(34, '01236265', 'ระบบความมั่นคงทางไซเบอร์ / CYBER SECURITY SYSTEMS', 3, 'core'),
(35, '01236266', 'ปฏิบัติการระบบไอโอทีและสารสนเทศ 1 / IoT LAB 1', 1, 'core'),
(36, '01236267', 'ปฏิบัติการระบบไอโอทีและสารสนเทศ 2 / IoT LAB 2', 1, 'core'),
(37, '01236268', 'สัมมนากับผู้เชี่ยวชาญ / SEMINAR WITH PROFESSIONALS', 1, 'core'),
(38, '01006004', 'การฝึกงานอุตสาหกรรม / INDUSTRIAL TRAINING', 0, 'core'),
(39, '01236330', 'การมองเห็นของเครื่องจักรและคอมพิวเตอร์ / MACHINE AND COMPUTER VISION', 3, 'core'),
(40, '01236331', 'ระบบปฏิบัติการระบบสมองกลฝังตัว / EMBEDDED OPERATING SYSTEM', 3, 'core'),
(41, '01236332', 'วิศวกรรมซอฟต์แวร์ / SOFTWARE ENGINEERING', 3, 'core'),
(42, '01236333', 'การเรียนรู้ของเครื่อง / MACHINE LEARNING', 3, 'core'),
(43, '01236334', 'การออกแบบและการปฏิบัติการเชื่อมโยงระบบโครงข่าย', 3, 'core'),
(44, '01236335', 'ระบบสื่อสารไร้สายสำหรับระบบไอโอที / WIRELESS COM. FOR IOT', 3, 'core'),
(45, '01236336', 'การวิเคราะห์ข้อมูล / DATA ANALYTICS', 3, 'core'),
(46, '01236337', 'การพัฒนาแอปพลิเคชันบนเว็บ / WEB APPLICATION DEVELOPMENT', 3, 'core'),
(47, '01236339', 'การประมวลผลคลาวด์และเอดจ์ / CLOUD AND EDGE COMPUTING', 3, 'core'),
(48, '01236340', 'ระบบฐานข้อมูล / DATABASE SYSTEM', 3, 'core'),
(49, '01236411', 'วิทยาการเข้ารหัสลับและเทคโนโลยีบล็อกเชน / CRYPTOGRAPHY AND BLOCKCHAIN', 3, 'core'),
(50, '01236406', 'โรงงานอัจฉริยะและอุตสาหกรรมอัตโนมัติ / SMART FACTORY', 3, 'core'),
(51, '01236407', 'การออกแบบอาคารและเมืองอัจฉริยะ / SMART CITY', 3, 'core'),
(52, '01236269', 'โครงงานวิศวกรรมระบบไอโอทีและสารสนเทศ 1 / CAPSTONE PROJECT 1', 3, 'core'),
(53, '01236270', 'โครงงานวิศวกรรมระบบไอโอทีและสารสนเทศ 2 / CAPSTONE PROJECT 2', 3, 'core'),
(54, '01236319', 'สหกิจศึกษา / COOPERATIVE EDUCATION', 6, 'core'),
(55, '01236320', 'การปฏิบัติการฝึกงานต่างประเทศ / OVERSEA TRAINING', 6, 'core');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission_projects`
--
ALTER TABLE `admission_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_rounds`
--
ALTER TABLE `admission_rounds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labs`
--
ALTER TABLE `labs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_members`
--
ALTER TABLE `lab_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lab_id` (`lab_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admission_projects`
--
ALTER TABLE `admission_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `admission_rounds`
--
ALTER TABLE `admission_rounds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `labs`
--
ALTER TABLE `labs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lab_members`
--
ALTER TABLE `lab_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lab_members`
--
ALTER TABLE `lab_members`
  ADD CONSTRAINT `lab_members_ibfk_1` FOREIGN KEY (`lab_id`) REFERENCES `labs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lab_members_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
