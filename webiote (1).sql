-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2026 at 07:31 AM
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
-- Database: `webiote`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic1`
--

CREATE TABLE `academic1` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `tuition` varchar(50) DEFAULT NULL,
  `bg_color` varchar(20) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `pdf_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic1`
--

INSERT INTO `academic1` (`id`, `title`, `content`, `tuition`, `bg_color`, `image_path`, `pdf_path`, `created_at`) VALUES
(9, 'ทำไมต้องไอโอที (IoT) ลาดกระบัง?', 'หลักสูตรวิศวกรรมระบบไอโอทีและสารสนเทศ มุ่งเน้นที่การศึกษาการเชื่อมองค์ประกอบของโลกดิจิทัลเข้าด้วยกัน ทั้งศึกษาที่เรียนในหลักสูตรนี้จะได้ศึกษาและปฏิบัติเกี่ยวกับด้านเทคโนโลยีระบบไอโอทีและสารสนเทศโดยอาศัยความรู้พื้นฐาน ทั้งด้านซอฟต์แวร์ ประกอบด้วย การเขียนโปรแกรมคอมพิวเตอร์ การพัฒนาซอฟต์แวร์และแอพพลิเคชัน ด้านฮาร์ดแวร์ได้แก่ การพัฒนาอุปกรณ์อิเล็กทรอนิกส์อัจฉริยะและสมาร์ทเซ็นเซอร์ รวมถึงเชื่อมโยงเข้าหากันด้วย การศึกษาด้านการสื่อสารและเครือข่ายไปจนถึงการประยุกต์ใช้เทคโนโลยีปัญญาประดิษฐ์และวิทยาการข้อมูล โดยผสมผสานความรู้ต่าง ๆ เหล่านี้เข้ากับกระบวนการทางวิศวกรรมศาสตร์ คณิตศาสตร์ เพื่อออกแบบสร้างนวัตกรรมใหม่ ๆ รวมถึงการใช้งานในอุตสาหกรรมที่ต้องการระบบไอโอทีและไอที ส่งเสริมให้นักศึกษาต่อยอดนวัตกรรมของตนเองเพื่อผลิตใช้หรือทำเป็นสตาร์ทอัปเพื่อสร้างธุรกิจของตนเองได้', '25000', '#f4b183', 'assets/1772549315_IOT.png', 'assets/1772549315_ข้อมูลเพิ่ม-หลักสูตรIoT.pdf', '2026-03-03 14:48:35');

-- --------------------------------------------------------

--
-- Table structure for table `academic2`
--

CREATE TABLE `academic2` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `tuition` varchar(100) DEFAULT NULL,
  `bg_color` varchar(20) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `pdf_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic2`
--

INSERT INTO `academic2` (`id`, `title`, `content`, `tuition`, `bg_color`, `image_path`, `pdf_path`, `created_at`) VALUES
(14, 'ทำไมต้อง IoTe+Physics?', 'การบูรณาการระหว่างเทคโนโลยีไอโอที (IoT) และฟิสิกส์ (Physics) มีความสำคัญอย่างยิ่งต่อการพัฒนาวิศวกรรมยุคดิจิทัล เนื่องจากระบบไอโอทีไม่ได้อาศัยเพียงซอฟต์แวร์หรือการเขียนโปรแกรมเท่านั้น แต่ต้องเชื่อมโยงกับโลกกายภาพจริงผ่านอุปกรณ์ เซ็นเซอร์ และระบบอิเล็กทรอนิกส์ ซึ่งล้วนตั้งอยู่บนพื้นฐานของหลักการทางฟิสิกส์\r\n\r\nหลักสูตรวิศวกรรมระบบไอโอทีและสารสนเทศจึงมุ่งเน้นการผสมผสานองค์ความรู้ด้านเทคโนโลยีดิจิทัลเข้ากับหลักการทางวิทยาศาสตร์ โดยนักศึกษาจะได้ศึกษาและปฏิบัติทั้งด้านซอฟต์แวร์ เช่น การเขียนโปรแกรม การพัฒนาระบบและแอปพลิเคชัน การประมวลผลข้อมูล และปัญญาประดิษฐ์ ควบคู่ไปกับด้านฮาร์ดแวร์ ซึ่งเกี่ยวข้องกับการออกแบบวงจรอิเล็กทรอนิกส์ การพัฒนาอุปกรณ์สมาร์ทเซ็นเซอร์ และระบบฝังตัว\r\n\r\nความรู้ทางฟิสิกส์มีบทบาทสำคัญในการทำความเข้าใจกลไกการทำงานของเซ็นเซอร์ การวัดปริมาณทางกายภาพ เช่น อุณหภูมิ ความดัน แรง แสง หรือคลื่นแม่เหล็กไฟฟ้า ตลอดจนหลักการด้านไฟฟ้าและแม่เหล็กที่เกี่ยวข้องกับการสื่อสารและพลังงาน หากขาดพื้นฐานฟิสิกส์ การออกแบบระบบไอโอทีที่มีความแม่นยำ เสถียร และปลอดภัยจะไม่สามารถทำได้อย่างมีประสิทธิภาพ\r\n\r\nนอกจากนี้ หลักสูตรยังส่งเสริมให้นักศึกษานำความรู้ทางฟิสิกส์ คณิตศาสตร์ และกระบวนการทางวิศวกรรมศาสตร์ มาประยุกต์ใช้ร่วมกับเทคโนโลยีไอโอทีและสารสนเทศ เพื่อออกแบบและสร้างนวัตกรรมที่สามารถแก้ไขปัญหาในภาคอุตสาหกรรม ภาคเกษตรกรรม เมืองอัจฉริยะ และระบบอัตโนมัติสมัยใหม่ได้อย่างเป็นรูปธรรม\r\n\r\nการเรียนรู้แบบบูรณาการระหว่าง IoT และ Physics จึงไม่เพียงแต่ทำให้นักศึกษามีความเข้าใจทั้งเชิงทฤษฎีและปฏิบัติ แต่ยังช่วยพัฒนาศักยภาพในการคิดวิเคราะห์ การออกแบบระบบครบวงจร (End-to-End System Design) และการต่อยอดสู่การพัฒนาผลิตภัณฑ์ นวัตกรรม หรือธุรกิจสตาร์ทอัปในอนาคตได้อย่างมั่นคงและยั่งยืน', '40000', '#f4b183', 'assets/1772549077_PhysicsIoT.jpg', 'assets/1772549077_ข้อมูลเพิ่ม-หลักสูตรPhysicsIoT.pdf', '2026-03-03 14:44:37');

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
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `caption` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image_path`, `caption`) VALUES
(1, 'assets/pic1.jpg', 'กิจกรรม 1'),
(2, 'assets/pic2.jpg', 'กิจกรรม 2'),
(3, 'assets/pic3.jpg', 'กิจกรรม 3'),
(4, 'assets/pic4.jpg', 'กิจกรรม 4'),
(5, 'assets/pic5.jpg', 'กิจกรรม 5'),
(6, 'assets/pic6.jpg', 'กิจกรรม 6'),
(7, 'assets/pic7.jpg', 'กิจกรรม 7'),
(8, 'assets/pic8.jpg', 'กิจกรรม 8'),
(9, 'assets/pic9.jpg', 'กิจกรรม 9');

