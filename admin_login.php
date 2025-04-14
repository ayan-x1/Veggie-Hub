<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$dbname = "impulse101";

$conn = mysqli_connect($host, $username, $password, $dbname);
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_user = $_POST['username'];
    $admin_pass = md5($_POST['password']); // Use password_hash in production

    $sql = "SELECT * FROM admin WHERE admin_username='$admin_user' AND admin_password='$admin_pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $admin_user;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #dff9fb, #c7ecee);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .login-box h2 {
            margin-bottom: 20px;
            color: #2d3436;
            font-size: 24px;
        }
        .login-box h2::before {
            content: "🌿 ";
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: border 0.3s;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border-color: #00cec9;
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #00b894;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 15px;
            transition: background 0.3s;
        }
        button:hover {
            background: #019875;
        }
        .error {
            color: #d63031;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .footer {
            margin-top: 20px;
            font-size: 13px;
            color: #636e72;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Admin Login</h2>
        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Admin Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <div class="footer">© 2025 VeggieHub Admin Panel</div>
    </div>
</body>
</html>
