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

// Add Category
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cat_title'])) {
    $cat_title = mysqli_real_escape_string($conn, $_POST['cat_title']);
    $insert_sql = "INSERT INTO categories (cat_title) VALUES ('$cat_title')";
    mysqli_query($conn, $insert_sql);
    header("Location: manage_categories.php");
    exit;
}

// Delete Category
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM categories WHERE cat_id = $delete_id";
    mysqli_query($conn, $delete_sql);
    header("Location: manage_categories.php");
    exit;
}

// Fetch Categories
$sql = "SELECT * FROM categories";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Categories</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 30px;
        }

        input[type="text"] {
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        input[type="submit"] {
            width: 150px;
            background-color: #28a745;
            color: white;
            padding: 10px;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #e1e1e1;
            text-align: left;
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
            background: #dc3545;
            color: white;
            padding: 7px 13px;
            text-decoration: none;
            border-radius: 6px;
            transition: background 0.2s ease;
        }

        .button:hover {
            background: #c82333;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead {
                display: none;
            }

            tr {
                background: white;
                margin-bottom: 15px;
                padding: 10px;
                border-radius: 8px;
                box-shadow: 0 1px 4px rgba(0,0,0,0.05);
            }

            td {
                padding-left: 50%;
                position: relative;
            }

            td::before {
                position: absolute;
                top: 12px;
                left: 12px;
                font-weight: bold;
                content: attr(data-label);
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Categories</h2>

    <div style="margin-bottom: 20px;">
    <a href="admin_dashboard.php" style="display: inline-flex; align-items: center; padding: 10px 15px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 8px; font-weight: 500; transition: all 0.3s ease; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="margin-right: 8px;" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
        </svg>
        Back to Dashboard
    </a>
</div>
    <!-- Add Category Form -->
    <form method="POST">
        <input type="text" name="cat_title" placeholder="Enter new category name" required>
        <input type="submit" value="Add Category">
    </form>

    <!-- Categories Table -->
    <table>
        <thead>
            <tr>
                <th>Category ID</th>
                <th>Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td data-label="Category ID"><?= $row['cat_id'] ?></td>
                    <td data-label="Title"><?= $row['cat_title'] ?></td>
                    <td data-label="Action">
                        <a href="manage_categories.php?delete_id=<?= $row['cat_id'] ?>" class="button" onclick="return confirm('Delete this category?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
