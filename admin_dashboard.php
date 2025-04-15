<?php
session_start();
// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$host = "localhost";
$username = "root";
$password = "";
$dbname = "impulse101";
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$farmer_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM farmerregistration"))['count'];
$consumer_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM consumer"))['count'];
$order_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM orders"))['count'];
$cart_items = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM cart"))['count'];
$category_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM categories"))['count'];
$product_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM products"))['count'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #e0eafc, #cfdef3);
            margin: 0;
            padding: 0;
            position: relative;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Background animation styles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }
        
        .particle {
            position: absolute;
            width: 6px;
            height: 6px;
            background-color: rgba(78, 204, 163, 0.2);
            border-radius: 50%;
            animation: float 25s infinite linear;
        }
        
        @keyframes float {
            0% {
                transform: translateY(100vh) translateX(-50px);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) translateX(100px);
                opacity: 0;
            }
        }
        
        header {
            background: linear-gradient(135deg, #1e272e 0%, #2d3436 100%);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 0;
            position: relative;
            z-index: 10;
        }
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 30px;
            height: 80px;
        }
        .logo {
            display: flex;
            align-items: center;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: white;
        }
        .logo i {
            color: #4ecca3;
            font-size: 32px;
            margin-right: 10px;
        }
        .logo span {
            background: linear-gradient(to right, #4ecca3, #2ecc71);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 700;
        }
        .auth-section {
            display: flex;
            align-items: center;
        }
        .user-info {
            display: flex;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50px;
            padding: 8px 20px;
            margin-right: 15px;
            transition: all 0.3s;
        }
        .user-info:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }
        .user-avatar {
            background-color: #4ecca3;
            color: #1e272e;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 12px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        }
        .user-name {
            color: white;
            font-size: 15px;
            font-weight: 500;
        }
        .auth-btn {
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logout-btn {
            background: linear-gradient(to right, #e74c3c, #c0392b);
            color: white;
            border: none;
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
        }
        .logout-btn:hover {
            background: linear-gradient(to right, #c0392b, #e74c3c);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(231, 76, 60, 0.4);
        }
        .logout-btn i {
            margin-right: 8px;
        }
        .login-btn {
            background: linear-gradient(to right, #3498db, #2980b9);
            color: white;
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }
        .login-btn:hover {
            background: linear-gradient(to right, #2980b9, #3498db);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(52, 152, 219, 0.4);
        }
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 30px;
            padding: 50px;
            max-width: 1400px;
            margin: auto;
            position: relative;
            z-index: 5;
        }
        .card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
            padding: 40px 25px;
            text-align: center;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            animation: fadeIn 0.6s forwards ease-out;
            opacity: 0;
            transform: translateY(20px);
        }
        
        /* Stagger card animations */
        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4) { animation-delay: 0.4s; }
        .card:nth-child(5) { animation-delay: 0.5s; }
        .card:nth-child(6) { animation-delay: 0.6s; }
        
        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.2);
        }
        .card h2 {
            font-size: 42px;
            color: #0984e3;
            margin: 0;
        }
        .card p {
            font-size: 18px;
            margin-top: 12px;
            color: #2d3436;
            font-weight: 500;
        }
        .card-btn {
            margin-top: 20px;
            display: inline-block;
            padding: 12px 24px;
            background-color: #00cec9;
            color: white;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: background 0.3s, transform 0.2s;
        }
        .card-btn:hover {
            background-color: #00b894;
            transform: scale(1.05);
        }
        .header-divider {
            height: 4px;
            background: linear-gradient(to right, #4ecca3, #2ecc71, #4ecca3);
        }
    </style>
</head>
<body>
<div class="particles">
    <!-- Particles will be created with JavaScript -->
</div>

<header>
    <div class="header-container">
        <div class="logo">
            <i class="fas fa-leaf"></i>
            <span>VeggieHub</span> Admin Dashboard
        </div>
        <div class="auth-section">
            <?php if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true): ?>
                <div class="user-info">
                    <div class="user-avatar">
                        <?php echo strtoupper(substr($_SESSION['admin_username'], 0, 1)); ?>
                    </div>
                    <div class="user-name"><?php echo htmlspecialchars($_SESSION['admin_username']); ?></div>
                </div>
                <a href="admin_logout.php" class="auth-btn logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            <?php else: ?>
                <a href="admin_login.php" class="auth-btn login-btn">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="header-divider"></div>
</header>

<div class="dashboard">
    <div class="card">
        <h2><?= $farmer_count ?></h2>
        <p>Registered Farmers</p>
        <a href="manage_farmer.php" class="card-btn">Manage</a>
    </div>
    <div class="card">
        <h2><?= $consumer_count ?></h2>
        <p>Registered Users</p>
        <a href="manage_consumer.php" class="card-btn">Manage</a>
    </div>
    <div class="card">
        <h2><?= $order_count ?></h2>
        <p>Total Orders</p>
        <a href="manage_orders.php" class="card-btn">Manage</a>
    </div>
    <div class="card">
        <h2><?= $cart_items ?></h2>
        <p>Items in Cart</p>
        <a href="manage_cart.php" class="card-btn">Manage</a>
    </div>
    <div class="card">
        <h2><?= $category_count ?></h2>
        <p>Categories</p>
        <a href="manage_categories.php" class="card-btn">Manage</a>
    </div>
    <div class="card">
        <h2><?= $product_count ?></h2>
        <p>Products</p>
        <a href="manage_products.php" class="card-btn">Manage</a>
    </div>
</div>

<script>
    // Create floating particles
    const particles = document.querySelector('.particles');
    const particleCount = 30;
    
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
        const duration = Math.random() * 15 + 20;
        const delay = Math.random() * 10;
        particle.style.animation = `float ${duration}s infinite linear ${delay}s`;
        
        particles.appendChild(particle);
    }
</script>

</body>
</html>