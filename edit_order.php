<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "impulse101";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_GET['id'])) {
    die("Order ID not specified.");
}
$order_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $qty = $_POST['qty'];
    $total = $_POST['total'];
    $payment = $_POST['payment'];
    $delivery = $_POST['delivery'];
    $address = $_POST['address'];

    $sql = "UPDATE orders SET 
                qty = '$qty', 
                total = '$total', 
                payment = '$payment', 
                delivery = '$delivery', 
                address = '$address' 
            WHERE order_id = $order_id";

    if (mysqli_query($conn, $sql)) {
        header("Location: manage_orders.php");
        exit;
    } else {
        echo "Error updating order: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM orders WHERE order_id = $order_id";
$result = mysqli_query($conn, $sql);
$order = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Order</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #2c3e50;
        }

        label {
            font-weight: 600;
            margin-top: 15px;
            display: block;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px 14px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border 0.2s ease;
        }

        input:focus,
        select:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            width: 100%;
            margin-top: 25px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 0;
            font-weight: 600;
            font-size: 15px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Order #<?= $order['order_id']; ?></h2>
    <form method="POST">
        <label>Quantity:</label>
        <input type="number" name="qty" value="<?= $order['qty']; ?>" required>

        <label>Total:</label>
        <input type="number" name="total" value="<?= $order['total']; ?>" required>

        <label>Payment Method:</label>
        <select name="payment" required>
            <option value="Cash" <?= $order['payment'] == 'Cash' ? 'selected' : '' ?>>Cash</option>
            <option value="Online" <?= $order['payment'] == 'Online' ? 'selected' : '' ?>>Online</option>
        </select>

        <label>Delivery Method:</label>
        <select name="delivery" required>
            <option value="Home" <?= $order['delivery'] == 'Home' ? 'selected' : '' ?>>Home</option>
            <option value="Pickup" <?= $order['delivery'] == 'Pickup' ? 'selected' : '' ?>>Pickup</option>
        </select>

        <label>Address:</label>
        <input type="text" name="address" value="<?= $order['address']; ?>" required>

        <button type="submit">Update Order</button>
    </form>
</div>

</body>
</html>
