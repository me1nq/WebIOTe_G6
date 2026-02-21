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
        :root {
            --primary-orange: #f39c12;
            --bg-gray: #f5f6fa;
            --text-dark: #333;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Kanit', sans-serif; background-color: var(--bg-gray); padding: 30px 20px; color: var(--text-dark); }
        .container { max-width: 1200px; margin: 0 auto; }
        
        h1 { 
            text-align: center; 
            color: var(--text-dark); 
            margin-bottom: 50px; 
            font-weight: 600;
            font-size: 2.5rem;
        }
        h1 i { color: var(--primary-orange); margin-right: 10px; }
        
        /* Grid */
        .grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); 
            gap: 30px; 
        }

        .card { 
            background: white; 
            border-radius: 15px; 
            overflow: hidden; 
            box-shadow: 0 10px 20px rgba(0,0,0,0.05); 
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            display: block;
            border: 1px solid transparent;
        }

        .card:hover { 
            transform: translateY(-8px); 
            box-shadow: 0 15px 30px rgba(243, 156, 18, 0.2);
            border-color: var(--primary-orange);
        }

        .card img { width: 100%; height: 220px; object-fit: cover; }
        .card-body { padding: 20px; text-align: center; }
        .card-title { font-size: 1.2rem; font-weight: 500; color: var(--text-dark); }
        
        /* ไม่มีปุ่ม Admin Link แล้ว */
    </style>
</head>
<body>

    <div class="container">
        <h1><i class="fa-solid fa-book-open"></i> คลังโปรเจครุ่นพี่</h1>

        <div class="grid">
            <?php
            $sql = "SELECT * FROM projects ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
            ?>
                <a href="uploads/pdfs/<?php echo $row['pdf_file']; ?>" target="_blank" class="card">
                    <img src="uploads/images/<?php echo $row['image_file']; ?>" alt="Project Image">
                    <div class="card-body">
                        <div class="card-title"><?php echo htmlspecialchars($row['project_name']); ?></div>
                    </div>
                </a>
            <?php 
                }
            } else {
                echo "<p style='text-align:center; grid-column: 1 / -1; font-size: 1.2rem; color: #777;'>ยังไม่มีข้อมูลโปรเจคในขณะนี้</p>";
            }
            ?>
        </div>
    </div>

</body>
</html>