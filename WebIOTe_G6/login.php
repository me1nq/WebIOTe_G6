<?php
session_start();
include 'includes/db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // ดึงข้อมูลมาเช็ค
    $sql = "SELECT * FROM users WHERE username = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user_data = mysqli_fetch_assoc($result); // ดึงข้อมูลก้อนนั้นออกมา
        
        // เก็บข้อมูลลง Session
        $_SESSION['user_id'] = $user_data['id'];
        $_SESSION['username'] = $user_data['username'];
        $_SESSION['role'] = $user_data['role']; // <--- ตัวสำคัญ! จำว่าคนนี้เป็น admin หรือ user

        header("Location: index.php"); // ล็อกอินสำเร็จไปหน้า home
        exit();
    } else {
        $error = "อีเมลหรือรหัสผ่านไม่ถูกต้อง!";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | IoT Engineering</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-logo-section">
            <div class="logo-circle">
                <img src="assets/kmitl_logo.png" alt="KMITL Logo">
            </div>
        </div>

        <div class="login-form-section">
            <h2>Department of IoT and <br> Information Engineering</h2>
            
            <?php if($error): ?>
                <p style="color: red; font-size: 12px;"><?php echo $error; ?></p>
            <?php endif; ?>

            <form method="POST">
                <input type="text" name="email" placeholder="Email (@kmitl.ac.th)" required>
                <input type="password" name="password" placeholder="****************" required>
                <button type="submit" class="btn-login">Log in</button>
            </form>
        </div>
    </div>
</body>
</html>