-- --------------------------------------------------------

--
-- Table structure for table `home_detail`
--

CREATE TABLE `home_detail` (
  `id` int(11) NOT NULL,
  `section` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `home_detail`
--

INSERT INTO `home_detail` (`id`, `section`, `content`, `updated_at`) VALUES
(1, 'main_content', 'ยินดีต้อนรับสู่ภาควิชา IoT and Information Engineering (KMITL)! เพราะวิศวกรรมยุคใหม่ไม่ได้จบแค่การเขียนโค้ดหรือต่อวงจรไฟฟ้า \'IoT และวิศวกรรมสารสนเทศ\' จึงเป็นศาสตร์แห่งอนาคตที่ผสานฮาร์ดแวร์ ซอฟต์แวร์ และโครงข่ายข้อมูลเข้าด้วยกัน เพื่อสร้างสมองและระบบประสาทให้กับทุกสรรพสิ่ง ตั้งแต่สมาร์ทโฮมไปจนถึงเมืองอัจฉริยะ (Smart City) ที่นี่เราจะปั้นให้คุณเป็นวิศวกรผู้เชี่ยวชาญด้านการดึงข้อมูลมหาศาลมาวิเคราะห์และสั่งการ พลิกแพลงไอเดียให้กลายเป็นนวัตกรรมที่จับต้องได้ เพื่อเชื่อมต่อโลกแห่งความจริงและโลกดิจิทัลเข้าด้วยกันอย่างสมบูรณ์แบบ!', '2026-03-03 15:16:18'),
(2, 'success_story', 'ความลับของความสำเร็จคือการลงมือทำ...', '2026-02-24 15:12:32'),
(3, 'main_content', 'ยินดีต้อนรับสู่ภาควิชา IoT... (มึงสามารถแก้ข้อความนี้ได้จากหน้า Admin)', '2026-02-24 15:38:29'),
(4, 'success_story', 'ความลับของความสำเร็จคือการลงมือทำ...', '2026-02-24 15:38:29');

-- --------------------------------------------------------

--
-- Table structure for table `internships`
--

CREATE TABLE `internships` (
  `id` int(11) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `date_range` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `internships`
--

INSERT INTO `internships` (`id`, `company`, `position`, `date_range`, `image`, `details`) VALUES
(17, 'บริษัท CyberSecure Thailand จำกัด', 'Cybersecurity Analyst Intern', 'พฤษภาคม 2024 - กรกฎาคม 2024', '1771746399_Intern1.jpg', 'วิเคราะห์ log จาก firewall และ SIEM, ตรวจจับพฤติกรรมผิดปกติ (Anomaly Detection), ทดสอบเจาะระบบ (Pentest) ภายในองค์กร, เขียนรายงานสรุปช่องโหว่, พัฒนา script อัตโนมัติด้วย Python'),
(18, 'บริษัท DataWave Analytics', 'AI Developer Intern', 'ธันวาคม 2024 - กุมภาพันธ์ 2025', '1771746430_Intern2.jpg', 'พัฒนาโมเดล Machine Learning สำหรับตรวจจับบัญชีม้า, เตรียม dataset และทำ feature engineering, เทรนโมเดลด้วย TensorFlow, วิเคราะห์ผลด้วย Confusion Matrix, Deploy โมเดลขึ้น server'),
(21, 'บริษัท SmartTech Solutions จำกัด', 'IoT System Developer Intern', 'มิถุนายน 2025 – สิงหาคม 2025', '1771870894_1771736454_163F5BC9-75A1-4625-AFE1-425F517602FA.jpg', 'พัฒนา dashboard แสดงผล sensor แบบ real-time เขียน API เชื่อมต่อฐานข้อมูล MQL\r\nออกแบบระบบแจ้งเตือนผ่าน Line Notify\r\nวิเคราะห์ข้อมูลด้วย Python\r\nทดสอบระบบและเขียนเอกสารคู่มือการใช้งาน'),
(26, NULL, NULL, NULL, '', NULL),
(27, NULL, NULL, NULL, '', NULL);

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
(1, 'Cybersecurity Laboratory', 'IT and IoT Cyber Security Laboratory is a dedicated environment where students, professionals, and researchers can practice and enhance their skills in defending against and analyzing cyber threats. \nThese labs are equipped with tools and technologies that simulate real-world cyber attacks and defense strategies, allowing users to test their knowledge in a controlled, safe setting.\n\nCyber security labs typically focus on two main areas:\n– Defensive Security: This includes activities like setting up firewalls, intrusion detection systems, encryption methods, and network security configurations to protect against attacks.\n– Offensive Security**: In this area, participants engage in ethical hacking and penetration testing to identify and exploit vulnerabilities in systems, websites, or networks, helping to build a deeper understanding of how attackers operate.\n\nA cyber security lab is essential for mastering both offensive and defensive techniques in the constantly evolving landscape of digital threats, making it a vital resource for cybersecurity education and skill development.\nThe IT and IoT Cyber Security Laboratory consists of research in three main areas.\n     \n1. Network Infrastructure, IoT and Wireless Security\n2. Cyber Security with AI Data analytics\n3. Penetration Testing and Cyber Attack', 'lab_logo_1771599591.png'),
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
(12, 1, 1, 'ผศ.ดร.อรรถพล ป้อมสถิตย์', 'หัวหน้า', '69987f7a06c26.webp', 0),
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
  `popup_role` varchar(255) DEFAULT NULL,
  `research` text DEFAULT NULL,
  `research_link` varchar(255) DEFAULT NULL,
  `research_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`id`, `type`, `name`, `role`, `history`, `image`, `program`, `popup_role`, `research`, `research_link`, `research_image`) VALUES
(1, 'faculty', 'รศ.ดร.บุณย์ชนะ ภู่ระหงษ์', 'ประธานหลักสูตรวิศวกรรมระบบไอโอทีและสารสนเทศ', 'e-mail : boonchana.pu@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– อส.บ. (เทคโนโลยีอิเล็กทรอนิกส์) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– วศ.ม. (วิศวกรรมสารสนเทศ) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– Microprocessor Application\r\n– Microcontroller\r\n– Robotic\r\n– Internet of Things and Smart System', 'assets/faculty/aj-Boonchana.png', 'iot', 'ตำแหน่ง : ผู้ประสานงานสาขาวิชาวิศวกรรมสารสนเทศ', 'Comparison of logistic regression and artificial neural network model for apron allocation assignment', 'https://www.researchgate.net/publication/371016333_Comparison_of_logistic_regression_and_artificial_neural_network_model_for_apron_allocation_assignment', 'assets/faculty/research_69a1a35a36396.png'),
(2, 'faculty', 'ผศ.ดร.พิกุลแก้ว ตังติสานนท์', 'หัวหน้าภาควิชา', 'e-mail : pikulkaew.ta@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– วศ.บ. (วิศวกรรมสารสนเทศ) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– วศ.ม. (วิศวกรรมสารสนเทศ) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– D.Eng. (Science and Technology) Tokai University, JAPAN\r\n\r\nความเชี่ยวชาญ\r\n– Web Application\r\n– Mobile Application\r\n– Information Security', 'assets/faculty/aj-Pikulkaew.png', 'iot', 'อาจารย์ประจำหลักสูตร', 'แอพพลิเคชั่นแนะนำวิศวกรรมศาสตร์บนสมาร์ทโฟนแบบปฏิสัมพันธ์', 'https://www.researchgate.net/profile/Pikulkaew-Tangtisanon', 'assets/faculty/research_69a1a4ae43dc2.png'),
(3, 'faculty', 'ศ.ดร.อภิรัฐ ศิริธราธิวัตร', 'รองหัวหน้าภาควิชา (ฝ่ายวิจัยและนวัตกรรม)', 'null', 'assets/faculty/aj-Apirat.png', 'iot', '', NULL, NULL, NULL),
(4, 'faculty', 'ผศ.ดร.วันวิสา ชัชวงษ์', 'รองหัวหน้าภาควิชา (ฝ่ายการเงิน)', 'e-mail : vanvisa.ch@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– อส.บ. เกียรตินิยมอันดับ 2 (เทคโนโลยีอิเล็กทรอนิกส์) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– วศ.ม. (วิศวกรรมสารสนเทศ) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– วศ.ด. (วิศวกรรมไฟฟ้า) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– Electronic\r\n– Bernstein Filter\r\n– Railway Signaling and Operation\r\n– Pattern recognition\r\n– Railway Communications', 'assets/faculty/aj-Vanvisa.png', 'iot', 'ตำแหน่ง : อาจารย์ประจำหลักสูตร', NULL, NULL, NULL),
(5, 'faculty', 'ผศ.ดร.ธนวิชญ์ อนุวงค์พินิจ', 'รองหัวหน้าภาควิชา (ฝ่ายวิชาการ)', 'e-mail : thanavit.an@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– B.Eng.(Information Engineering) King Mongkuts Institute of Technology Ladkrabang\r\n– M.Eng.(Information Engineering) King Mongkuts Institute of Technology Ladkrabang\r\n– D.Eng.(Electrical Engineering) King Mongkuts Institute of Technology Ladkrabang\r\n\r\nความเชี่ยวชาญ\r\n– Microprocessor Application\r\n– Internet of Things\r\n– Embedded Systems\r\n– Integrated System\r\n– Railway Signaling, Communication and Operation', 'assets/faculty/aj-Thanavit.png', 'iot', 'ตำแหน่ง : อาจารย์ประจำหลักสูตร', 'Medical drone managing system for automated external defibrillator delivery service', 'https://scholar.google.com/citations?user=O1ycSnQAAAAJ&hl=en', 'assets/faculty/research_69a19a8655259.png'),
(6, 'faculty', 'ผศ.ดร.นัชนัยน์ รุ่งเหมือนฟ้า', 'รองหัวหน้าภาควิชา (ฝ่ายต่างประเทศและกิจกรรมคณะ)', 'e-mail : natchanai.ro@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– B.Eng.(Electronics Engineering) King Mongkuts Institute of Technology Ladkrabang\r\n– M.Eng.(Control Engineering) King Mongkuts Institute of Technology Ladkrabang\r\n– D.Eng.(Electrical Engineering) King Mongkuts Institute of Technology Ladkrabang\r\n\r\nความเชี่ยวชาญ\r\n– immittance function simulators\r\n– active analog filters\r\n– oscillator design\r\n– chaotic circuit realization', 'assets/faculty/aj-Natchanai.png', 'iot', 'ตำแหน่ง : อาจารย์ประจำหลักสูตร', NULL, NULL, NULL),
(7, 'faculty', 'ผศ.ดร.เกล็ดดาว สัตย์เจริญ', 'อาจารย์ประจำภาควิชา (ผู้ช่วยฝ่ายต่างประเทศและกิจกรรมคณะ)', 'e-mail : kleddao.sa@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– Doctoral of Philosophy in Computer Science, University of Buckingham, UK\r\n– Master of Science in Computing (MERIT), University of Buckingham, UK\r\n– Master of Art (Political Science), THAILAND\r\n– Bachelor of Science in Management Technology, KMITL, THAILAND\r\n\r\nความเชี่ยวชาญ\r\n– Human computer interaction\r\n– User Interfaces', 'assets/faculty/aj-Kleddao.png', 'iot', 'ตำแหน่ง : อาจารย์ประจําหลักสูตร', NULL, NULL, NULL),
(8, 'faculty', 'ผศ.นิจจารีย์ สัตยารักษ์', 'รองหัวหน้าภาควิชา (ฝ่ายกิจการนักศึกษา)', 'e-mail : nitjaree.sa@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– วศ.บ. (วิศวกรรมคอมพิวเตอร์) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– วศ.ม. (วิศวกรรมไฟฟ้า) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– Software Engineering\r\n– Distributed Testing System', 'assets/faculty/aj-Nitjaree.png', 'iot', 'ตำแหน่ง : อาจารย์ประจำหลักสูตร', NULL, NULL, NULL),
(9, 'faculty', 'ผศ.สรพงษ์ วชิรรัตนพรกุล', 'อาจารย์ประจำภาควิชา (ผู้ช่วยฝ่ายกิจการนักศึกษา)', 'e-mail : sorapong.wa@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– อส.บ.(เทคโนโลยีอิเล็กทรอนิกส์) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– วศ.ม. (วิศวกรรมไฟฟ้า) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– Analog and Digital Filter\r\n– Embedded System\r\n– RFID and Application\r\n– Pattern recognition\r\n– Information for Energy', 'assets/faculty/aj-Sorapong.png', 'iot', 'ตำแหน่ง : อาจารย์ผู้รับผิดชอบหลักสูตร', NULL, NULL, NULL),
(10, 'faculty', 'ดร.สุวิไล พุ่มโพธิ์', 'รองหัวหน้าภาควิชา (ฝ่ายกิจการภายนอก)', 'null', 'assets/faculty/aj-Suwilai.png', 'iot', '', NULL, NULL, NULL),
(11, 'faculty', 'ผศ.ดร.อรรถพล ป้อมสถิตย์', 'อาจารย์ประจำภาควิชา (ผู้ช่วยฝ่ายกิจการภายนอก)', 'e-mail : auttapon.po@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– B.Eng.(Electronics Engineering) King Mongkuts Institute of Technology Ladkrabang\r\n– M.Eng.(Information Engineering) King Mongkuts Institute of Technology Ladkrabang\r\n– D.Eng.(Electrical Engineering) King Mongkuts Institute of Technology Ladkrabang\r\n\r\nความเชี่ยวชาญ\r\n– Cyber Security\r\n– Internetworkind Design\r\n– Information Security', 'assets/faculty/aj-Auttapon.png', 'iot', 'ตำแหน่ง : อาจารย์ประจําหลักสูตร', NULL, NULL, NULL),
(12, 'faculty', 'ผศ.ดร.พนารัตน์ เชิญถนอมวงศ์', 'อาจารย์ประจำภาควิชา (ผู้ช่วยฝ่ายกิจการภายนอก)', 'null', 'assets/faculty/aj-Panarat.png', 'iot', '', NULL, NULL, NULL),
(13, 'faculty', 'ผศ.ไพศาล สิทธิโยภาสกุล', 'อาจารย์พิเศษ', 'e-mail : paisan-si@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– อส.บ. (เทคโนโลยีคอมพิวเตอร์อุตสาหกรรม) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– วศ.ม. (วิศวกรรมไฟฟ้า) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– Wireless Communication\r\n– Microprocessor Applications\r\n– Digital Filter', 'assets/faculty/aj-Paisan.png', 'iot', 'ตำแหน่ง : อาจารย์ประจําหลักสูตร', NULL, NULL, NULL),
(14, 'faculty', 'รศ.ดร.อรรถสิทธิ์ หล่าสกุล', 'อาจารย์พิเศษ', 'e-mail : attasit.la@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– อส.บ. (เทคโนโลยีอิเล็กทรอนิกส์) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– วศ.ม. (วิศวกรรมไฟฟ้า) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– D.Eng. (Electrical Engineering) Tokai University, JAPAN\r\n\r\nความเชี่ยวชาญ\r\n– Digital Processing\r\n– Image Watermarking\r\n– Embedded Systems\r\n– Image Processing\r\n– Machine Vision', 'assets/faculty/aj-Attasit.png', 'iot', 'ตำแหน่ง : อาจารย์ประจําหลักสูตร', NULL, NULL, NULL),
(15, 'faculty', 'ศ.ดร.ปิติเขต สู้รักษา', 'อาจารย์', 'e-mail : pitikhate.so@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– กศ.บ. เกียรตินิยม (ฟิสิกส์) มหาวิทยาลัยศรีนครินทรวิโรฒ ปทุมวัน\r\n– วท.ม. (ฟิสิกส์) มหาวิทยาลัยศรีนครินทรวิโรฒ ประสานมิตร\r\n– M.S. (Electrical Engineering) George Washington University, USA\r\n– Ph.D. (Electrical Engineering) University of Houston, USA\r\n\r\nความเชี่ยวชาญ\r\n– IT Automation\r\n– Industrial Informatics', 'assets/faculty/aj-Pitikhate.png', 'iot', 'ตำแหน่ง : อาจารย์ประจําหลักสูตร', NULL, NULL, NULL),
(16, 'staff', 'นายธนาตย์ จอมใจเอกชน', 'เจ้าหน้าที่วิศวกร', 'null', 'assets/faculty/staff-thanat.png', 'iot', '', NULL, NULL, NULL),
(17, 'staff', 'นายธีรสิทธิ์ โท้ทอง', 'เจ้าหน้าที่วิศวกร', 'null', 'assets/faculty/staff-teerasit.png', 'iot', '', NULL, NULL, NULL),
(35, 'faculty', 'รศ.ดร.ภัทรียา ดำรงศักดิ์', 'หัวหน้าภาควิชาฟิสิกส์ ฟิสิกส์อุตสาหกรรม', 'e-mail : pattareeya.da@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– Doctor of Philosophy/Engineering Materials University of Southampton อังกฤษ\r\n\r\nความเชี่ยวชาญ\r\n– OPTICAL SPECTROSCOPY\r\n– SILICON PHOTOVOLTAICS\r\n– FLUORESCENT CONCENTRATORS\r\n– THIN FILM LUMINESCENCE\r\n– FLUORESCENCE SPECTROSCOPY', 'assets/faculty/aj-Pattareeya.png', 'science', 'ตำแหน่ง : หัวหน้าภาควิชาฟิสิกส์', 'Optical performance of fluorescent collectors integrated with microlens arrays', 'https://www.scopus.com/pages/publications/85030725719', 'assets/faculty/research_69a19d315962f.png'),
(36, 'faculty', 'รศ.ดร.สาหร่าย เล็กชะอุ่ม', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : sarai.le@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– ปริญญาโท/วศ.ม.(นิวเคลียร์เทคโนโลยี) จุฬาลงกรณ์มหาวิทยาลัย\r\n\r\nความเชี่ยวชาญ\r\n– STIRLING ENGINE\r\n– TISSUE\r\n– SIMULATION\r\n– MEASURING METHOD\r\n– INTERNET OF THING TECHNOLOGY', 'assets/faculty/aj-Sarai.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(37, 'faculty', 'รศ.ดร.รัชนก สมพรเสน่ห์', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : ratchanok.so@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– Doctor of Philosophy/Physics, University at Buffalo,\r\nThe State University of NY\r\n\r\nความเชี่ยวชาญ\r\n– NANOELECTRONICS\r\n– 2D MATERIALS\r\n– GRAPHENE\r\n– QUANTUM TRANSPORT PHENOMENA\r\n– ELECTRICAL CHARACTERIZATION', 'assets/faculty/aj-Ratchanok.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(38, 'faculty', 'ผศ.ดร.ศ.ทิพวรรณ คล้ายบุญมี', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : s.tipawan.kh@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– วท.บ. ฟิสิกส์ประยุกต์, สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– วท.ม. ฟิสิกส์ประยุกต์, สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n– ปร.ด. ฟิสิกส์ประยุกต์, สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง', 'assets/faculty/aj-Tipawan.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(39, 'faculty', 'รศ.ดร.อาภาภรณ์ สกุลการะเวก', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : aparporn.sa@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– วิทยาศาสตรดุษฎีบัณฑิต/ฟิสิกส์ จุฬาลงกรณ์มหาวิทยาลัย\r\n\r\nความเชี่ยวชาญ\r\n– THIN FILM\r\n– THERMOELECTRIC MATERIAL\r\n– THERMAL PROPERTY\r\n– MATERIAL SCIENCE\r\n– MATERIAL CHARACTERIZATION', 'assets/faculty/aj-aparporn.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(40, 'faculty', 'ดร.พิชชานันท์ ธีเศรษฐ์โศภน', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : pichanan.te@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– วท.บ. ฟิสิกส์, มหาวิทยาลัยเกษตรศาสตร์\r\n– วท.ม. ฟิสิกส์เชิงเคมี, มหาวิทยาลัยมหิดล\r\n– Ph.D. Energy, สถาบันเทคโนโลยีแห่งเอเซีย', 'assets/faculty/aj-pichanan.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(41, 'faculty', 'ผศ.ดร.เมตยา กิติวรรณ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : mettaya.ki@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– Ph.D.(Materials Processing), Tohoku University, Japan\r\n\r\nความเชี่ยวชาญ\r\n– NANO-COATING BY ROTARY CHEMICAL VAPOR DEPOSITION\r\n– SINTERING OF ADVANCED CERAMICS\r\n– MICROWAVE PROCESSING OF MATERIALS\r\n– HYDROGEN SEPARATION MEMBRANE', 'assets/faculty/aj-mettaya.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(42, 'faculty', 'ผศ.ธนภรณ์ ลีลาวัฒนานนท์ ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : tanaporn.le@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– วท.ม./เทคโนโลยีสารสนเทศ สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– MODELING AND SIMULATION\r\n– SURFACE PLASMONS\r\n– OPTICAL DATA COMMUNICATION', 'assets/faculty/aj-tanaporn.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(43, 'faculty', 'ผศ.สุรศักดิ์ พิพัฒน์ศาสตร์ ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail :\r\n\r\nประวัติการศึกษา\r\n– วท.ม.(ฟิสิกส์ประยุกต์) สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– OPTICS\r\n– ENERGY', 'assets/faculty/aj-Surasak.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(44, 'faculty', 'ผศ.ดร.ประธาน บุรณศิริ ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : prathan.bu@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– Doctor of Philosophy/Electrical Engineering ,University of Dayton, USA\r\n\r\nความเชี่ยวชาญ\r\n– QUANTITATIVE PHASE IMAGING\r\n– DIGITAL HOLOGRAPHY\r\n– NONLINEAR OPTIC\r\n– LASER STABILIZEATION\r\n– PHOTONIC CRYSTAL\r\n– METAMATERIAL\r\n– METAMATERIAL-MEDICAL PHYSICS\r\n– APPLICATIONS OF SYNCHROTRON RADIATION', 'assets/faculty/aj-prathan.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(45, 'faculty', 'อ.ธรรมรัตน์ แต่งตั้ง ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : thammarat.ta@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– วศ.ม.วิศวกรรมไฟฟ้า สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– IMAGE PROCESSING\r\n– DATA PROCESSING\r\n– NP-HARD PROBLEM\r\n– ARTIFICIAL INTELLIGENCE\r\n– OPTIMIZATION PROBLEM', 'assets/faculty/aj-thammarat.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(46, 'faculty', 'อ.สุรชาติ กมลดิลก ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : kamoldiloks@gmail.com\r\n\r\nประวัติการศึกษา\r\n– ปริญญาโท/วท.ม.(สาขาฟิสิกส์ประยุกต์)\r\nสถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– LASERS\r\n– OPTICAL INSTRUMENTS\r\n– PHOTONICS\r\n– FORENSIC SCIENCE\r\n– PHYSICS EDUCATION', 'assets/faculty/aj-kamoldiloks.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(47, 'faculty', 'ผศ.ดร.ณัฐพร พรหมรส ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : kpnathap@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– Doctor of Engineering/Applied Science fro Electronics and Materials,\r\nKyushu University. ญี่ปุ่น\r\n\r\nความเชี่ยวชาญ\r\n– THIN FILM\r\n– THERMOELECTRIC MATERIAL\r\n– THERMAL PROPERTY\r\n– MATERIAL SCIENCE\r\n– MATERIAL CHARACTERIZATION', 'assets/faculty/aj-kpnathap.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(48, 'faculty', 'ศ.ดร.เชรษฐา รัตนพันธ์ ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : chesta.ru@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– ปรัชญาดุษฎีบัณฑิต/ฟิสิกส์ประยุกต์ สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– SYNTHESIS\r\n– CHARACTERIZATION\r\n– IMPROVEMENT OF THERMOELECTRIC MATERIALS', 'assets/faculty/aj-chesta.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(49, 'faculty', 'รศ.ดร.กฤษกร โล้เจริญรัตน์ ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : kitsakorn.lo@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– Ph.D./ Physical Materials Science , Japan Advanced Institute of Science\r\nand Technology, 2550, Japan\r\n\r\nความเชี่ยวชาญ\r\n– CANCER\r\n– PLASMONIC\r\n– NANOPARTICLES', 'assets/faculty/aj-kitsakorn.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(50, 'faculty', 'ผศ.ดร.ภาณุพล โขลนกระโทก ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : bhanupol.kl@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– วิศวกรรมศาสตรดุษฎีบัณฑิต/วิศวกรรมไฟฟ้า\r\nสถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง\r\n\r\nความเชี่ยวชาญ\r\n– MEASUREMENT AND INSTRUMENTATIONS\r\n– FORENSIC SCIENCE\r\n– IMAGE PROCESSING\r\n– SPORT SCIENCE\r\n– COMPUTER AND ELECTRONICS IN AGRICULTURE', 'assets/faculty/aj-bhanupol.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(51, 'faculty', 'ผศ.ดร.พิศาล ศรีราช ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : pisan.su@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– ปรัชญาดุษฎีบัณฑิต/ฟิสิกส์ มหาวิทยาลัยสงขลานครินทร์\r\n\r\nความเชี่ยวชาญ\r\n– PIEZOELECTRIC MATERIAL\r\n– MATERIALS SCIENCE\r\n– ENERGY HARVESTING SENSOR\r\n– MATERIAL CHARACTERIZATION', 'assets/faculty/aj-pisan.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(52, 'faculty', 'ดร.ชินพรรธน์ รัตนศิรวิทย์ ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : woraka.ne@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– Ph.D. Physics North Carolina State University, USA\r\n\r\nความเชี่ยวชาญ\r\n– SURFACE PLASMONIC RESONANCE\r\n– NANOTECHNOLOGY\r\n– OPTICAL SENSOR\r\n– SMART FARMING\r\n– STEM EDUCATION', 'assets/faculty/aj-woraka.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(53, 'faculty', 'ผศ.ดร.กีรยุทธ์ ศรีนวลจันทร์ ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : keerayoot.sr@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– วท.ม.(ฟิสิกส์ประยุกต์)/ฟิสิกส์ประยุกต์\r\nสถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง', 'assets/faculty/aj-keerayoot.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(54, 'faculty', 'ดร.วิฑูรย์ ยินดีสุข ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : witoon.yi@kmitl.ac.th\r\n\r\nประวัติการศึกษา\r\n– Doctor of Philosophy/Engineering Science,\r\nThe University of Electro-Communications, Japan\r\n\r\nความเชี่ยวชาญ\r\n– SOLAR CELLS\r\n– QUANTUM DOTS\r\n– SOLAR ENERGY\r\n– THIN FILMS\r\n– SILAR METHODS', 'assets/faculty/aj-witoon.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(55, 'faculty', 'ผศ.ดร.ณัฏกฤษ สมดอก ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : nuttakrit.so@kmitl.ac.th', 'assets/faculty/aj-nuttakrit.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(56, 'faculty', 'ผศ.ดร.ลัญจกร ตันนุกิจ ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : Lunchakurn.ta@kmitl.ac.th', 'assets/faculty/aj-Lunchakurn.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(57, 'faculty', 'ดร.เฉลิมพล รุจรดาวงศ์ ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : chalermpol.ru@kmitl.ac.th', 'assets/faculty/aj-chalermpol.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(58, 'faculty', 'ดร.ยงยุทธ แก้วจำรัส ', 'อาจารย์ผู้รับผิดชอบหลักสูตร', 'e-mail : yongyut.ka@kmitl.ac.th', 'assets/faculty/aj-yongyut.png', 'science', 'ตำแหน่ง : อาจารย์ประจำภาควิชา', NULL, NULL, NULL),
(59, 'staff', 'นางสาวสายสุดาวัลย์ สุทธิญาณ ', 'นักวิทยาศาสตร์', 'e-mail : saisudawan1@hotmail.com', 'assets/faculty/staff-saisudawan.png', 'science', 'ตำแหน่ง : นักวิทยาศาสตร์', NULL, NULL, NULL),
(60, 'staff', 'นางพิมพร อ่อนละออ ', 'นักวิทยาศาสตร์', 'e-mail : pimporn.be@kmitl.ac.th', 'assets/faculty/staff-pimporn.png', 'science', 'ตำแหน่ง : นักวิทยาศาสตร์', NULL, NULL, NULL),
(61, 'staff', 'น.ส.นลิตา สว่างจิตต์ ', 'นักวิทยาศาสตร์', 'e-mail : nalita.sa@kmitl.ac.th', 'assets/faculty/staff-nalita.png', 'science', 'ตำแหน่ง : นักวิทยาศาสตร์', NULL, NULL, NULL),
(62, 'staff', 'นางสาวเกศณี เกตุนวม ', 'เจ้าหน้าที่บริหารงานทั่วไป', 'e-mail : kesanee.ke@kmitl.ac.th', 'assets/faculty/staff-kesanee.png', 'science', 'ตำแหน่ง : เจ้าหน้าบริหารงานทั่วไป เลขานุการ', NULL, NULL, NULL),
(63, 'staff', 'นายวีระพันธ์ ทิพาพงศ์ ', 'นักวิทยาศาสตร์', 'e-mail : weraphan.ti@kmitl.ac.th', 'assets/faculty/staff-weraphan.png', 'science', 'ตำแหน่ง : นักวิทยาศาสตร์', NULL, NULL, NULL),
(64, 'staff', 'นายชวนนท์ มะโน ', 'นักวิทยาศาสตร์', 'e-mail : chawanon.ma@kmitl.ac.th', 'assets/faculty/staff-chawanon.png', 'science', 'ตำแหน่ง : นักวิทยาศาสตร์', NULL, NULL, NULL),
(65, 'staff', 'นายสาโรจน์ ชูอำไพ ', 'ผู้ปฏิบัติงานวิทยาศาสตร์', 'e-mail : saroj.ch@kmitl.ac.th', 'assets/faculty/staff-saroj.png', 'science', 'ตำแหน่ง : ผู้ปฏิบัติงานวิทยาศาสตร์', '', '', ''),
(70, '', '', '', '', 'assets/faculty/default.png', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `image_file` varchar(255) NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `image_file`, `pdf_file`, `created_at`) VALUES
(6, 'จ๊อบ', '1772090900_5.png', '1772090900_ID Buddy Homie.pdf', '2026-02-26 07:28:20'),
(7, 'เจเจV.2', '1772093033_6.jpg', '1772093033_ID Buddy Homie.pdf', '2026-02-26 08:03:53'),
(8, 'เจเจ', '1772095012_133719916857293172.jpg', '1772095012_67010633 Homework9.pdf', '2026-02-26 08:36:52');

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
(2, 5, 'testtttt', '2026-02-22 08:44:54'),
(8, 35, '123', '2026-02-27 14:45:38'),
(9, 35, '1234', '2026-02-27 14:45:45'),
(10, 1, '1234\r\n', '2026-02-27 14:45:55'),
(11, 35, 'สวัสดีครับอาจารย์', '2026-02-27 14:47:43');

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
(55, '01236320', 'การปฏิบัติการฝึกงานต่างประเทศ / OVERSEA TRAINING', 6, 'core'),
(62, 'test', 'JJ hack', 3, 'free');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '1234', 'admin'),
(2, 'jaonai', '67010924', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic1`
--
ALTER TABLE `academic1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `academic2`
--
ALTER TABLE `academic2`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_detail`
--
ALTER TABLE `home_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internships`
--
ALTER TABLE `internships`
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
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personnel_id` (`personnel_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic1`
--
ALTER TABLE `academic1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `academic2`
--
ALTER TABLE `academic2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `admission_projects`
--
ALTER TABLE `admission_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `admission_rounds`
--
ALTER TABLE `admission_rounds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `home_detail`
--
ALTER TABLE `home_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `internships`
--
ALTER TABLE `internships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `labs`
--
ALTER TABLE `labs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lab_members`
--
ALTER TABLE `lab_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lab_members`
--
ALTER TABLE `lab_members`
  ADD CONSTRAINT `lab_members_ibfk_1` FOREIGN KEY (`lab_id`) REFERENCES `labs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lab_members_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`personnel_id`) REFERENCES `personnel` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
