// ฟังก์ชัน เปิด/ปิด เมนูมือถือแบบมี Animation
function toggleMobileMenu() {
    const overlay = document.getElementById('mobile-overlay');
    if (overlay) {
        // ใช้ toggle เพื่อสลับการใส่/ถอดคลาส 'active'
        overlay.classList.toggle('active');
        
        // เช็คว่าเปิดอยู่ไหม เพื่อล็อคการเลื่อนหน้าจอ
        if (overlay.classList.contains('active')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = 'auto';
        }
    }
}

// ฟังก์ชันกดพื้นที่ว่าง หรือกดข้างนอกเมนู เพื่อปิด
window.onclick = function(event) {
    const overlay = document.getElementById('mobile-overlay');
    const hamburger = document.querySelector('.hamburger'); // ดึงปุ่ม 3 ขีดมาด้วย

    // เช็คว่าตอนนี้เมนูมันเปิดอยู่ไหม
    if (overlay && overlay.classList.contains('active')) {
        
        // เช็คว่าจิ้มหน้าเว็บส่วนอื่นที่อยู่นอกกล่องเมนูจริงๆ ใช่ไหม
        // (overlay.contains จะเป็น true ถ้ากดโดนข้างในกล่อง รวมถึงพื้นที่สีเขียวด้วย)
        const isClickedOutside = !overlay.contains(event.target) && !hamburger.contains(event.target);

        // ถ้าจิ้มข้างนอกกล่องจริงๆ ค่อยสั่งปิด
        if (isClickedOutside) {
            overlay.classList.remove('active');
            document.body.style.overflow = 'auto'; // ปลดล็อคให้หน้าเว็บเลื่อนได้ปกติ
        }
    }
}

// ฟังก์ชันเปิด/ปิด Dropdown (ตัวลูก) ยังใช้เหมือนเดิมได้เลย
function toggleDropdown(id) {
    const dropdown = document.getElementById(id);
    if (dropdown) {
        const isVisible = dropdown.style.display === 'block';
        dropdown.style.display = isVisible ? 'none' : 'block';
    }
}

// ปิดเมนูอัตโนมัติเมื่อขยายจอเป็น Desktop
window.addEventListener('resize', function() {
    if (window.innerWidth > 992) {
        const overlay = document.getElementById('mobile-overlay');
        if(overlay) overlay.classList.remove('active'); // สั่งเอา active ออก
        document.body.style.overflow = 'auto';
    }
});

window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    
    // ถ้าเลื่อนจอลงมาเกิน 50 พิกเซล
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled'); // สั่งเปิดโหมดกระจกฝ้า
    } else {
        // ถ้าเลื่อนกลับไปบนสุด
        navbar.classList.remove('scrolled'); // กลับเป็นสีดำทึบเหมือนเดิม
    }
});

// =========================================
// สลับการแสดงผล Dropdown ผู้ใช้งาน
// =========================================
document.addEventListener('DOMContentLoaded', function() {
    const userMenuButton = document.getElementById('userMenuButton');
    const userMenuDropdown = document.getElementById('userMenuDropdown');

    // ถ้าเจอปุ่มในหน้าเว็บ
    if (userMenuButton && userMenuDropdown) {
        
        // เมื่อกดที่ชื่อ
        userMenuButton.addEventListener('click', function(event) {
            // หยุดการส่งต่อคลิก เพื่อไม่ให้โดนเงื่อนไข 'กดข้างนอก'
            event.stopPropagation(); 
            // สลับการใส่/ถอดคลาส 'show'
            userMenuDropdown.classList.toggle('show');
        });

        // เมื่อกดข้างนอก Dropdown (เช่น กดที่เนื้อหาหน้าเว็บ)
        window.addEventListener('click', function(event) {
            // ถ้า Dropdown เปิดอยู่ และสิ่งที่กด **ไม่ใช่** ตัว Dropdown เอง
            if (userMenuDropdown.classList.contains('show') && !userMenuDropdown.contains(event.target)) {
                // ให้สั่งปิด
                userMenuDropdown.classList.remove('show');
            }
        });
    }
});