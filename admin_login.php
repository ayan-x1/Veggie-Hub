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
        
        // Set remember me cookie if checked
        if(isset($_POST['remember']) && $_POST['remember'] == 'on') {
            setcookie("admin_username", $admin_user, time() + (86400 * 30), "/"); // 30 days
        }
        
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VeggieHub Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #e0eafc, #cfdef3);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
        
        .particle {
            position: absolute;
            width: 6px;
            height: 6px;
            background-color: rgba(78, 204, 163, 0.4);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }
        
        @keyframes float {
            0% {
                transform: translateY(0) translateX(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) translateX(100px);
                opacity: 0;
            }
        }
        
        .login-container {
            background: white;
            width: 400px;
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            position: relative;
            z-index: 2;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeIn 0.8s forwards ease-out;
        }
        
        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-header {
            background: linear-gradient(135deg, #1e272e 0%, #2d3436 100%);
            padding: 30px 0;
            text-align: center;
            position: relative;
        }
        
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 700;
            color: white;
        }
        
        .logo i {
            color: #4ecca3;
            font-size: 34px;
            margin-right: 12px;
        }
        
        .logo span {
            background: linear-gradient(to right, #4ecca3, #2ecc71);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 700;
        }
        
        .header-divider {
            height: 4px;
            background: linear-gradient(to right, #4ecca3, #2ecc71, #4ecca3);
        }
        
        .login-form {
            padding: 40px;
        }
        
        .form-title {
            text-align: center;
            font-size: 22px;
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-size: 14px;
            color: #636e72;
            font-weight: 500;
        }
        
        .input-group {
            position: relative;
        }
        
        .input-group input {
            width: 100%;
            padding: 15px 20px;
            font-size: 16px;
            border: 2px solid #dfe6e9;
            border-radius: 12px;
            transition: all 0.3s;
            font-family: 'Poppins', sans-serif;
        }
        
        .input-group input:focus {
            border-color: #4ecca3;
            box-shadow: 0 0 0 3px rgba(78, 204, 163, 0.15);
            outline: none;
        }
        
        .input-group i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #b2bec3;
            font-size: 18px;
            transition: all 0.3s;
        }
        
        .input-group input:focus + i {
            color: #4ecca3;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .remember-me input {
            margin-right: 10px;
            width: 18px;
            height: 18px;
            accent-color: #4ecca3;
        }
        
        .remember-me label {
            font-size: 14px;
            color: #636e72;
        }
        
        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(to right, #4ecca3, #2ecc71);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 8px 15px rgba(78, 204, 163, 0.3);
            font-family: 'Poppins', sans-serif;
        }
        
        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 20px rgba(78, 204, 163, 0.4);
        }
        
        .login-btn:active {
            transform: translateY(0);
        }
        
        .forgot-password {
            text-align: center;
            margin-top: 20px;
        }
        
        .forgot-password a {
            color: #0984e3;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .forgot-password a:hover {
            color: #0560a4;
            text-decoration: underline;
        }
        
        .error-message {
            background-color: #ffeeee;
            border-left: 4px solid #e74c3c;
            padding: 12px;
            margin-bottom: 25px;
            color: #c0392b;
            font-size: 14px;
            border-radius: 4px;
            display: <?php echo $error ? 'block' : 'none'; ?>;
            animation: <?php echo $error ? 'shake 0.5s' : 'none'; ?>;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .footer {
            text-align: center;
            font-size: 13px;
            color: #636e72;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="particles">
        <!-- Particles will be created with JavaScript -->
    </div>

    <div class="login-container">
        <div class="login-header">
            <div class="logo">
                <i class="fas fa-leaf"></i>
                <span>VeggieHub</span>
            </div>
        </div>
        <div class="header-divider"></div>
        
        <div class="login-form">
            <h2 class="form-title">Admin Login</h2>
            
            <div class="error-message" id="errorMessage">
                <?php echo $error; ?>
            </div>
            
            <form method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <input type="text" id="username" name="username" placeholder="Enter your username" value="<?php echo isset($_COOKIE['admin_username']) ? $_COOKIE['admin_username'] : ''; ?>" required>
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        <i class="fas fa-lock password-toggle"></i>
                    </div>
                </div>
                
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                
                <button type="submit" class="login-btn">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
            
            <div class="footer">© 2025 VeggieHub Admin Panel</div>
        </div>
    </div>

    <script>
        // Create floating particles
        const particles = document.querySelector('.particles');
        const particleCount = 20;
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            
            // Random positioning
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            
            // Random size
            const size = Math.random() * 8 + 3;
            particle.style.width = size + 'px';
            particle.style.height = size + 'px';
            
            // Random animation duration and delay
            const duration = Math.random() * 10 + 15;
            const delay = Math.random() * 10;
            particle.style.animation = `float ${duration}s infinite linear ${delay}s`;
            
            particles.appendChild(particle);
        }
        
        // Password visibility toggle
        document.querySelector('.password-toggle').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.classList.remove('fa-lock');
                this.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-lock');
            }
        });
    </script>
</body>
</html>