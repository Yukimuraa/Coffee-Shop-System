<?php 
include 'config.php';

// Query to get total number of products
$totalProductsQuery = "SELECT COUNT(*) AS total FROM products";
$totalProductsResult = mysqli_query($connection, $totalProductsQuery);
$totalProducts = mysqli_fetch_assoc($totalProductsResult)['total'];

// Query to get low stock items
$lowStockQuery = "SELECT ProductName, StockLevel, ReorderLevel FROM products WHERE StockLevel <= ReorderLevel";
$lowStockResult = mysqli_query($connection, $lowStockQuery);

// Query to get recently added products
$recentProductsQuery = "SELECT ProductName, StockLevel, Price FROM products ORDER BY ProductID DESC LIMIT 5";
$recentProductsResult = mysqli_query($connection, $recentProductsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Report</title>
    <link rel="stylesheet" href="inventory_report.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Basic styles for the table and layout */
        .report-section {
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        h1, h2 {
            font-family: Arial, sans-serif;
            color: #333;
        }
        p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <a href="dashboard.php" class="Back">Back to Dashboard</a>
    <h1>Dashboard - Inventory Report</h1>
    <h2>Total Products in Inventory</h2>
    <!-- Total Products Section -->
    <div class="report-section">
      
        <!-- <i class="fas fa-boxes"> </i> -->
        <p class="Total">Total Products: <?php echo $totalProducts; ?></p>
       
    </div>

    <!-- Low Stock Items Section -->
    <div class="report-section">
        <h2>Low Stock Items</h2>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Stock Level</th>
                    <!-- <th>Reorder Level</th> -->
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($lowStockResult)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['ProductName']); ?></td>
                        <td><?php echo htmlspecialchars($row['StockLevel']); ?></td>
                        <!-- <td><?php echo htmlspecialchars($row['ReorderLevel']); ?></td> -->
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Recently Added Products Section -->
    <div class="report-section">
        <h2>Recently Added Products</h2>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Stock Level</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($recentProductsResult)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['ProductName']); ?></td>
                        <td><?php echo htmlspecialchars($row['StockLevel']); ?></td>
                        <td><?php echo number_format($row['Price'], 2); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($connection);
?>
