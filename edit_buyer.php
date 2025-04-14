<?php
// DB Connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "impulse101";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get buyer ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Buyer ID not provided.");
}

$buyer_id = intval($_GET['id']); // secure it as int

// If form is submitted, update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Escape data to prevent SQL injection
    $buyer_name = mysqli_real_escape_string($conn, $_POST['buyer_name']);
    $buyer_username = mysqli_real_escape_string($conn, $_POST['buyer_username']);
    $buyer_mail = mysqli_real_escape_string($conn, $_POST['buyer_mail']);
    $buyer_phone = mysqli_real_escape_string($conn, $_POST['buyer_phone']);
    $buyer_addr = mysqli_real_escape_string($conn, $_POST['buyer_addr']);
    $buyer_comp = mysqli_real_escape_string($conn, $_POST['buyer_comp']);
    $buyer_bank = mysqli_real_escape_string($conn, $_POST['buyer_bank']);
    $buyer_pan = mysqli_real_escape_string($conn, $_POST['buyer_pan']);
    $buyer_license = mysqli_real_escape_string($conn, $_POST['buyer_license']);

    $update_sql = "UPDATE buyerregistration SET 
        buyer_name = '$buyer_name',
        buyer_username = '$buyer_username',
        buyer_mail = '$buyer_mail',
        buyer_phone = '$buyer_phone',
        buyer_addr = '$buyer_addr',
        buyer_comp = '$buyer_comp',
        buyer_bank = '$buyer_bank',
        buyer_pan = '$buyer_pan',
        buyer_license = '$buyer_license'
        WHERE buyer_id = $buyer_id";

    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('Buyer updated successfully.'); window.location.href = 'manage_buyer.php';</script>";
        exit;
    } else {
        echo "Update failed: " . mysqli_error($conn);
    }
}

// Fetch buyer details to prefill form
$select_sql = "SELECT * FROM buyerregistration WHERE buyer_id = $buyer_id";
$result = mysqli_query($conn, $select_sql);
$buyer = mysqli_fetch_assoc($result);

if (!$buyer) {
    die("Buyer not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buyer</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        h2 { text-align: center; }
        form {
            width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h2>Edit Buyer Information</h2>

<form method="POST">
    <label>Name</label>
    <input type="text" name="buyer_name" value="<?= $buyer['buyer_name'] ?>" required>

    <label>Username</label>
    <input type="text" name="buyer_username" value="<?= $buyer['buyer_username'] ?>" required>

    <label>Email</label>
    <input type="email" name="buyer_mail" value="<?= $buyer['buyer_mail'] ?>" required>

    <label>Phone</label>
    <input type="text" name="buyer_phone" value="<?= $buyer['buyer_phone'] ?>" required>

    <label>Address</label>
    <input type="text" name="buyer_addr" value="<?= $buyer['buyer_addr'] ?>">

    <label>Company</label>
    <input type="text" name="buyer_comp" value="<?= $buyer['buyer_comp'] ?>">

    <label>Bank</label>
    <input type="text" name="buyer_bank" value="<?= $buyer['buyer_bank'] ?>">

    <label>PAN</label>
    <input type="text" name="buyer_pan" value="<?= $buyer['buyer_pan'] ?>">

    <label>License</label>
    <input type="text" name="buyer_license" value="<?= $buyer['buyer_license'] ?>">

    <input type="submit" value="Update Buyer">
</form>

</body>
</html>
