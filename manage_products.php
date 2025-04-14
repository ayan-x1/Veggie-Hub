<?php
// DB connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "impulse101";
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Delete product
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM products WHERE product_id = $id";
    mysqli_query($conn, $sql);
    header("Location: manage_products.php");
    exit;
}

// Fetch all products
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f2f5f8;
            padding: 30px;
            margin: 0;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f9fafb;
            font-weight: 600;
            color: #333;
        }

        tr:hover {
            background-color: #f4f9ff;
        }

        .button {
            background-color: #007bff;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 13px;
            margin-right: 5px;
            transition: background-color 0.2s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        td.actions {
            white-space: nowrap;
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
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 10px;
                background: #fff;
            }

            td {
                padding-left: 50%;
                position: relative;
                border: none;
                border-bottom: 1px solid #eee;
            }

            td::before {
                position: absolute;
                top: 12px;
                left: 12px;
                font-weight: bold;
                content: attr(data-label);
            }

            td.actions {
                padding-left: 12px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Product List</h2>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Category</th>
            <th>Type</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Delivery</th>
            <th>Expiry</th>
            <th>Farmer ID</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td data-label="ID"><?= $row['product_id']; ?></td>
                <td data-label="Title"><?= $row['product_title']; ?></td>
                <td data-label="Category"><?= $row['product_cat']; ?></td>
                <td data-label="Type"><?= $row['product_type']; ?></td>
                <td data-label="Price">₹<?= $row['product_price']; ?></td>
                <td data-label="Stock"><?= $row['product_stock']; ?></td>
                <td data-label="Delivery"><?= $row['product_delivery']; ?></td>
                <td data-label="Expiry"><?= $row['product_expiry']; ?></td>
                <td data-label="Farmer ID"><?= $row['farmer_fk']; ?></td>
                <td class="actions">
                    <a class="button" href="edit_product.php?id=<?= $row['product_id']; ?>">Edit</a>
                    <a class="button delete-btn" href="manage_products.php?delete_id=<?= $row['product_id']; ?>" onclick="return confirm('Delete this product?');">Delete</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
