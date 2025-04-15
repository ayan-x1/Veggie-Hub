<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "impulse101";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Delete farmer
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM farmerregistration WHERE farmer_id = $delete_id";
    mysqli_query($conn, $delete_sql);
    header("Location: manage_farmer.php");
    exit;
}

// Fetch all farmers
$sql = "SELECT * FROM farmerregistration";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Farmers | Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background: #f1f3f6;
            padding: 40px 20px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: #ffffff;
            border-radius: 12px;
            padding: 30px 25px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th, td {
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
            font-size: 15px;
        }

        th {
            background: #f9fafb;
            font-weight: 600;
            color: #333;
        }

        tr:hover {
            background: #f2f7ff;
        }

        a.button {
            display: inline-block;
            padding: 8px 14px;
            background-color: #1e90ff;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.2s ease;
        }

        a.button:hover {
            background-color: #1c86ee;
        }

        .delete-btn {
            background-color: #e74c3c;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        .action-buttons {
            white-space: nowrap;
            display: flex;
            gap: 10px;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead {
                display: none;
            }

            td {
                position: relative;
                padding-left: 50%;
                border: none;
                border-bottom: 1px solid #ddd;
            }

            td::before {
                position: absolute;
                top: 12px;
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
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Registered Farmers</h2>

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
            <th>Name</th>
            <th>Phone</th>
            <th>Bank</th>
            <th>PAN</th>
            <th>District</th>
            <th>State</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td data-label="ID"><?= $row['farmer_id'] ?></td>
                <td data-label="Name"><?= $row['farmer_name'] ?></td>
                <td data-label="Phone"><?= $row['farmer_phone'] ?></td>
                <td data-label="Bank"><?= $row['farmer_bank'] ?></td>
                <td data-label="PAN"><?= $row['farmer_pan'] ?></td>
                <td data-label="District"><?= $row['farmer_district'] ?></td>
                <td data-label="State"><?= $row['farmer_state'] ?></td>
                <td data-label="Address"><?= $row['farmer_address'] ?></td>
                <td data-label="Action">
                    <div class="action-buttons">
                        <a href="edit_farmer.php?id=<?= $row['farmer_id'] ?>" class="button">Edit</a>
                        <a href="manage_farmer.php?delete_id=<?= $row['farmer_id'] ?>" class="button delete-btn" onclick="return confirm('Are you sure you want to delete this farmer?');">Delete</a>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
