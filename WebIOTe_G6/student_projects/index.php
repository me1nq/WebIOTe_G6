<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คลังโปรเจครุ่นพี่</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary-orange: #FF6F00; --bg-gray: #f5f6fa; }
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Kanit', sans-serif; }
        body { background-color: var(--bg-gray); padding: 30px 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { text-align: center; margin-bottom: 30px; }
        
        /* สไตล์ช่องค้นหา */
        .search-container { max-width: 500px; margin: 0 auto 40px; position: relative; }
        .search-container input { width: 100%; padding: 15px 20px; border-radius: 30px; border: 2px solid #ddd; outline: none; font-size: 1rem; transition: 0.3s; }
        .search-container input:focus { border-color: var(--primary-orange); }
        .search-container i { position: absolute; right: 20px; top: 18px; color: #777; }

        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px; }
        .card { background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: 0.3s; text-decoration: none; color: inherit; }
        .card:hover { transform: translateY(-5px); border: 1px solid var(--primary-orange); }
        .card img { width: 100%; height: 200px; object-fit: cover; }
        .card-body { padding: 20px; text-align: center; font-weight: 500; }
    </style>
</head>
<body>

<div class="container">
    <h1><i class="fa-solid fa-book-open" style="color:var(--primary-orange)"></i> คลังโปรเจครุ่นพี่</h1>

    <div class="search-container">
        <form method="get">
            <input type="text" name="search" placeholder="ค้นหาชื่อโปรเจค..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <i class="fa-solid fa-magnifying-glass"></i>
        </form>
    </div>

    <div class="grid">
        <?php
        $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
        $sql = "SELECT * FROM projects WHERE project_name LIKE '%$search%' ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        ?>
            <a href="uploads/pdfs/<?php echo $row['pdf_file']; ?>" target="_blank" class="card">
                <img src="uploads/images/<?php echo $row['image_file']; ?>">
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

</body>
</html>