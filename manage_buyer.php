<?php
// Database connection (update as needed)
$host = "localhost";
$username = "root";
$password = "";
$dbname = "impulse101";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Delete buyer if delete_id is set
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM buyerregistration WHERE buyer_id = $delete_id";
    mysqli_query($conn, $sql);
    header("Location: manage_buyer.php");
    exit;
}

// Fetch all buyers
$sql = "SELECT * FROM buyerregistration";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Buyers</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        h2 { text-align: center; }
        table {
            width: 95%;
            margin: auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th { background: #f2f2f2; }
        a.button {
            background: #007bff;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 5px;
        }
        a.button:hover { background: #0056b3; }
        .delete-btn {
            background: #dc3545;
        }
        .delete-btn:hover {
            background: #c82333;
        }
    </style>
</head>
<body>

<h2>Buyer Registration List</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Company</th>
        <th>Address</th>
        <th>Actions</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $row['buyer_id']; ?></td>
        <td><?= $row['buyer_name']; ?></td>
        <td><?= $row['buyer_username']; ?></td>
        <td><?= $row['buyer_mail']; ?></td>
        <td><?= $row['buyer_phone']; ?></td>
        <td><?= $row['buyer_comp']; ?></td>
        <td><?= $row['buyer_addr']; ?></td>
        <td>
            <a href="edit_buyer.php?id=<?= $row['buyer_id']; ?>" class="button">Edit</a>
            <a href="manage_buyer.php?delete_id=<?= $row['buyer_id']; ?>" class="button delete-btn" onclick="return confirm('Are you sure you want to delete this buyer?');">Delete</a>
        </td>
    </tr>
    <?php } ?>

</table>

</body>
</html>
