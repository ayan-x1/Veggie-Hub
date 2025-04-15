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

// Delete order
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM orders WHERE order_id = $id";
    mysqli_query($conn, $sql);
    header("Location: manage_orders.php");
    exit;
}

// Fetch orders
$sql = "SELECT * FROM orders";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Orders | Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: #fff;
            border-radius: 12px;
            padding: 30px;
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

        .action-buttons {
            display: flex;
            gap: 10px;
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

        .edit-btn {
            background-color: #007bff;
        }

        .edit-btn:hover {
            background-color: #0069d9;
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
                margin-bottom: 20px;
                border-radius: 10px;
                overflow: hidden;
                background-color: #fff;
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

            .action-buttons {
                flex-direction: column;
                gap: 6px;
                padding: 10px 0;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Order List</h2>

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
                <th>ID</th>
                <th>Buyer Phone</th>
                <th>Product ID</th>
                <th>Phone</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Payment</th>
                <th>Delivery</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td data-label="ID"><?= $row['order_id']; ?></td>
                <td data-label="Buyer Phone"><?= $row['buyer_phonenumber']; ?></td>
                <td data-label="Product ID"><?= $row['product_id']; ?></td>
                <td data-label="Phone"><?= $row['phonenumber']; ?></td>
                <td data-label="Qty"><?= $row['qty']; ?></td>
                <td data-label="Total">₹<?= $row['total']; ?></td>
                <td data-label="Payment"><?= $row['payment']; ?></td>
                <td data-label="Delivery"><?= $row['delivery']; ?></td>
                <td data-label="Address"><?= $row['address']; ?></td>
                <td data-label="Actions">
                    <div class="action-buttons">
                        <a href="edit_order.php?id=<?= $row['order_id']; ?>" class="button edit-btn">Edit</a>
                        <a href="manage_orders.php?delete_id=<?= $row['order_id']; ?>" class="button delete-btn" onclick="return confirm('Delete this order?');">Delete</a>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
