<?php
session_start();
include 'config.php';

if (!isset($_SESSION['CustomerID'])) {
    header("Location: ../login.php"); // Redirect to login if not logged in
    exit();
}

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" href="view_products.css">
</head>
<body>
   <a href="dashboard.php" class="Back">Back to Dashboard</a>
    <h1>Product List</h1>
   
    <table>
        <tr>
            
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock Level</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['ProductID']; ?></td>
            <td><?php echo $row['ProductName']; ?></td>
            <td><?php echo $row['Category']; ?></td>
            <td><?php echo $row['Price']; ?></td>
            <td><?php echo $row['Stocklevel']; ?></td>
            <td>
                <a href="edit_product.php?id=<?php echo $row['ProductID']; ?>">Edit</a>
                <a href="delete_product.php?id=<?php echo $row['ProductID']; ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
