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
        $user_data = mysqli_fetch_assoc($result); 
        
        // เก็บข้อมูลลง Session
        $_SESSION['user_id'] = $user_data['id'];
        $_SESSION['username'] = $user_data['username'];
        $_SESSION['role'] = $user_data['role']; 

        header("Location: index.php"); 
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
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login-page-wrapper">
        <div class="login-container">
            
            <div class="login-logo-section">
                <img src="assets/kmitl_logo.png" alt="KMITL Logo" class="kmitl-logo">
            </div>

            <div class="login-form-section">
                <h2>Department of IoT and<br>Information Engineering</h2>
                
                <?php if($error): ?>
                    <div class="error-msg"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="input-group">
                        <input type="text" name="email" id="email" required>
                        <label for="email">Email (@kmitl.ac.th)</label>
                    </div>

                    <div class="input-group">
                        <input type="password" name="password" id="password" required>
                        <label for="password">Password</label>
                    </div>

                    <button type="submit" class="btn-login">Log in</button>
                </form>
            </div>
            
        </div>
    </div>
</body>
</html>