<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "impulse101";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Delete cart item
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM cart WHERE product_id = $delete_id";
    mysqli_query($conn, $delete_sql);
    header("Location: manage_cart.php");
    exit;
}

// Fetch cart data
$sql = "SELECT * FROM cart";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Cart | Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }

        th, td {
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid #e1e1e1;
        }

        th {
            background-color: #f9fafb;
            color: #333;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f4f9ff;
        }

        .button {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 6px;
            font-size: 14px;
            text-decoration: none;
            color: #fff;
            transition: background 0.2s ease;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead {
                display: none;
            }

            tr {
                margin-bottom: 15px;
                background: white;
                border-radius: 10px;
                box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
            }

            td {
                padding-left: 50%;
                position: relative;
                text-align: left;
                border: none;
                border-bottom: 1px solid #eee;
            }

            td::before {
                position: absolute;
                top: 14px;
                left: 15px;
                width: 45%;
                white-space: nowrap;
                font-weight: bold;
                color: #555;
                content: attr(data-label);
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Cart Items</h2>

    <div style="margin-bottom: 20px;">
    <a href="admin_dashboard.php" style="display: inline-flex; align-items: center; padding: 10px 15px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 8px; font-weight: 500; transition: all 0.3s ease; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="margin-right: 8px;" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
        </svg>
        Back to Dashboard
    </a>
</div>
    <table>
        <thead>
            <tr>
                <th>Phone Number</th>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Subtotal (₹)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td data-label="Phone Number"><?= $row['phonenumber'] ?></td>
                <td data-label="Product ID"><?= $row['product_id'] ?></td>
                <td data-label="Quantity"><?= $row['qty'] ?></td>
                <td data-label="Subtotal">₹<?= $row['subtotal'] ?></td>
                <td data-label="Action">
                    <a href="manage_cart.php?delete_id=<?= $row['product_id'] ?>" class="button delete-btn" onclick="return confirm('Delete this cart item?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>