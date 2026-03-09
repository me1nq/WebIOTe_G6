<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<div class="mobile-topbar">
    <button class="hamburger-btn" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>
    <h2>IoT Admin</h2>
</div>

<div class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <h2>Admin Panel</h2>
        <div class="close-btn" onclick="toggleSidebar()"><i class="fas fa-times"></i></div>
    </div>
    
    <ul class="sidebar-menu">
        <li class="<?= ($current_page == 'admin_index.php') ? 'active' : '' ?>">
            <a href="admin_index.php"><i class="fas fa-home"></i> หน้าหลัก & แกลลอรี</a>
        </li>
        <li class="<?= ($current_page == 'admin_internship.php') ? 'active' : '' ?>">
            <a href="admin_internship.php"><i class="fas fa-briefcase"></i> จัดการ Internship</a>
        </li>
        <li class="<?= ($current_page == 'admin_projects.php' || $current_page == 'admin_projects_edit.php') ? 'active' : '' ?>">
            <a href="admin_projects.php"><i class="fas fa-book-open"></i> จัดการคลังความรู้</a>
        </li>
        <li class="<?= ($current_page == 'admin_academic1.php' || $current_page == 'admin_academic2.php') ? 'active' : '' ?>">
            <a href="admin_academic1.php"><i class="fas fa-book"></i> จัดการหลักสูตร</a>
        </li>
        <li class="<?= ($current_page == 'admin_admission.php') ? 'active' : '' ?>">
            <a href="admin_admission.php"><i class="fas fa-user-graduate"></i> จัดการรับสมัคร</a>
        </li>
        <li class="<?= ($current_page == 'admin_faculty.php' || $current_page == 'admin_faculty_edit.php' || $current_page == 'admin_faculty_reviews.php') ? 'active' : '' ?>">
            <a href="admin_faculty.php"><i class="fas fa-chalkboard-teacher"></i> จัดการบุคลากร</a>
        </li>
        <li class="<?= ($current_page == 'admin_lab.php') ? 'active' : '' ?>">
            <a href="admin_lab.php"><i class="fas fa-flask"></i> จัดการห้อง Lab</a>
        </li>
        <li class="<?= ($current_page == 'admin_calculate.php') ? 'active' : '' ?>">
            <a href="admin_calculate.php"><i class="fas fa-calculator"></i> จัดการรายวิชา</a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <a href="../index.php" class="btn-return"><i class="fas fa-globe"></i> ดูหน้าเว็บหลัก</a>
        <a href="../logout.php" class="btn-logout"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
    </div>
</div>

<script>
function toggleSidebar() {
    document.getElementById('adminSidebar').classList.toggle('show');
}
</script>