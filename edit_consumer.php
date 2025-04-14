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
    die("No consumer ID provided.");
}
$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $password = $_POST['password'];

    $update_sql = "UPDATE consumer SET 
        name = '$name',
        email = '$email',
        phone = '$phone',
        address = '$address',
        pincode = '$pincode',
        password = '$password'
        WHERE id = $id";

    if (mysqli_query($conn, $update_sql)) {
        header("Location: manage_consumer.php");
        exit;
    } else {
        echo "Error updating: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM consumer WHERE id = $id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) != 1) {
    die("Consumer not found.");
}
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Consumer</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #eef1f4;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px 14px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s ease;
        }

        input:focus {
            border-color: #4a90e2;
            outline: none;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 14px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
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
    <h2>Edit Consumer</h2>

    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?= $row['name'] ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= $row['email'] ?>" required>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?= $row['phone'] ?>" required>

        <label>Address:</label>
        <input type="text" name="address" value="<?= $row['address'] ?>" required>

        <label>Pincode:</label>
        <input type="text" name="pincode" value="<?= $row['pincode'] ?>" required>

        <label>Password:</label>
        <input type="password" name="password" value="<?= $row['password'] ?>" required>

        <div class="form-actions">
            <input type="submit" value="Update Consumer">
            <a href="manage_consumer.php" class="button">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>
