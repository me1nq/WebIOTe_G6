<nav class="navbar">
    <div class="logo">
        <img src="assets/IoTe_logo.png" alt="Logo">
        <div class="logo-text">
            <strong>IoT and Information Engineering</strong><br>
            <span>King Mongkut's Institute of Technology Ladkrabang</span>
        </div>
    </div>

    <ul class="nav-desktop">
        <li><a href="index.php">Home</a></li>
        <li><a href="about_iot.php">About IoTe</a></li>
        
        <li class="desktop-dropdown">
            <a href="#">Academics ▾</a>
            <ul class="desktop-submenu">
                <li><a href="academic1.php">IoTe</a></li>
                <li><a href="academic2.php">Physics & IoTe</a></li>
            </ul>
        </li>

        <li class="desktop-dropdown">
            <a href="#">Faculty ▾</a>
            <ul class="desktop-submenu">
                <li><a href="#">Professor of IoTe</a></li>
                <li><a href="#">Professor of Physics & IoTe</a></li>
            </ul>
        </li>

        <li class="desktop-dropdown">
            <a href="#">Performance ▾</a>
            <ul class="desktop-submenu">
                <li><a href="#">Cybersecurity Laboratory</a></li>
            </ul>
        </li>

        <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <li><a href="admin/edit_index.php" style="color:#ff6600;">Edit</a></li>
        <?php endif; ?>
        <li>
            <?php if(isset($_SESSION['username'])): ?>
                <div class="user-dropdown">
                    <button class="user-display btn-signin" id="userMenuButton">
                        <?php echo $_SESSION['username']; ?> ▾
                    </button>
                    <div class="user-dropdown-content" id="userMenuDropdown">
                        <a href="profile.php">Profile</a>
                        <a href="logout.php" class="logout-link">Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="login.php" class="btn-signin">Sign In</a>
            <?php endif; ?>
        </li>
    </ul>

    <div class="hamburger" onclick="toggleMobileMenu()">
        <span></span><span></span><span></span>
    </div>
</nav>

<div id="mobile-overlay" class="mobile-menu-overlay">
    
    <div class="mobile-header-top">
        <div class="logo-mobile-menu">
            <img src="assets/IoTe_logo.png" alt="Logo">
            <div class="text-content">
                <strong>IoT and Information Engineering</strong><br>
                <span>King Mongkut's Institute of Technology Ladkrabang</span>
            </div>
        </div>
        <div class="close-btn" onclick="toggleMobileMenu()">&times;</div>
    </div>
    
    <ul class="mobile-nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="#">About IoTe</a></li>
        
        <li class="mobile-dropdown">
            <div class="dropdown-header" onclick="toggleDropdown('ac-sub')">Academics ▾</div>
            <ul id="ac-sub" class="sub-menu">
                <li><a href="#">IoTe</a></li>
                <li><a href="#">Physics & IoTe</a></li>
            </ul>
        </li>

        <li class="mobile-dropdown">
            <div class="dropdown-header" onclick="toggleDropdown('fa-sub')">Faculty ▾</div>
            <ul id="fa-sub" class="sub-menu">
                <li><a href="#">Professor of IoTe</a></li>
                <li><a href="#">Professor of Physics & IoTe</a></li>
            </ul>
        </li>

        <li class="mobile-dropdown">
            <div class="dropdown-header" onclick="toggleDropdown('per-sub')">Performance ▾</div>
            <ul id="per-sub" class="sub-menu">
                <li><a href="#">Cybersecurity Laboratory</a></li>
            </ul>
        </li>

        <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <li><a href="admin/edit_index.php" style="color:#ff6600;">Edit</a></li>
        <?php endif; ?>

        <?php if(isset($_SESSION['username'])): ?>
            <li class="mobile-user-capsule">
                <div class="user-capsule-container">
                    <div class="capsule-username"><?php echo $_SESSION['username']; ?></div>
                    <a href="profile.php" class="capsule-profile">Profile</a>
                    <a href="logout.php" class="capsule-logout">Logout</a>
                </div>
            </li>
        <?php else: ?>
            <li><a href="login.php" class="btn-signin-mobile">Sign In</a></li>
        <?php endif; ?>
    </ul>
</div>