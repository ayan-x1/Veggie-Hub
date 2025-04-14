<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "impulse101";
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$product_id = $_GET['id'] ?? null;

if (!$product_id) {
    die("Product ID not specified.");
}

// Update product
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['product_title'];
    $cat = $_POST['product_cat'];
    $type = $_POST['product_type'];
    $price = $_POST['product_price'];
    $stock = $_POST['product_stock'];
    $delivery = $_POST['product_delivery'];
    $expiry = $_POST['product_expiry'];
    $desc = $_POST['product_desc'];
    $keywords = $_POST['product_keywords'];
    $farmer_fk = $_POST['farmer_fk'];

    $sql = "UPDATE products SET 
                product_title='$title',
                product_cat='$cat',
                product_type='$type',
                product_price='$price',
                product_stock='$stock',
                product_delivery='$delivery',
                product_expiry='$expiry',
                product_desc='$desc',
                product_keywords='$keywords',
                farmer_fk='$farmer_fk'
            WHERE product_id = $product_id";

    if (mysqli_query($conn, $sql)) {
        header("Location: manage_products.php");
        exit;
    } else {
        echo "Error updating: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM products WHERE product_id = $product_id";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #eef1f5;
            padding: 30px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: #fff;
            padding: 30px 35px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        label {
            font-weight: 600;
            display: block;
            margin-top: 15px;
            color: #333;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px 12px;
            margin-top: 6px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border 0.2s ease;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #007bff;
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        button {
            margin-top: 30px;
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            .container {
                padding: 25px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Product</h2>
    <form method="POST">
        <label>Title:</label>
        <input type="text" name="product_title" value="<?= $product['product_title']; ?>" required>

        <label>Category:</label>
        <input type="text" name="product_cat" value="<?= $product['product_cat']; ?>">

        <label>Type:</label>
        <input type="text" name="product_type" value="<?= $product['product_type']; ?>">

        <label>Price (₹):</label>
        <input type="number" name="product_price" value="<?= $product['product_price']; ?>" required>

        <label>Stock Quantity:</label>
        <input type="number" name="product_stock" value="<?= $product['product_stock']; ?>" required>

        <label>Delivery Method:</label>
        <input type="text" name="product_delivery" value="<?= $product['product_delivery']; ?>">

        <label>Expiry Date:</label>
        <input type="text" name="product_expiry" value="<?= $product['product_expiry']; ?>">

        <label>Description:</label>
        <textarea name="product_desc"><?= $product['product_desc']; ?></textarea>

        <label>Keywords:</label>
        <textarea name="product_keywords"><?= $product['product_keywords']; ?></textarea>

        <label>Farmer ID:</label>
        <input type="number" name="farmer_fk" value="<?= $product['farmer_fk']; ?>">

        <button type="submit">Update Product</button>
    </form>
</div>

</body>
</html>
