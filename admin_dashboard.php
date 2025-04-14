<?php
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
        }
        header {
            background: #1e272e;
            color: white;
            padding: 30px 50px;
            text-align: center;
            font-size: 30px;
            font-weight: 600;
            letter-spacing: 1px;
        }
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 30px;
            padding: 50px;
            max-width: 1400px;
            margin: auto;
        }
        .card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
            padding: 40px 25px;
            text-align: center;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
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
    </style>
</head>
<body>

<header>
    
<div class="logo" style="color: green;"><i class="fas fa-leaf"></i> VeggieHub Admin Page</div>
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

</body>
</html>
