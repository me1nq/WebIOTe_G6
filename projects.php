<?php 
session_start(); 
include 'includes/db.php'; // เปลี่ยนให้ใช้ path เดียวกับหน้าอื่นๆ
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คลังโปรเจครุ่นพี่ | IoT Engineering</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css"> 

    <style>
        :root { --primary-orange: #FF6F00; --bg-gray: #f5f6fa; }
        
        /* สไตล์ช่องค้นหา (ต้นฉบับมึง) */
        .search-container { max-width: 500px; margin: 0 auto 40px; position: relative; }
        .search-container input { width: 100%; padding: 15px 20px; border-radius: 30px; border: 2px solid #ddd; outline: none; font-size: 1rem; transition: 0.3s; }
        .search-container input:focus { border-color: var(--primary-orange); }
        .search-container i { position: absolute; right: 20px; top: 18px; color: #777; }

        /* สไตล์ Grid และ Card (ต้นฉบับมึง) */
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px; }
        .card { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: 0.3s; text-decoration: none; color: inherit; border: 1px solid #eee; }
        .card:hover { transform: translateY(-5px); border: 1px solid var(--primary-orange); }
        .card img { width: 100%; height: 200px; object-fit: cover; }
        .card-body { padding: 20px; text-align: center; font-weight: 500; }
        
        /* ลบสไตล์ body เดิมที่อาจจะตีกับหน้าหลักออก แต่เก็บส่วนอื่นไว้ */
        .projects-wrapper { width: 100%; }
    </style>
</head>
<body>

    <?php include 'includes/navbar.php'; ?>

    <div class="page-header">
        คลังความรู้
    </div>

    <div class="page-background">
        <div class="content-card">
            
            <div class="projects-wrapper">
                <div class="search-container">
                    <form method="get">
                        <input type="text" name="search" placeholder="ค้นหาชื่อ..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </form>
                </div>

                <div class="grid">
                    <?php
                    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                    $sql = "SELECT * FROM projects WHERE project_name LIKE '%$search%' ORDER BY id DESC";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                    ?>
                        <a href="assets/projects/pdfs/<?php echo $row['pdf_file']; ?>" target="_blank" class="card">
                            <img src="assets/projects/images/<?php echo $row['image_file']; ?>">
                            <div class="card-body"><?php echo htmlspecialchars($row['project_name']); ?></div>
                        </a>
                    <?php 
                        }
                    } else {
                        echo "<p style='text-align:center; grid-column: 1/-1;'>ไม่พบข้อมูลที่ค้นหา</p>";
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="js/script.js"></script>
</body>
</html>