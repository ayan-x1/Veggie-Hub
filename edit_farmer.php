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
    die("No farmer ID provided.");
}
$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['farmer_name'];
    $phone = $_POST['farmer_phone'];
    $bank = $_POST['farmer_bank'];
    $pan = $_POST['farmer_pan'];
    $password = $_POST['farmer_password'];
    $address = $_POST['farmer_address'];
    $district = $_POST['farmer_district'];
    $state = $_POST['farmer_state'];

    $update_sql = "UPDATE farmerregistration SET
        farmer_name = '$name',
        farmer_phone = '$phone',
        farmer_bank = '$bank',
        farmer_pan = '$pan',
        farmer_password = '$password',
        farmer_address = '$address',
        farmer_district = '$district',
        farmer_state = '$state'
        WHERE farmer_id = $id";

    if (mysqli_query($conn, $update_sql)) {
        header("Location: manage_farmer.php");
        exit;
    } else {
        echo "Error updating: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM farmerregistration WHERE farmer_id = $id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) != 1) {
    die("Farmer not found.");
}
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Farmer</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f2f5f8;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #333;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px 14px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s ease;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #4a90e2;
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        input[type="submit"] {
            background-color: #28a745;
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        a.button {
            background-color: #6c757d;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.2s ease;
        }

        a.button:hover {
            background-color: #5a6268;
        }

        @media (max-width: 640px) {
            .form-actions {
                flex-direction: column;
                gap: 12px;
            }

            input[type="submit"],
            a.button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Farmer</h2>

    <form method="POST">
        <label>Name:</label>
        <input type="text" name="farmer_name" value="<?= $row['farmer_name'] ?>" required>

        <label>Phone:</label>
        <input type="text" name="farmer_phone" value="<?= $row['farmer_phone'] ?>" required>

        <label>Bank Account:</label>
        <input type="text" name="farmer_bank" value="<?= $row['farmer_bank'] ?>" required>

        <label>PAN:</label>
        <input type="text" name="farmer_pan" value="<?= $row['farmer_pan'] ?>" required>

        <label>Password:</label>
        <input type="text" name="farmer_password" value="<?= $row['farmer_password'] ?>" required>

        <label>District:</label>
        <input type="text" name="farmer_district" value="<?= $row['farmer_district'] ?>" required>

        <label>State:</label>
        <input type="text" name="farmer_state" value="<?= $row['farmer_state'] ?>" required>

        <label>Address:</label>
        <textarea name="farmer_address" required><?= $row['farmer_address'] ?></textarea>

        <div class="form-actions">
            <input type="submit" value="Update Farmer">
            <a href="manage_farmer.php" class="button">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>
